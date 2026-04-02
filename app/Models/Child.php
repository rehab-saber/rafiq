<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $table = 'children';
    protected $primaryKey = 'id';

    public $incrementing = false; // id يدوي
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'name',
        'gender',
        'age',
        'autism_level',
        'parent_id',
    ];

    // ================= Relations =================
    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }
}
