<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialStory extends Model
{
    protected $table = 'social_stories';

    protected $fillable = [
        'section_id',
        'title',
        'summary',
        'content',
        'user_progress',
        'language',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function media()
    {
        return $this->hasMany(StoryMedia::class, 'story_id')->orderBy('order_index');
    }
}