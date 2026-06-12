<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionPlanController extends Controller
{
    // ========================
    // GET ALL PLANS
    // ========================
    public function index()
    {
        return response()->json([
            'status' => 200,
            'plans' => SubscriptionPlan::all()
        ]);
    }

    // ========================
    // CREATE PLAN
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $plan = SubscriptionPlan::create($request->all());

        return response()->json([
            'status' => 201,
            'plan' => $plan
        ], 201);
    }

    // ========================
    // SHOW PLAN
    // ========================
    public function show($id)
    {
        $plan = SubscriptionPlan::find($id);

        if (!$plan) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'plan' => $plan
        ]);
    }

    // ========================
    // UPDATE PLAN
    // ========================
    public function update(Request $request, $id)
    {
        $plan = SubscriptionPlan::find($id);

        if (!$plan) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        $plan->update($request->only(['name', 'price', 'duration_days']));

        return response()->json([
            'status' => 200,
            'plan' => $plan
        ]);
    }

    // ========================
    // DELETE PLAN
    // ========================
    public function destroy($id)
    {
        $plan = SubscriptionPlan::find($id);

        if (!$plan) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        $plan->delete();

        return response()->json([
            'status' => 200,
            'msg' => 'Deleted successfully'
        ]);
    }
}