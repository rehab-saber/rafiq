<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarsQuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CarsQuestionOptionController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $options = CarsQuestionOption::with('question')->get();

        return response()->json([
            'msg' => 'Return all cars question options',
            'status' => 200,
            'options' => $options
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $option = CarsQuestionOption::with('question')->find($id);

        if ($option) {
            return response()->json([
                'msg' => 'Option found',
                'status' => 200,
                'option' => $option
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Option not found',
            'status' => 404,
            'option' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:cars_question_options|max:11',
            'label'       => 'required|string',
            'description' => 'nullable|string',
            'score' => 'required|numeric',
            'question_id' => 'required|exists:cars_questions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $option = CarsQuestionOption::create($request->all());

        return response()->json([
            'msg' => 'Option created successfully',
            'status' => 201,
            'option' => $option
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $option = CarsQuestionOption::find($old_id);

        if (!$option) {
            return response()->json([
                'msg' => 'Option not found',
                'status' => 404,
                'option' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'          => 'required|unique:cars_question_options,id,' . $old_id,
            'label'       => 'required|string',
            'description' => 'required|string',
            'score'       => 'required|integer',
            'question_id' => 'required|exists:cars_questions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('cars_question_options')
            ->where('id', $old_id)
            ->update($request->except('old_id'));

        $updated = CarsQuestionOption::with('question')->find($request->id);

        return response()->json([
            'msg' => 'Option updated successfully',
            'status' => 200,
            'option' => $updated
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $option = CarsQuestionOption::find($id);

        if (!$option) {
            return response()->json([
                'msg' => 'Option not found',
                'status' => 404,
                'option' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $option->delete();

        return response()->json([
            'msg' => 'Option deleted successfully',
            'status' => 200,
            'option' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
