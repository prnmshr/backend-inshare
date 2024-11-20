<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = 'like_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'like_id', 'post_id', 'user_id', 'created_at'
    ];

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
