<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryMedia extends Model
{
    protected $table = 'story_media';

    protected $fillable = [
        'story_id',
        'media_path',
        'media_type',
        'order_index',
    ];

    public function story()
    {
        return $this->belongsTo(SocialStory::class, 'story_id');
    }
}