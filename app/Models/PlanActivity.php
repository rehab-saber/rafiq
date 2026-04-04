<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanActivity extends Model
{
    use HasFactory;

    protected $table = 'plan_activities';

    protected $primaryKey = 'id';

    protected $fillable = [
        'activity_id',
        'plan_id',
        'target_repetitions',
        'doctor_notes',
        'order_number',
    ];

    /* ================= Relations ================= */

    // plan_activities * ---- 1 plans
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    // plan_activities * ---- 1 activities
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}