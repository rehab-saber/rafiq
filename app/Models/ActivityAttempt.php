<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityAttempt extends Model
{
    use HasFactory;

    protected $table = 'activity_attempts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'child_id',
        'plan_id',
        'activity_id',
        'score',
        'status',
        'attempt_number',
        'completed_at',
    ];

    /* ================= Relations ================= */

    // activity_attempts * ---- 1 children
    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    // activity_attempts * ---- 1 plans
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    // activity_attempts * ---- 1 activities
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}