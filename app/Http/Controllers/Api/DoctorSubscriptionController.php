<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorSubscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorSubscriptionController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        return response()->json([
            'status' => 200,
            'subscriptions' => DoctorSubscription::with(['doctor', 'plan'])->get()
        ]);
    }

    // ========================
    // CREATE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,expired'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subscription = DoctorSubscription::create($request->all());

        return response()->json([
            'status' => 201,
            'subscription' => $subscription
        ], 201);
    }

    // ========================
    // SHOW
    // ========================
    public function show($id)
    {
        $subscription = DoctorSubscription::with(['doctor', 'plan'])->find($id);

        if (!$subscription) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'subscription' => $subscription
        ]);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request, $id)
    {
        $subscription = DoctorSubscription::find($id);

        if (!$subscription) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        $subscription->update($request->only([
            'doctor_id',
            'subscription_plan_id',
            'start_date',
            'end_date',
            'status'
        ]));

        return response()->json([
            'status' => 200,
            'subscription' => $subscription
        ]);
    }

    // ========================
    // DELETE
    // ========================
    public function destroy($id)
    {
        $subscription = DoctorSubscription::find($id);

        if (!$subscription) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        $subscription->delete();

        return response()->json([
            'status' => 200,
            'msg' => 'Deleted successfully'
        ]);
    }
    // ========================
    // SUBSCRIBE DOCTOR
    // ========================
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'plan_id' => 'required|exists:subscription_plans,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $doctor = Doctor::find($request->doctor_id);


        if (!$doctor) {
            return response()->json([
                'msg' => 'Doctor not found',
                'status' => 404
            ], 404);
        }

        $plan = SubscriptionPlan::find($request->plan_id);

        // expire old subscriptions
        $doctor->subscriptions()
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $subscription = DoctorSubscription::create([
            'doctor_id' => $doctor->id,
            'subscription_plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration_days),
            'status' => 'active',
        ]);

        return response()->json([
            'msg' => 'Subscription created successfully',
            'status' => 201,
            'subscription' => $subscription
        ], 201);
    }

    // ========================
    // CHECK PREMIUM STATUS
    // ========================
    public function checkPremium($doctorId)
    {
        $doctor = Doctor::find($doctorId);

        if (!$doctor) {
            return response()->json([
                'msg' => 'Doctor not found',
                'status' => 404
            ], 404);
        }

        $active = $doctor->subscriptions()
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        return response()->json([
            'msg' => 'Premium status checked',
            'status' => 200,
            'is_premium' => (bool) $active,
            'subscription' => $active
        ], 200);
    }

    // ========================
    // GET ALL PLANS
    // ========================
    public function plans()
    {
        return response()->json([
            'msg' => 'All plans',
            'status' => 200,
            'plans' => SubscriptionPlan::all()
        ]);
    }

    // ========================
    // EXPIRE SUBSCRIPTIONS
    // ========================
    public function expire()
    {
        $count = DoctorSubscription::where('status', 'active')
            ->where('end_date', '<=', now())
            ->update(['status' => 'expired']);

        return response()->json([
            'msg' => 'Expired subscriptions updated',
            'status' => 200,
            'count' => $count
        ]);
    }
}