<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    // =========================
    // GET ALL ARTICLES + SEARCH
    // =========================
    public function index(Request $request)
    {
        // لو في search term، تحقق منه
        if ($request->has('search')) {

            // لو فاضي
            if (!$request->filled('search')) {
                return response()->json([
                    'msg'      => 'Search term is required',
                    'status'   => 422,
                    'articles' => []
                ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

            $articles = Article::with('section')
                ->when($request->language, fn($q) => $q->where('language', $request->language))
                ->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('summary', 'like', '%' . $request->search . '%');
                })
                ->get();

            // لو مفيش نتايج
            if ($articles->isEmpty()) {
                return response()->json([
                    'msg'      => 'No articles found',
                    'status'   => 404,
                    'articles' => []
                ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

            return response()->json([
                'msg'      => 'Search results',
                'status'   => 200,
                'articles' => $articles
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        // لو مفيش search، هات كل الـ articles عادي
        $articles = Article::with('section')
            ->when($request->language, fn($q) => $q->where('language', $request->language))
            ->get();

        return response()->json([
            'msg'      => 'Return all articles',
            'status'   => 200,
            'articles' => $articles
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET SINGLE ARTICLE BY ID
    // =========================
    public function show($id)
    {
        $article = Article::with('section')->find($id);

        if (!$article) {
            return response()->json([
                'msg'     => 'Article not found',
                'status'  => 404,
                'article' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'msg'     => 'Article found',
            'status'  => 200,
            'article' => $article
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET ARTICLES BY SECTION
    // =========================
    public function getBySection(Request $request, $section_id)
    {
        $articles = Article::with('section')
            ->where('section_id', $section_id)
            ->when($request->language, fn($q) => $q->where('language', $request->language))
            ->get();

        return response()->json([
            'msg'      => 'Return articles by section',
            'status'   => 200,
            'articles' => $articles
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // CREATE ARTICLE
    // =========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id'        => 'nullable|exists:sections,id',
            'title'             => 'required|string',
            'summary'           => 'required|string',
            'content'           => 'nullable|string',
            'read_time_minutes' => 'nullable|integer',
            'media_path'        => 'nullable|string',
            'source_url'        => 'nullable|url',
            'is_published'      => 'nullable|boolean',
            'language'          => 'nullable|in:en,ar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $article = Article::create($request->all());

        return response()->json([
            'msg'     => 'Article created successfully',
            'status'  => 201,
            'article' => $article
        ], 201, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // UPDATE ARTICLE
    // =========================
    public function update(Request $request)
    {
        $old_id  = $request->old_id;
        $article = Article::find($old_id);

        if (!$article) {
            return response()->json([
                'msg'     => 'Article not found',
                'status'  => 404,
                'article' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $validator = Validator::make($request->all(), [
            'id'                => 'required|unique:articles,id,' . $old_id,
            'section_id'        => 'nullable|exists:sections,id',
            'title'             => 'required|string',
            'summary'           => 'required|string',
            'content'           => 'nullable|string',
            'read_time_minutes' => 'nullable|integer',
            'media_path'        => 'nullable|string',
            'source_url'        => 'nullable|url',
            'is_published'      => 'nullable|boolean',
            'language'          => 'nullable|in:en,ar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'    => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        DB::table('articles')
            ->where('id', $old_id)
            ->update([
                'id'                => $request->id,
                'section_id'        => $request->section_id,
                'title'             => $request->title,
                'summary'           => $request->summary,
                'content'           => $request->content,
                'read_time_minutes' => $request->read_time_minutes,
                'media_path'        => $request->media_path,
                'source_url'        => $request->source_url,
                'is_published'      => $request->is_published ?? $article->is_published,
                'language'          => $request->language ?? $article->language,
            ]);

        $updatedArticle = Article::with('section')->find($request->id);

        return response()->json([
            'msg'     => 'Article updated successfully',
            'status'  => 200,
            'article' => $updatedArticle
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // DELETE ARTICLE
    // =========================
    public function delete($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'msg'     => 'Article not found',
                'status'  => 404,
                'article' => null
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $article->delete();

        return response()->json([
            'msg'     => 'Article deleted successfully',
            'status'  => 200,
            'article' => null
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // TOGGLE BOOKMARK
    // =========================
    public function toggleBookmark(Request $request, $article_id)
    {
        $article = Article::find($article_id);

        if (!$article) {
            return response()->json([
                'msg'    => 'Article not found',
                'status' => 404,
            ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $parent = auth('parents')->user();

        $parent->bookmarkedArticles()->toggle($article_id);

        return response()->json([
            'msg'    => 'Bookmark updated successfully',
            'status' => 200,
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // =========================
    // GET MY BOOKMARKS
    // =========================
    public function myBookmarks(Request $request)
    {
        $parent = auth('parents')->user();

        $articles = $parent->bookmarkedArticles()
            ->with('section')
            ->get();

        return response()->json([
            'msg'      => 'My bookmarked articles',
            'status'   => 200,
            'articles' => $articles
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}