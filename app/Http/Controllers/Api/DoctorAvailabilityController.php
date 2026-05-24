<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class DoctorAvailabilityController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $availabilities = DoctorAvailability::with([
            'doctor',
            'booking'
        ])->get();

        return response()->json([
            'msg' => 'Return all availabilities',
            'status' => 200,
            'availabilities' => $availabilities
        ], 200);
    }

    // ========================
    // GET ONE
    // ========================
    public function show($id)
    {
        $availability = DoctorAvailability::with([
            'doctor',
            'booking'
        ])->find($id);

        if (!$availability) {

            return response()->json([
                'msg' => 'Availability not found',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'msg' => 'Availability found',
            'status' => 200,
            'availability' => $availability
        ], 200);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'doctor_id' => 'required|exists:doctors,id',

            'date' => 'required|date|after_or_equal:today',

            'time' => 'required|date_format:h:i A',

            'appointment_type' => 'required|in:online,in_person,both',

            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // ========================
        // CHECK DUPLICATE SLOT
        // ========================

        $exists = DoctorAvailability::where(
            'doctor_id',
            $request->doctor_id
        )

        ->where('date', $request->date)

        ->where('time', $request->time)

        ->exists();

        if ($exists) {

            return response()->json([
                'msg' => 'This slot already exists',
                'status' => 409
            ], 409);
        }

        // ========================
        // CREATE
        // ========================

        $availability = DoctorAvailability::create([
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => Carbon::createFromFormat('h:i A', $request->time)
                ->format('H:i:s'),
            'appointment_type' => $request->appointment_type,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json([
            'msg' => 'Availability created successfully',
            'status' => 201,
            'availability' => $availability
        ], 201);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'id' => 'required|exists:doctor_availabilities,id',

            'date' => 'nullable|date',

            'time' => 'nullable|date_format:h:i A',

            'appointment_type' => 'nullable|in:online,in_person,both',

            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $availability = DoctorAvailability::find($request->id);

        $availability->update($request->all());

        return response()->json([
            'msg' => 'Availability updated successfully',
            'status' => 200,
            'availability' => $availability
        ], 200);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $availability = DoctorAvailability::find($id);

        if (!$availability) {

            return response()->json([
                'msg' => 'Availability not found',
                'status' => 404
            ], 404);
        }

        $availability->delete();

        return response()->json([
            'msg' => 'Availability deleted successfully',
            'status' => 200
        ], 200);
    }
}