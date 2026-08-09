<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorSettingsController extends Controller
{
    public function show(Request $request)
    {
        $doctor = $request->user();

        $settings = $doctor->settings()->firstOrCreate([
            'doctor_id' => $doctor->id,
        ]);

        $settings->refresh();

        return response()->json([
            'status' => 200,
            'settings' => $settings,
        ]);
    }


    public function update(Request $request)
    {
        $doctor = $request->user();

        $settings = $doctor->settings()->firstOrCreate([
            'doctor_id' => $doctor->id,
        ]);

        $data = $request->all();

        $booleanFields = [
            'main_notifications',
            'appointment_reminders',
            'progress_alerts',
            'massage_alerts',
            'online_consultations',
            'clinic_visits',
            'chat_status',
        ];

        foreach ($booleanFields as $field) {
            if ($request->has($field)) {
                $data[$field] = filter_var(
                    $request->input($field),
                    FILTER_VALIDATE_BOOLEAN
                );
            }
        }

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'main_notifications' => 'sometimes|boolean',
            'appointment_reminders' => 'sometimes|boolean',
            'progress_alerts' => 'sometimes|boolean',
            'massage_alerts' => 'sometimes|boolean',
            'online_consultations' => 'sometimes|boolean',
            'clinic_visits' => 'sometimes|boolean',
            'chat_status' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();


        // ===============================
        // MAIN NOTIFICATIONS
        // ===============================

        if (isset($validated['main_notifications'])) {

            if ($validated['main_notifications'] === false) {

                // Main OFF → turn everything OFF
                $validated['appointment_reminders'] = false;
                $validated['progress_alerts'] = false;
                $validated['massage_alerts'] = false;

            } else {

                // Main ON → turn everything ON
                $validated['appointment_reminders'] = true;
                $validated['progress_alerts'] = true;
                $validated['massage_alerts'] = true;
            }
        }


        // ===============================
        // CANNOT ENABLE CHILD NOTIFICATIONS
        // WHEN MAIN IS OFF
        // ===============================

        if (
            !$settings->main_notifications &&
            !isset($validated['main_notifications']) &&
            (
                ($validated['appointment_reminders'] ?? false) ||
                ($validated['progress_alerts'] ?? false) ||
                ($validated['massage_alerts'] ?? false)
            )
        ) {
            return response()->json([
                'status' => 422,
                'msg' => 'Enable main notifications first.'
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Online / Clinic Rule
        |--------------------------------------------------------------------------
        */

        $online = $validated['online_consultations']
            ?? $settings->online_consultations;

        $clinic = $validated['clinic_visits']
            ?? $settings->clinic_visits;


        if (!$online && !$clinic) {

            return response()->json([
                'status' => 422,
                'msg' => 'Online consultation or clinic visit must be enabled.',
            ], 422);
        }


        $settings->update($validated);

        return response()->json([
            'status' => 200,
            'msg' => 'Settings updated successfully.',
            'settings' => $settings->fresh(),
        ]);
    }
}