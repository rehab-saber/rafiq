<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'sender_type',
        'sender_id',
        'full_name',
        'email',
        'subject',
        'message',
        'screenshot_path',
        'status',
        'admin_notes',
    ];

    public function sender()
    {
        return $this->morphTo();
    }
}