<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSetting extends Model
{
    use HasFactory;
    protected $table = 'doctor_settings';

    protected $fillable = [
        'doctor_id',
        'main_notifications',
        'appointment_reminders',
        'progress_alerts',
        'massage_alerts',
        'online_consultations',
        'clinic_visits',
        'chat_status',
    ];

    protected $casts = [
        'main_notifications' => 'boolean',
        'appointment_reminders' => 'boolean',
        'progress_alerts' => 'boolean',
        'massage_alerts' => 'boolean',
        'online_consultations' => 'boolean',
        'clinic_visits' => 'boolean',
        'chat_status' => 'boolean',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}