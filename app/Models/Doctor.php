<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'clinic_name',
        'speciality',
        'role',
        'provider_name',   // ✅ ضيفي دي
        'provider_id', 
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
