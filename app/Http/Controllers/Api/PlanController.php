<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $plans = Plan::with(['doctor', 'child'])->get();

        return response()->json([
            'msg' => 'Return all plans',
            'status' => 200,
            'plans' => $plans
        ], 200);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $plan = Plan::with(['doctor', 'child'])->find($id);

        if (!$plan) {
            return response()->json([
                'msg' => 'Plan not found',
                'status' => 404,
                'plan' => null
            ], 404);
        }

        return response()->json([
            'msg' => 'Plan found',
            'status' => 200,
            'plan' => $plan
        ], 200);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'child_id'  => 'required|exists:children,id',
            'source'    => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $plan = Plan::create($request->all());

        return response()->json([
            'msg' => 'Plan created successfully',
            'status' => 201,
            'plan' => $plan
        ], 201);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $plan = Plan::find($old_id);

        if (!$plan) {
            return response()->json([
                'msg' => 'Plan not found',
                'status' => 404,
                'plan' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'child_id'  => 'required|exists:children,id',
            'source'    => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('plans')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updated = Plan::with(['doctor', 'child'])
            ->find($request->id ?? $old_id);

        return response()->json([
            'msg' => 'Plan updated successfully',
            'status' => 200,
            'plan' => $updated
        ], 200);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json([
                'msg' => 'Plan not found',
                'status' => 404,
                'plan' => null
            ], 404);
        }

        $plan->delete();

        return response()->json([
            'msg' => 'Plan deleted successfully',
            'status' => 200,
            'plan' => null
        ], 200);
    }
}