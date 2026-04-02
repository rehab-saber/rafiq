<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsController extends Controller
{
    // =========================
    // GET ALL PARENTS
    // =========================
    public function index()
    {
        $parents = Parents::with('doctor')->get();

        return response()->json([
            'msg' => 'Return all parents',
            'status' => 200,
            'parents' => $parents
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET PARENT BY ID
    // =========================
    public function show($id)
    {
        $parent = Parents::with('doctor')->find($id);

        if ($parent) {
            return response()->json([
                'msg' => 'Parent found',
                'status' => 200,
                'parent' => $parent
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Parent not found',
            'status' => 404,
            'parent' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // CREATE PARENT
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:parents,email',
            'phone'     => 'nullable|string|max:20',
            'password'  => 'required|min:6',
            'doctor_id' => 'nullable|exists:doctors,id',
            'status'    => 'nullable|in:active,blocked'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $parent = Parents::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'doctor_id' => $request->doctor_id,
            'status'    => $request->status ?? 'active'
        ]);

        return response()->json([
            'msg' => 'Parent created successfully',
            'status' => 201,
            'parent' => $parent
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // UPDATE PARENT
    // =========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $parent = Parents::find($old_id);

        if (!$parent) {
            return response()->json([
                'msg' => 'Parent not found',
                'status' => 404,
                'parent' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'        => 'required|unique:parents,id,' . $old_id,
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:parents,email,' . $old_id,
            'phone'     => 'nullable|string|max:20',
            'password'  => 'nullable|min:6',
            'doctor_id' => 'nullable|exists:doctors,id',
            'status'    => 'nullable|in:active,blocked'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('parents')
            ->where('id', $old_id)
            ->update([
                'id'        => $request->id,
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'doctor_id' => $request->doctor_id,
                'status'    => $request->status ?? 'active',
                'password'  => $request->password ? Hash::make($request->password) : $parent->password,
            ]);

        $updatedParent = Parents::with('doctor')->find($request->id);

        return response()->json([
            'msg' => 'Parent updated successfully',
            'status' => 200,
            'parent' => $updatedParent
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // DELETE PARENT
    // =========================
    public function delete($id)
    {
        $parent = Parents::find($id);

        if (!$parent) {
            return response()->json([
                'msg' => 'Parent not found',
                'status' => 404,
                'parent' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $parent->delete();

        return response()->json([
            'msg' => 'Parent deleted successfully',
            'status' => 200,
            'parent' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
