<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|string|max:255',
            // اضيفي أي شروط تانية حسب عمود الـ Section
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $section = Section::create($request->all());

        return response()->json([
            'msg' => 'Section created successfully',
            'status' => 201,
            'section' => $section
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // UPDATE SECTION
    // =========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $section = Section::find($old_id);

        if (!$section) {
            return response()->json([
                'msg' => 'Section not found',
                'status' => 404,
                'section' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'   => 'required|unique:sections,id,' . $old_id,
            'name' => 'required|string|max:255',
            // اضيفي أي شروط تانية حسب عمود الـ Section
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('sections')
            ->where('id', $old_id)
            ->update([
                'id'   => $request->id,
                'name' => $request->name,
                // أي أعمدة تانية حسب الجدول
            ]);

        $updatedSection = Section::with('levels')->find($request->id);

        return response()->json([
            'msg' => 'Section updated successfully',
            'status' => 200,
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
                'msg' => 'Section not found',
                'status' => 404,
                'section' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $section->delete();

        return response()->json([
            'msg' => 'Section deleted successfully',
            'status' => 200,
            'section' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}