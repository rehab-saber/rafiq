<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialStory;
use App\Models\StoryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SocialStoryController extends Controller
{
    // =========================
    // GET ALL STORIES
    // =========================
    public function index(Request $request)
    {
        $stories = SocialStory::with(['section', 'media'])
            ->when($request->language, fn($q) => $q->where('language', $request->language))
            ->get();

        return response()->json([
            'msg'     => 'Return all stories',
            'status'  => 200,
            'stories' => $stories
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET SINGLE STORY BY ID
    // =========================
    public function show($id)
    {
        $story = SocialStory::with(['section', 'media'])->find($id);

        if (!$story) {
            return response()->json([
                'msg'    => 'Story not found',
                'status' => 404,
                'story'  => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg'    => 'Story found',
            'status' => 200,
            'story'  => $story
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET STORIES BY SECTION
    // =========================
    public function getBySection(Request $request, $section_id)
    {
        $stories = SocialStory::with(['section', 'media'])
            ->where('section_id', $section_id)
            ->when($request->language, fn($q) => $q->where('language', $request->language))
            ->get();

        return response()->json([
            'msg'     => 'Return stories by section',
            'status'  => 200,
            'stories' => $stories
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // SEARCH STORIES
    // =========================
    public function search(Request $request)
    {
        // لو مفيش search term
        if (!$request->filled('search')) {
            return response()->json([
                'msg'     => 'Search term is required',
                'status'  => 422,
                'stories' => []
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $stories = SocialStory::with(['section', 'media'])
            ->when($request->language, fn($q) => $q->where('language', $request->language))
            ->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('summary', 'like', '%' . $request->search . '%');
            })
            ->get();

        // لو مفيش نتايج
        if ($stories->isEmpty()) {
            return response()->json([
                'msg'     => 'No stories found',
                'status'  => 404,
                'stories' => []
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg'     => 'Search results',
            'status'  => 200,
            'stories' => $stories
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // CREATE STORY
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id'         => 'nullable|exists:sections,id',
            'title'              => 'required|string',
            'summary'            => 'nullable|string',
            'content'            => 'nullable|string',
            'user_progress'      => 'nullable|in:not_started,in_progress,completed',
            'language'           => 'nullable|in:en,ar',
            'media'              => 'nullable|array',
            'media.*.media_path' => 'required|string',
            'media.*.media_type' => 'required|in:image,video',
            'media.*.order_index'=> 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $story = SocialStory::create($request->only([
            'section_id', 'title', 'summary', 'content', 'user_progress', 'language'
        ]));

        if ($request->has('media')) {
            foreach ($request->media as $index => $item) {
                StoryMedia::create([
                    'story_id'    => $story->id,
                    'media_path'  => $item['media_path'],
                    'media_type'  => $item['media_type'],
                    'order_index' => $item['order_index'] ?? $index,
                ]);
            }
        }

        return response()->json([
            'msg'    => 'Story created successfully',
            'status' => 201,
            'story'  => $story->load(['section', 'media'])
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // UPDATE STORY
    // =========================
    public function update(Request $request)
    {
        $data   = json_decode($request->getContent(), true) ?? $request->all();
        $old_id = $data['old_id'] ?? null;
        $story  = SocialStory::find($old_id);

        if (!$story) {
            return response()->json([
                'msg'    => 'Story not found',
                'status' => 404,
                'story'  => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($data, [
            'id'                 => 'required|unique:social_stories,id,' . $old_id,
            'section_id'         => 'nullable|exists:sections,id',
            'title'              => 'required|string',
            'summary'            => 'nullable|string',
            'content'            => 'nullable|string',
            'user_progress'      => 'nullable|in:not_started,in_progress,completed',
            'language'           => 'nullable|in:en,ar',
            'media'              => 'nullable|array',
            'media.*.media_path' => 'required|string',
            'media.*.media_type' => 'required|in:image,video',
            'media.*.order_index'=> 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('social_stories')
            ->where('id', $old_id)
            ->update([
                'id'            => $data['id'],
                'section_id'    => $data['section_id'] ?? $story->section_id,
                'title'         => $data['title'],
                'summary'       => $data['summary'] ?? $story->summary,
                'content'       => $data['content'] ?? $story->content,
                'user_progress' => $data['user_progress'] ?? $story->user_progress,
                'language'      => $data['language'] ?? $story->language,
            ]);

        if (isset($data['media'])) {
            StoryMedia::where('story_id', $old_id)->delete();
            foreach ($data['media'] as $index => $item) {
                StoryMedia::create([
                    'story_id'    => $data['id'],
                    'media_path'  => $item['media_path'],
                    'media_type'  => $item['media_type'],
                    'order_index' => $item['order_index'] ?? $index,
                ]);
            }
        }

        $updatedStory = SocialStory::with(['section', 'media'])->find($data['id']);

        return response()->json([
            'msg'    => 'Story updated successfully',
            'status' => 200,
            'story'  => $updatedStory
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // DELETE STORY
    // =========================
    public function delete($id)
    {
        $story = SocialStory::find($id);

        if (!$story) {
            return response()->json([
                'msg'    => 'Story not found',
                'status' => 404,
                'story'  => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $story->delete();

        return response()->json([
            'msg'    => 'Story deleted successfully',
            'status' => 200,
            'story'  => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}