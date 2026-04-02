<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SectionLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SectionLevelController extends Controller
{
    // =========================
    // GET ALL LEVELS
    // =========================
    public function index()
    {
        $levels = SectionLevel::with('section','activities')->get();

        return response()->json([
            'msg' => 'Return all levels',
            'status' => 200,
            'levels' => $levels
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET LEVEL BY ID
    // =========================
    public function show($id)
    {
        $level = SectionLevel::with('section','activities')->find($id);

        if ($level) {
            return response()->json([
                'msg' => 'Level found',
                'status' => 200,
                'level' => $level
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Level not found',
            'status' => 404,
            'level' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // CREATE LEVEL
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'level_number' => 'required|integer',
            'section_id'   => 'required|exists:sections,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $level = SectionLevel::create($request->all());

        return response()->json([
            'msg' => 'Level created successfully',
            'status' => 201,
            'level' => $level
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // UPDATE LEVEL
    // =========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $level = SectionLevel::find($old_id);

        if (!$level) {
            return response()->json([
                'msg' => 'Level not found',
                'status' => 404,
                'level' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'           => 'required|unique:section_levels,id,' . $old_id,
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'level_number' => 'required|integer',
            'section_id'   => 'required|exists:sections,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('section_levels')
            ->where('id', $old_id)
            ->update([
                'id'           => $request->id,
                'name'         => $request->name,
                'description'  => $request->description,
                'level_number' => $request->level_number,
                'section_id'   => $request->section_id
            ]);

        $updatedLevel = SectionLevel::with('section','activities')->find($request->id);

        return response()->json([
            'msg' => 'Level updated successfully',
            'status' => 200,
            'level' => $updatedLevel
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // DELETE LEVEL
    // =========================
    public function delete($id)
    {
        $level = SectionLevel::find($id);

        if (!$level) {
            return response()->json([
                'msg' => 'Level not found',
                'status' => 404,
                'level' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $level->delete();

        return response()->json([
            'msg' => 'Level deleted successfully',
            'status' => 200,
            'level' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}