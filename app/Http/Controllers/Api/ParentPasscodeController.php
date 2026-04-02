<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParentPasscode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ParentPasscodeController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $codes = ParentPasscode::with('doctor')->get();

        return response()->json([
            'msg' => 'Return all parent passcodes',
            'status' => 200,
            'passcodes' => $codes
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $code = ParentPasscode::with('doctor')->find($id);

        if ($code) {
            return response()->json([
                'msg' => 'Parent passcode found',
                'status' => 200,
                'passcode' => $code
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Parent passcode not found',
            'status' => 404,
            'passcode' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'        => 'required|unique:parent_passcodes,id',
            'doctor_id' => 'required|exists:doctors,id',
            'code'      => 'required|unique:parent_passcodes,code',
            'is_used'   => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $code = ParentPasscode::create([
            'id'        => $request->id,
            'doctor_id' => $request->doctor_id,
            'code'      => $request->code,
            'is_used'   => $request->is_used ?? false
        ]);

        return response()->json([
            'msg' => 'Parent passcode created successfully',
            'status' => 201,
            'passcode' => $code
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $code = ParentPasscode::find($old_id);

        if (!$code) {
            return response()->json([
                'msg' => 'Parent passcode not found',
                'status' => 404,
                'passcode' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'        => 'required|unique:parent_passcodes,id,' . $old_id,
            'doctor_id' => 'required|exists:doctors,id',
            'code'      => 'required|unique:parent_passcodes,code,' . $old_id,
            'is_used'   => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('parent_passcodes')
            ->where('id', $old_id)
            ->update([
                'id'        => $request->id,
                'doctor_id' => $request->doctor_id,
                'code'      => $request->code,
                'is_used'   => $request->is_used
            ]);

        $updated = ParentPasscode::with('doctor')->find($request->id);

        return response()->json([
            'msg' => 'Parent passcode updated successfully',
            'status' => 200,
            'passcode' => $updated
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $code = ParentPasscode::find($id);

        if (!$code) {
            return response()->json([
                'msg' => 'Parent passcode not found',
                'status' => 404,
                'passcode' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $code->delete();

        return response()->json([
            'msg' => 'Parent passcode deleted successfully',
            'status' => 200,
            'passcode' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
