<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'media_type',
        'media_path',
        'duration',
        'max_score',
        'section_level_id'
    ];

    public function level()
    {
        return $this->belongsTo(SectionLevel::class,'section_level_id');
    }
}