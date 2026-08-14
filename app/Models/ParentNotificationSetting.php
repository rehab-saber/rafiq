<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentNotificationSetting extends Model
{
    use HasFactory;

    protected $table = 'parent_notification_settings';

    protected $fillable = [
        'parent_id',
        'main_notifications',
        'activity_reminders',
        'appointment_reminders',
        'doctor_messages',
        'new_article_reminder',
    ];

    protected $casts = [
        'main_notifications'      => 'boolean',
        'activity_reminders'      => 'boolean',
        'appointment_reminders'   => 'boolean',
        'doctor_messages'         => 'boolean',
        'new_article_reminder'    => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }
}