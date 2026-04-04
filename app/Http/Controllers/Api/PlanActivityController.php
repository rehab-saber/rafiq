<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PlanActivityController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $activities = PlanActivity::with(['plan', 'activity'])->get();

        return response()->json([
            'msg' => 'Return all plan activities',
            'status' => 200,
            'plan_activities' => $activities
        ], 200);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $activity = PlanActivity::with(['plan', 'activity'])->find($id);

        if (!$activity) {
            return response()->json([
                'msg' => 'Plan activity not found',
                'status' => 404,
                'plan_activity' => null
            ], 404);
        }

        return response()->json([
            'msg' => 'Plan activity found',
            'status' => 200,
            'plan_activity' => $activity
        ], 200);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity_id'       => 'required|exists:activities,id',
            'plan_id'           => 'required|exists:plans,id',
            'target_repetitions'=> 'required|integer',
            'doctor_notes'      => 'nullable|string',
            'order_number'      => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $activity = PlanActivity::create($request->all());

        return response()->json([
            'msg' => 'Plan activity created successfully',
            'status' => 201,
            'plan_activity' => $activity
        ], 201);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $activity = PlanActivity::find($old_id);

        if (!$activity) {
            return response()->json([
                'msg' => 'Plan activity not found',
                'status' => 404,
                'plan_activity' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'activity_id'       => 'required|exists:activities,id',
            'plan_id'           => 'required|exists:plans,id',
            'target_repetitions'=> 'required|integer',
            'doctor_notes'      => 'nullable|string',
            'order_number'      => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('plan_activities')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updated = PlanActivity::with(['plan', 'activity'])
            ->find($request->id ?? $old_id);

        return response()->json([
            'msg' => 'Plan activity updated successfully',
            'status' => 200,
            'plan_activity' => $updated
        ], 200);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $activity = PlanActivity::find($id);

        if (!$activity) {
            return response()->json([
                'msg' => 'Plan activity not found',
                'status' => 404,
                'plan_activity' => null
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'msg' => 'Plan activity deleted successfully',
            'status' => 200,
            'plan_activity' => null
        ], 200);
    }
}