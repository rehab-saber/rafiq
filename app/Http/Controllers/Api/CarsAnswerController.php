<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarsAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CarsAnswerController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $answers = CarsAnswer::with(['child', 'question', 'option'])->get();

        return response()->json([
            'msg' => 'Return all cars answers',
            'status' => 200,
            'answers' => $answers
        ], 200);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show(int $id)
    {
        $answer = CarsAnswer::with(['child', 'question', 'option'])->find($id);

        if (!$answer) {
            return response()->json([
                'msg' => 'Answer not found',
                'status' => 404,
                'answer' => null
            ], 404);
        }

        return response()->json([
            'msg' => 'Answer found',
            'status' => 200,
            'answer' => $answer
        ], 200);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:cars_answers,id',
            'child_id'    => 'required|exists:children,id',
            'question_id' => 'required|exists:cars_questions,id',
            'option_id'   => 'required|exists:cars_question_options,id',
            'score'       => 'nullable|numeric',
            'severity_level' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $answer = CarsAnswer::create($request->all());

        return response()->json([
            'msg' => 'Cars answer created successfully',
            'status' => 201,
            'answer' => $answer
        ], 201);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $answer = CarsAnswer::find($old_id);

        if (!$answer) {
            return response()->json([
                'msg' => 'Answer not found',
                'status' => 404,
                'answer' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:cars_answers,id,' . $old_id,
            'child_id'    => 'required|exists:children,id',
            'question_id' => 'required|exists:cars_questions,id',
            'option_id'   => 'required|exists:cars_question_options,id',
            'score' => 'nullable|numeric',
            'severity_level' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('cars_answers')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updated = CarsAnswer::with(['child', 'question', 'option'])
            ->find($request->id);

        return response()->json([
            'msg' => 'Cars answer updated successfully',
            'status' => 200,
            'answer' => $updated
        ], 200);
    }

    // ========================
    // DELETE
    // ========================
    public function destroy(int $id)
    {
        $answer = CarsAnswer::find($id);

        if (!$answer) {
            return response()->json([
                'msg' => 'Answer not found',
                'status' => 404,
                'answer' => null
            ], 404);
        }

        $answer->delete();

        return response()->json([
            'msg' => 'Cars answer deleted successfully',
            'status' => 200,
            'answer' => null
        ], 200);
    }
}
