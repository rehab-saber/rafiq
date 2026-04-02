<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsQuestionOption extends Model
{
    use HasFactory;

    protected $table = 'cars_question_options';
    protected $primaryKey = 'id';

    public $incrementing = false; // id يدوي
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'label',
        'description',
        'score',
        'question_id',
    ];

    // ================= Relations =================
    public function question()
    {
        return $this->belongsTo(CarsQuestion::class, 'question_id');
    }
}
