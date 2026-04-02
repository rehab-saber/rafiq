<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ChildController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $children = Child::with('parent')->get();

        return response()->json([
            'msg' => 'Return all children',
            'status' => 200,
            'children' => $children
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $child = Child::with('parent')->find($id);

        if ($child) {
            return response()->json([
                'msg' => 'Child found',
                'status' => 200,
                'child' => $child
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Child not found',
            'status' => 404,
            'child' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'            => 'required|unique:children|max:11',
            'name'          => 'required|string',
            'gender'        => 'required|in:male,female',
            'age'           => 'required|integer',
            'autism_level'  => 'nullable|integer',
            'parent_id'     => 'required|exists:parents,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $child = Child::create($request->all());

        return response()->json([
            'msg' => 'Child created successfully',
            'status' => 201,
            'child' => $child
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $child = Child::find($old_id);

        if (!$child) {
            return response()->json([
                'msg' => 'Child not found',
                'status' => 404,
                'child' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'            => 'required|unique:children,id,' . $old_id,
            'name'          => 'required|string',
            'gender'        => 'required|in:male,female',
            'age'           => 'required|integer',
            'autism_level'  => 'nullable|integer',
            'parent_id'     => 'required|exists:parents,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('children')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updatedChild = Child::with('parent')->find($request->id);

        return response()->json([
            'msg' => 'Child updated successfully',
            'status' => 200,
            'child' => $updatedChild
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $child = Child::find($id);

        if (!$child) {
            return response()->json([
                'msg' => 'Child not found',
                'status' => 404,
                'child' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $child->delete();

        return response()->json([
            'msg' => 'Child deleted successfully',
            'status' => 200,
            'child' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
