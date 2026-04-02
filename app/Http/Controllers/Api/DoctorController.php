<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    // =========================
    // GET ALL DOCTORS
    // =========================
    public function index()
    {
        $doctors = Doctor::all();

        return response()->json([
            'msg' => 'Return all doctors',
            'status' => 200,
            'doctors' => $doctors
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET DOCTOR BY ID
    // =========================
    public function show($id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            return response()->json([
                'msg' => 'Doctor found',
                'status' => 200,
                'doctor' => $doctor
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Doctor not found',
            'status' => 404,
            'doctor' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // CREATE DOCTOR
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:doctors,id',
            'name'        => 'required|string',
            'email'       => 'required|email|unique:doctors,email',
            'password'    => 'required|min:6',
            'phone'       => 'nullable|string',
            'clinic_name' => 'nullable|string',
            'speciality'  => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $doctor = Doctor::create([
            'id'          => $request->id,
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'phone'       => $request->phone,
            'clinic_name' => $request->clinic_name,
            'speciality'  => $request->speciality,
            'role'        => 'doctor'
        ]);

        return response()->json([
            'msg' => 'Doctor created successfully',
            'status' => 201,
            'doctor' => $doctor
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // UPDATE DOCTOR (LIKE CarsAnswer)
    // =========================
    public function update(Request $request)
    {
        // old id
        $old_id = $request->old_id;
        $doctor = Doctor::find($old_id);

        if (!$doctor) {
            return response()->json([
                'msg' => 'Doctor not found',
                'status' => 404,
                'doctor' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:doctors,id,' . $old_id,
            'name'        => 'required|string',
            'email'       => 'required|email|unique:doctors,email,' . $old_id,
            'phone'       => 'nullable|string',
            'clinic_name' => 'nullable|string',
            'speciality'  => 'nullable|string',
            'password'    => 'nullable|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // update using query builder
        DB::table('doctors')
            ->where('id', $old_id)
            ->update([
                'id'          => $request->id,
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'clinic_name' => $request->clinic_name,
                'speciality'  => $request->speciality,
                'password'    => $request->password
                    ? bcrypt($request->password)
                    : $doctor->password,
            ]);

        $updatedDoctor = Doctor::find($request->id);

        return response()->json([
            'msg' => 'Doctor updated successfully',
            'status' => 200,
            'doctor' => $updatedDoctor
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // DELETE DOCTOR
    // =========================
    public function delete($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json([
                'msg' => 'Doctor not found',
                'status' => 404,
                'doctor' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $doctor->delete();

        return response()->json([
            'msg' => 'Doctor deleted successfully',
            'status' => 200,
            'doctor' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
