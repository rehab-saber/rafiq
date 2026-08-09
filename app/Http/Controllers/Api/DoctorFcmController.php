<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorFcmController extends Controller
{
    public function updateToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $doctor = $request->user();

        $doctor->update([
            'fcm_token' => $request->fcm_token,
        ]);

        return response()->json([
            'status' => 200,
            'msg' => 'FCM token updated successfully.',
        ]);
    }
}