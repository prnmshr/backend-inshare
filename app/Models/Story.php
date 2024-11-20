<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $primaryKey = 'story_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'story_id', 'user_id', 'media_url', 'created_at', 'expiry_time'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
