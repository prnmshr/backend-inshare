<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  
{
    use HasApiTokens;
    use HasFactory;

    protected $primaryKey = 'user_id'; // Primary Key
    public $incrementing = false;     // Non-incrementing ID (varchar)
    protected $keyType = 'string';    // Key type is string
    protected $fillable = [
        'user_id', 'username', 'name', 'password', 'email', 'phone', 'bio', 'joined_at', 'profile_photo',
    ];

    // Relasi ke Post
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    // Relasi ke Story
    public function stories()
    {
        return $this->hasMany(Story::class, 'user_id', 'user_id');
    }

    // Relasi ke Notification
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'user_id');
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo 
            ? asset('storage/' . $this->profile_photo) 
            : asset('images/default-profile.jpg'); // URL gambar default
    }
}
