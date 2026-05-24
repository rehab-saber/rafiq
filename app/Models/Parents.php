<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Parents extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'parents';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'doctor_id',
        'status',
        'provider_name',
        'provider_id',
        'city',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function complaints()
    {
        return $this->morphMany(Complaint::class, 'sender');
    }
    // ✅ Bookmark
    public function bookmarkedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_bookmarks', 'parent_id', 'article_id')
                    ->withTimestamps();
    }
}