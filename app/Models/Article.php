<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'section_id',
        'title',
        'summary',
        'content',
        'read_time_minutes',
        'media_path',
        'source_url',
        'is_published',
        'language',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function bookmarkedByParents()
    {
        return $this->belongsToMany(Parents::class, 'article_bookmarks', 'article_id', 'parent_id')
                    ->withTimestamps();
    }
}