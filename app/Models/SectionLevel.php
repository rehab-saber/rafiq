<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionLevel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'level_number',
        'section_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}