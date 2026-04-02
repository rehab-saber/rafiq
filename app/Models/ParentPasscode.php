<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentPasscode extends Model
{
    use HasFactory;
    protected $table = 'parent_passcodes';

    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'id',
        'doctor_id',
        'code',
        'is_used'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
