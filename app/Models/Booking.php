<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'parent_id',
        'doctor_id',
        'child_id',
        'availability_id',
        'type',
        'status',
        'doctor_note',
        'parent_note',
        'confirmed_at',
        'rejected_at',
        'completed_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'rejected_at'  => 'datetime',
        'completed_at' => 'datetime',
    ];

    // ================= Relations =================

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function availability()
    {
        return $this->belongsTo(DoctorAvailability::class, 'availability_id');
    }
}