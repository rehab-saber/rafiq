<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParentNotificationSettingController extends Controller
{
    // =========================
    // GET SETTINGS
    // =========================
    public function show(Request $request)
    {
        $parent = $request->user();

        $settings = $parent->notificationSettings()->firstOrCreate([
            'parent_id' => $parent->id,
        ]);

        $settings->refresh();

        return response()->json([
            'status' => 200,
            'settings' => $settings,
        ]);
    }


    // =========================
    // UPDATE SETTINGS
    // =========================
    public function update(Request $request)
    {
        $parent = $request->user();

        $settings = $parent->notificationSettings()->firstOrCreate([
            'parent_id' => $parent->id,
        ]);


        // =========================
        // Convert form-data booleans
        // =========================

        $data = $request->all();

        $booleanFields = [
            'main_notifications',
            'activity_reminders',
            'appointment_reminders',
            'new_article_reminder',
            'doctor_messages',
        ];

        foreach ($booleanFields as $field) {
            if ($request->has($field)) {
                $data[$field] = filter_var(
                    $request->input($field),
                    FILTER_VALIDATE_BOOLEAN
                );
            }
        }


        // =========================
        // Validation
        // =========================

        $validator = Validator::make($data, [
            'main_notifications' => 'sometimes|boolean',
            'activity_reminders' => 'sometimes|boolean',
            'appointment_reminders' => 'sometimes|boolean',
            'new_article_reminder' => 'sometimes|boolean',
            'doctor_messages' => 'sometimes|boolean',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }


        $validated = $validator->validated();


        // =====================================================
        // MAIN NOTIFICATIONS
        // =====================================================

        if (isset($validated['main_notifications'])) {

            // Main OFF
            if ($validated['main_notifications'] === false) {

                $validated['activity_reminders'] = false;
                $validated['appointment_reminders'] = false;
                $validated['new_article_reminder'] = false;
                $validated['doctor_messages'] = false;
            }

            // Main ON
            
        }


        // =====================================================
        // Cannot enable child notification while Main is OFF
        // =====================================================

        $mainNotifications = $validated['main_notifications']
            ?? $settings->main_notifications;

        if (!$mainNotifications) {

            if (
                ($validated['activity_reminders'] ?? false) === true ||
                ($validated['new_article_reminder'] ?? false) === true ||
                ($validated['appointment_reminders'] ?? false) === true ||
                ($validated['doctor_messages'] ?? false) === true
            ) {
                return response()->json([
                    'status' => 422,
                    'msg' => 'Enable main notifications first.',
                ], 422);
            }
        }
        


        // =========================
        // Update
        // =========================

        $settings->update($validated);

        return response()->json([
            'status' => 200,
            'msg' => 'Notification settings updated successfully.',
            'settings' => $settings->fresh(),
        ]);
    }
}