<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsQuestion extends Model
{
    use HasFactory;

    protected $table = 'cars_questions';

    protected $primaryKey = 'id';
    public $incrementing = false;   // لأن id يدوي
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'title',
        'question_text',
        'skill_indicator',
        'section_id',
    ];

    /* ================= Relations ================= */

   // cars_questions 1 ---- * cars_question_options
    public function options()
    {
        return $this->hasMany(CarsQuestionOption::class, 'question_id');
    }

    // cars_questions 1 ---- * cars_answers
    public function answers()
    {
        return $this->hasMany(CarsAnswer::class, 'question_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    // cars_questions 1 ---- * cars_to_lovas_mappings
    // public function lovasMappings()
    // {
    //     return $this->hasMany(CarsToLovasMapping::class, 'cars_question_id');
    // }
}
