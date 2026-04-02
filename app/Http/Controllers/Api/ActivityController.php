<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{

    // =========================
    // GET ALL ACTIVITIES
    // =========================
    public function index()
    {
        $activities = Activity::with('level')->get();

        return response()->json([
            'msg' => 'Return all activities',
            'status' => 200,
            'activities' => $activities
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    // =========================
    // GET ACTIVITY BY ID
    // =========================
    public function show($id)
    {
        $activity = Activity::with('level')->find($id);

        if ($activity) {
            return response()->json([
                'msg' => 'Activity found',
                'status' => 200,
                'activity' => $activity
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg' => 'Activity not found',
            'status' => 404,
            'activity' => null
        ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    // =========================
    // CREATE ACTIVITY
    // =========================
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'type' => 'required|in:game,image,audio,video,article',

            'media_type' => 'required_if:type,image,audio,video|nullable|in:image,audio,video',

            'media_path' => 'required_if:type,image,audio,video|nullable|string|max:255',

            'duration' => 'required_if:type,video,audio|nullable|integer|min:1',

            'max_score' => 'required_if:type,game|nullable|integer|min:1',

            'section_level_id' => 'required|exists:section_levels,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $activity = Activity::create($request->all());

        return response()->json([
            'msg' => 'Activity created successfully',
            'status' => 201,
            'activity' => $activity
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    // =========================
    // UPDATE ACTIVITY
    // =========================
    public function update(Request $request)
    {

        $old_id = $request->old_id;

        $activity = Activity::find($old_id);

        if (!$activity) {
            return response()->json([
                'msg' => 'Activity not found',
                'status' => 404,
                'activity' => null
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [

            'id' => 'required|integer|unique:activities,id,' . $old_id,

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'type' => 'required|in:game,image,audio,video,article',

            'media_type' => 'required_if:type,image,audio,video|nullable|in:image,audio,video',

            'media_path' => 'required_if:type,image,audio,video|nullable|string|max:255',

            'duration' => 'required_if:type,video,audio|nullable|integer|min:1',

            'max_score' => 'required_if:type,game|nullable|integer|min:1',

            'section_level_id' => 'required|exists:section_levels,id',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('activities')
            ->where('id', $old_id)
            ->update([
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'media_type' => $request->media_type,
                'media_path' => $request->media_path,
                'duration' => $request->duration,
                'max_score' => $request->max_score,
                'section_level_id' => $request->section_level_id,
            ]);

        $updatedActivity = Activity::with('level')->find($request->id);

        return response()->json([
            'msg' => 'Activity updated successfully',
            'status' => 200,
            'activity' => $updatedActivity
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    // =========================
    // DELETE ACTIVITY
    // =========================
    public function delete($id)
    {

        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'msg' => 'Activity not found',
                'status' => 404,
                'activity' => null
            ], 404, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $activity->delete();

        return response()->json([
            'msg' => 'Activity deleted successfully',
            'status' => 200,
            'activity' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}