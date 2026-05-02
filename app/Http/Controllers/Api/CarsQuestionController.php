<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarsQuestion;
use App\Models\CarsQuestionOption; // 👈 مهم
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
        $questions = CarsQuestion::with('options')->get(); // 👈 نجيب options معاه

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
        $question = CarsQuestion::with('options')->find($id);

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
    // STORE (🔥 هنا السحر)
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'               => 'required|unique:cars_questions|max:11',
            'title'            => 'nullable|string',
            'question_text'    => 'required|string',
            'skill_indicator'  => 'required|string',
            'section_id'       => 'required|exists:sections,id',
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

            $question = CarsQuestion::create($request->all());

            // ==============================
            // 🟢 OPTIONS CONFIG
            // ==============================

            if ($question->skill_indicator == 'Parent Impression') {

                $options = [
                    ['label' => 'Normal Development', 'score' => 1],
                    ['label' => 'Mild Concerns', 'score' => 2],
                    ['label' => 'Moderate Concerns', 'score' => 3],
                    ['label' => 'Major Concerns', 'score' => 4],
                ];

            } else {

                $options = [
                    ['label' => 'Completely Normal', 'score' => 1],
                    ['label' => 'Normal with Minor Notes', 'score' => 1.5],
                    ['label' => 'Mildly Abnormal', 'score' => 2],
                    ['label' => 'Clearly Abnormal but Mild', 'score' => 2.5],
                    ['label' => 'Above Moderately Abnormal', 'score' => 3],
                    ['label' => 'Severely Abnormal', 'score' => 3.5],
                    ['label' => 'Very Severe', 'score' => 4],
                ];
            }

            // ==============================
            // 🟢 INSERT OPTIONS
            // ==============================

            foreach ($options as $index => $option) {
                CarsQuestionOption::create([
                    'id' => ($question->id * 10) + $index + 1,
                    'question_id' => $question->id,
                    'label' => $option['label'],
                    'description' => '-',
                    'score' => $option['score'],
                    'order' => $index + 1
                ]);
            }

            DB::commit();

            return response()->json([
                'msg' => 'Question created successfully',
                'status' => 201,
                'question' => $question
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'msg' => 'Error occurred',
                'status' => 500,
                'error' => $e->getMessage()
            ]);
        }
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
            'section_id'       => 'required|exists:sections,id',
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

        $updatedQuestion = CarsQuestion::with('options')->find($request->id);

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