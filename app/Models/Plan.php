<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $primaryKey = 'id';

    protected $fillable = [
        'doctor_id',
        'child_id',
        'source',
    ];

    /* ================= Relations ================= */

    // plans * ---- 1 doctors
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // plans * ---- 1 children
    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}