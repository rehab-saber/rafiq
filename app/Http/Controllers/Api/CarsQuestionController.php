<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarsQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CarsQuestionController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $questions = CarsQuestion::all();

        return response()->json([
            'msg' => 'Return all cars questions',
            'status' => 200,
            'questions' => $questions
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $question = CarsQuestion::find($id);

        if ($question) {
            return response()->json([
                'msg' => 'Question found',
                'status' => 200,
                'question' => $question
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Question not found',
            'status' => 404,
            'question' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'               => 'required|unique:cars_questions|max:11',
            'title'            => 'nullable|string',
            'question_text'    => 'required|string',
            'skill_indicator'  => 'required|string',
            'section_id'       => 'required|exists:sections,id', // <-- اضفنا هذا
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $question = CarsQuestion::create($request->all());

        return response()->json([
            'msg' => 'Question created successfully',
            'status' => 201,
            'question' => $question
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $question = CarsQuestion::find($old_id);

        if (!$question) {
            return response()->json([
                'msg' => 'Question not found',
                'status' => 404,
                'question' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'               => 'required|unique:cars_questions,id,' . $old_id,
            'title'            => 'nullable|string',
            'question_text'    => 'required|string',
            'skill_indicator'  => 'required|string',
            'section_id'       => 'required|exists:sections,id', // <-- اضفنا هذا
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('cars_questions')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updatedQuestion = CarsQuestion::find($request->id);

        return response()->json([
            'msg' => 'Question updated successfully',
            'status' => 200,
            'question' => $updatedQuestion
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $question = CarsQuestion::find($id);

        if (!$question) {
            return response()->json([
                'msg' => 'Question not found',
                'status' => 404,
                'question' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $question->delete();

        return response()->json([
            'msg' => 'Question deleted successfully',
            'status' => 200,
            'question' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
