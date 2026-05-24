<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\SectionLevel;

class SectionController extends Controller
{
    // =========================
    // GET ALL SECTIONS
    // =========================
    public function index()
    {
        $sections = Section::with('levels')->get();

        return response()->json([
            'msg' => 'Return all sections',
            'status' => 200,
            'sections' => $sections
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET SECTION BY ID
    // =========================
    public function show($id)
    {
        $section = Section::with('levels')->find($id);

        if ($section) {
            return response()->json([
                'msg' => 'Section found',
                'status' => 200,
                'section' => $section
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Section not found',
            'status' => 404,
            'section' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // CREATE SECTION
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'color'       => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $section = Section::create($request->all());

            if ($section->name != 'Overall Parent Impression' && $section->name != 'Daily Living') {
                $levels = [
                    ['name' => 'Level 1', 'description' => 'Basic level',        'level_number' => 1],
                    ['name' => 'Level 2', 'description' => 'Intermediate level', 'level_number' => 2],
                    ['name' => 'Level 3', 'description' => 'Advanced level',     'level_number' => 3],
                    ['name' => 'Level 4', 'description' => 'Final level',        'level_number' => 4],
                ];

                foreach ($levels as $level) {
                    SectionLevel::create([
                        'name'         => $level['name'],
                        'description'  => $level['description'],
                        'level_number' => $level['level_number'],
                        'section_id'   => $section->id
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'msg'     => 'Section created successfully',
                'status'  => 201,
                'section' => $section->load('levels')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'msg'    => 'Something went wrong',
                'status' => 500,
                'error'  => $e->getMessage()
            ], 500);
        }
    }

    // =========================
    // UPDATE SECTION
    // =========================
    public function update(Request $request)
    {
        $old_id  = $request->old_id;
        $section = Section::find($old_id);

        if (!$section) {
            return response()->json([
                'msg'     => 'Section not found',
                'status'  => 404,
                'section' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:sections,id,' . $old_id,
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'color'       => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('sections')
            ->where('id', $old_id)
            ->update([
                'id'          => $request->id,
                'name'        => $request->name,
                'description' => $request->description,
                'color'       => $request->color,
            ]);

        $updatedSection = Section::with('levels')->find($request->id);

        return response()->json([
            'msg'     => 'Section updated successfully',
            'status'  => 200,
            'section' => $updatedSection
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // DELETE SECTION
    // =========================
    public function delete($id)
    {
        $section = Section::find($id);

        if (!$section) {
            return response()->json([
                'msg'     => 'Section not found',
                'status'  => 404,
                'section' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $section->delete();

        return response()->json([
            'msg'     => 'Section deleted successfully',
            'status'  => 200,
            'section' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}