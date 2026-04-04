<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
            'plan_id'        => 'required|exists:plans,id',
            'activity_id'    => 'required|exists:activities,id',
            'score'          => 'required|integer',
            'status'         => 'required|string|max:255',
            'attempt_number' => 'required|integer',
            'completed_at'   => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $attempt = ActivityAttempt::create($request->all());

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
        $old_id = $request->old_id;
        $attempt = ActivityAttempt::find($old_id);

        if (!$attempt) {
            return response()->json([
                'msg' => 'Activity attempt not found',
                'status' => 404,
                'activity_attempt' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'child_id'       => 'required|exists:children,id',
            'plan_id'        => 'required|exists:plans,id',
            'activity_id'    => 'required|exists:activities,id',
            'score'          => 'required|integer',
            'status'         => 'required|string|max:255',
            'attempt_number' => 'required|integer',
            'completed_at'   => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('activity_attempts')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updated = ActivityAttempt::with(['child', 'plan', 'activity'])
            ->find($request->id ?? $old_id);

        return response()->json([
            'msg' => 'Activity attempt updated successfully',
            'status' => 200,
            'activity_attempt' => $updated
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