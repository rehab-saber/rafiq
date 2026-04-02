<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsAnswer extends Model
{
    use HasFactory;

    protected $table = 'cars_answers';

    protected $primaryKey = 'id';
    public $incrementing = false; // id يدوي
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'child_id',
        'question_id',
        'option_id',
        'score',
        'severity_level',
    ];

    // ================= Relations =================

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function question()
    {
        return $this->belongsTo(CarsQuestion::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(CarsQuestionOption::class, 'option_id');
    }
}
