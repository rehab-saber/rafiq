<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityAttempt;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityAttemptController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $attempts = ActivityAttempt::with(['child', 'plan', 'activity'])->get();

        return response()->json([
            'msg' => 'Return all activity attempts',
            'status' => 200,
            'activity_attempts' => $attempts
        ], 200);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $attempt = ActivityAttempt::with(['child', 'plan', 'activity'])->find($id);

        if (!$attempt) {
            return response()->json([
                'msg' => 'Activity attempt not found',
                'status' => 404,
                'activity_attempt' => null
            ], 404);
        }

        return response()->json([
            'msg' => 'Activity attempt found',
            'status' => 200,
            'activity_attempt' => $attempt
        ], 200);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'child_id'       => 'required|exists:children,id',
            'activity_id'    => 'required|exists:activities,id',

            'plan_id'        => 'nullable|exists:plans,id',
            'score'          => 'nullable|integer',
            'result'         => 'nullable|in:passed,failed',

            'status'         => 'required|in:pending,in_progress,completed',
            'attempt_number' => 'nullable|integer',
            'completed_at'   => 'nullable|date',

            'difficulty'     => 'nullable|in:easy,medium,hard',
            'mood'           => 'nullable|in:happy,calm,frustrated',
            'rating'         => 'nullable|integer|min:1|max:3',
        ]);

        // ========================
        // CUSTOM BUSINESS RULE
        // ========================
        $validator->after(function ($validator) use ($request) {

            $activity = Activity::with('level')->find($request->activity_id);

            if ($activity && $activity->level && $activity->level->level_number == 1) {

                // ❌ ممنوع يتحط في plan
                if ($request->plan_id) {
                    $validator->errors()->add(
                        'plan_id',
                        'Level 1 activities are test activities and cannot be assigned to a plan.'
                    );
                }

                // ❌ ممنوع score
                if ($request->score) {
                    $validator->errors()->add(
                        'score',
                        'Score is not allowed for test activities.'
                    );
                }

                // ❌ ممنوع difficulty
                if ($request->difficulty) {
                    $validator->errors()->add(
                        'difficulty',
                        'Difficulty is not allowed for test activities.'
                    );
                }

                // ❌ ممنوع mood
                if ($request->mood) {
                    $validator->errors()->add(
                        'mood',
                        'Mood is not allowed for test activities.'
                    );
                }

                // ❌ ممنوع rating
                if ($request->rating) {
                    $validator->errors()->add(
                        'rating',
                        'Rating is not allowed for test activities.'
                    );
                }

                // ❌ ممنوع completed_at
                if ($request->completed_at) {
                    $validator->errors()->add(
                        'completed_at',
                        'completed_at is not allowed for test activities.'
                    );
                }
            }
        });
        
        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
        $data = $request->all();

        $activity = Activity::with('level')->find($request->activity_id);

        if ($activity && $activity->level && $activity->level->level_number == 1) {

            $data['plan_id'] = null;
            $data['score'] = null;
            $data['difficulty'] = null;
            $data['mood'] = null;
            $data['rating'] = null;
            $data['completed_at'] = null;
        }

        // auto attempt number
        if (!isset($data['attempt_number'])) {
            $lastAttempt = ActivityAttempt::where('child_id', $request->child_id)
                ->where('activity_id', $request->activity_id)
                ->count();

            $data['attempt_number'] = $lastAttempt + 1;
        }

        $attempt = ActivityAttempt::create($data);

        return response()->json([
            'msg' => 'Activity attempt created successfully',
            'status' => 201,
            'activity_attempt' => $attempt
        ], 201);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $attempt = ActivityAttempt::find($request->old_id);

        if (!$attempt) {
            return response()->json([
                'msg' => 'Activity attempt not found',
                'status' => 404,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'child_id'       => 'sometimes|exists:children,id',
            'activity_id'    => 'sometimes|exists:activities,id',
            'plan_id'        => 'nullable|exists:plans,id',

            'score'          => 'nullable|integer',
            'result'         => 'nullable|in:passed,failed',

            'status'         => 'sometimes|in:pending,in_progress,completed',
            'attempt_number' => 'nullable|integer',
            'completed_at'   => 'nullable|date',

            'difficulty'     => 'nullable|in:easy,medium,hard',
            'mood'           => 'nullable|in:happy,calm,frustrated',
            'rating'         => 'nullable|integer|min:1|max:5',
        ]);

        // ========================
        // SAME BUSINESS RULE
        // ========================
        $validator->after(function ($validator) use ($request) {

            if ($request->plan_id && $request->activity_id) {

                $activity = Activity::with('level')->find($request->activity_id);

                if ($activity && $activity->level && $activity->level->level_number == 1) {
                    $validator->errors()->add(
                        'plan_id',
                        'Level 1 activities are test activities and cannot be assigned to a plan.'
                    );
                }
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $attempt->update($request->except('old_id'));

        return response()->json([
            'msg' => 'Activity attempt updated successfully',
            'status' => 200,
            'activity_attempt' => $attempt->load(['child', 'plan', 'activity'])
        ], 200);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $attempt = ActivityAttempt::find($id);

        if (!$attempt) {
            return response()->json([
                'msg' => 'Activity attempt not found',
                'status' => 404,
                'activity_attempt' => null
            ], 404);
        }

        $attempt->delete();

        return response()->json([
            'msg' => 'Activity attempt deleted successfully',
            'status' => 200,
            'activity_attempt' => null
        ], 200);
    }
}