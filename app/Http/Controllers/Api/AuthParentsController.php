<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;
use App\Models\ParentPasscode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthParentsController extends Controller
{
    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:parents,email',
            'password'  => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string',
        ]);

        $parent = Parents::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $parent->createToken('parent-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data'    => [
                'parent' => $parent,
                'token'  => $token,
            ]
        ], 201);
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string', // email أو phone
            'password' => 'required|string',
        ]);

        $input = $request->login;

        // نحدد لو Email أو Phone
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $parent = Parents::where($field, $input)->first();

        if (!$parent || !Hash::check($request->password, $parent->password)) {
            throw ValidationException::withMessages([
                'login' => ['Email/Phone or password is incorrect'],
            ]);
        }

        $parent->tokens()->delete();

        $token = $parent->createToken('parent-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'parent' => $parent,
                'token' => $token,
            ]
        ]);
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    // =========================
    // PROFILE
    // =========================
    public function profile(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => $request->user()
        ]);
    }

    // =========================
    // PASSCODE ENTRY
    // =========================
    public function passcodeEntry(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string',
            'parent_name' => 'required|string|max:255',
        ]);

        $passcode = ParentPasscode::where('code', $request->passcode)
                    ->where('is_used', false)
                    ->first();

        if (!$passcode) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or already used passcode',
            ], 422);
        }

        $parent = Parents::create([
            'name'      => $request->parent_name,
            'email'     => null,
            'password'  => Hash::make('temporary_password'),
            'doctor_id' => $passcode->doctor_id,
        ]);

        $passcode->update(['is_used' => true]);

        $token = $parent->createToken('parent-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Connected with doctor successfully',
            'data' => [
                'parent'    => $parent,
                'token'     => $token,
                'next_step' => 'complete_profile'
            ]
        ], 201);
    }

    // =========================
    // SOCIAL LOGIN (SIGN UP/LOGIN)
    // =========================
    public function socialLogin(Request $request, string $provider)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'provider_id' => 'required|string',
        ]);

        if (!in_array($provider, ['google', 'facebook'])) {
            return response()->json([
                'success' => false,
                'message' => 'Provider not supported'
            ], 422);
        }

        $parent = Parents::where('provider_name', $provider)
                        ->where('provider_id', $request->provider_id)
                        ->first();

        if (!$parent) {
            $parent = Parents::create([
                'name' => $request->name,
                'email' => $request->email ?? null,
                'provider_name' => $provider,
                'provider_id' => $request->provider_id,
                'password' => Hash::make(uniqid()),
            ]);
        }

        $token = $parent->createToken('parent-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login with ' . $provider . ' successful',
            'data' => [
                'parent' => $parent,
                'token' => $token,
            ]
        ]);
    }
}
