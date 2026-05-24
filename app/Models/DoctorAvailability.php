<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    use HasFactory;

    protected $table = 'doctor_availabilities';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'doctor_id',
        'date',
        'time',
        'appointment_type',
        'is_active',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    // ================= Relations =================

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'availability_id');
    }
}