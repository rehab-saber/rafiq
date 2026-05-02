<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\Doctor;
use App\Models\Parents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OtpNotification;
class PasswordResetController extends Controller
{
    // =========================
    // 1️⃣ Forgot Password
    // =========================
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'type'  => 'required|in:doctor,parent'
        ]);

        // 🚦 Rate limiting
        $key = $request->ip() . $request->login;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json([
                'message' => 'Too many requests. Try again later.'
            ], 429);
        }

        RateLimiter::hit($key, 60);

        $model = $request->type === 'doctor' ? Doctor::class : Parents::class;

        $user = $model::where('email', $request->login)
            ->orWhere('phone', $request->login)
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // 🔐 Generate OTP
        $otp = rand(1000, 9999);

        PasswordReset::updateOrCreate(
            [
                'login' => $request->login,
                'user_type' => $request->type
            ],
            [
                'otp' => Hash::make($otp),
                'expires_at' => now()->addMinutes(5)
            ]
        );

        Notification::send($user, new OtpNotification($otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email successfully'
        ]);
    }

    // =========================
    // 2️⃣ Verify OTP
    // =========================
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'type'  => 'required|in:doctor,parent',
            'otp'   => 'required'
        ]);
        
        $record = PasswordReset::where([
            'login' => $request->login,
            'user_type' => $request->type
        ])->first();

        if (!$record) {
            return response()->json([
                'message' => 'Invalid OTP'
            ], 400);
        }

        if (now()->greaterThan($record->expires_at)) {
            return response()->json([
                'message' => 'OTP expired'
            ], 400);
        }

        if (!Hash::check($request->otp, $record->otp)) {
            return response()->json([
                'message' => 'Wrong OTP'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

    // =========================
    // 3️⃣ Reset Password
    // =========================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'type'  => 'required|in:doctor,parent',
            'otp'   => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $record = PasswordReset::where([
            'login' => $request->login,
            'user_type' => $request->type
        ])->first();

        if (!$record || now()->greaterThan($record->expires_at)) {
            return response()->json([
                'message' => 'Invalid or expired OTP'
            ], 400);
        }

        if (!Hash::check($request->otp, $record->otp)) {
            return response()->json([
                'message' => 'Wrong OTP'
            ], 400);
        }

        $model = $request->type === 'doctor' ? Doctor::class : Parents::class;

        $user = $model::where('email', $request->login)
            ->orWhere('phone', $request->login)
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where([
            'login' => $request->login,
            'user_type' => $request->type
        ])->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully'
        ]);
    }

    // =========================
    // 4️⃣ Resend OTP
    // =========================
    public function resendOtp(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'type'  => 'required|in:doctor,parent'
        ]);

        $model = $request->type === 'doctor' ? Doctor::class : Parents::class;

        $user = $model::where('email', $request->login)
            ->orWhere('phone', $request->login)
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $otp = rand(1000, 9999);

        PasswordReset::updateOrCreate(
            [
                'login' => $request->login,
                'user_type' => $request->type
            ],
            [
                'otp' => Hash::make($otp),
                'expires_at' => now()->addMinutes(5)
            ]
        );

        Notification::send($user, new OtpNotification($otp));
        return response()->json([
            'success' => true,
            'message' => 'OTP resent to your email successfully'
        ]);
    }
}