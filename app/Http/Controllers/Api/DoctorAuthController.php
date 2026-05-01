<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DoctorAuthController extends Controller
{
    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $doctor = Doctor::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
            'phone'       => $request->phone,
            'clinic_name' => $request->clinic_name,
            'speciality'  => $request->speciality,
            'role'        => 'doctor',
        ]);

        $token = $doctor->createToken('doctor-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'doctor' => $doctor,
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

        // تحديد هل Email أو Phone
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $doctor = Doctor::where($field, $input)->first();

        if (!$doctor || !Hash::check($request->password, $doctor->password)) {
            throw ValidationException::withMessages([
                'login' => ['Email/Phone or password is incorrect'],
            ]);
        }

        $doctor->tokens()->delete();

        $token = $doctor->createToken('doctor-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'doctor' => $doctor,
                'token'  => $token,
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
            'data' => $request->user()
        ]);
    }

    // =========================
    // SOCIAL LOGIN (SIGN UP / LOGIN)
    // =========================
    public function socialLogin(Request $request, $provider)
    {
        $request->validate([
            'name'        => 'required|string',
            'email'       => 'nullable|email',
            'provider_id' => 'required|string',
        ]);

        if (!in_array($provider, ['google', 'facebook'])) {
            return response()->json([
                'success' => false,
                'message' => 'Provider not supported'
            ], 422);
        }

        $doctor = Doctor::where('provider_name', $provider)
                        ->where('provider_id', $request->provider_id)
                        ->first();

        if (!$doctor) {
            $doctor = Doctor::create([
                'name'          => $request->name,
                'email'         => $request->email ?? null,
                'provider_name' => $provider,
                'provider_id'   => $request->provider_id,
                'password'      => Hash::make(uniqid()),
                'role'          => 'doctor',
            ]);
        }

        $token = $doctor->createToken('doctor-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login with ' . $provider . ' successful',
            'data' => [
                'doctor' => $doctor,
                'token'  => $token,
            ]
        ]);
    }
}
