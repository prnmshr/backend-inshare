<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'post_id', 'user_id', 'caption', 'media_url', 'created_at', 'tag'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke Comment
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id');
    }

    // Relasi ke Like
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'post_id');
    }
}
