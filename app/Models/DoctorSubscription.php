<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSubscription extends Model
{
    protected $fillable = [
        'doctor_id',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function isActive()
    {
        return $this->status === 'active' && $this->end_date > now();
    }
}