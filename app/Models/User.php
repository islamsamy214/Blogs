<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('images/users/' . $this->image);
    } //end of retreving image directly

    public function posts()
    {
        return $this->hasMany(Post::class);
    } //end of posts relation

    public function comments()
    {
        return $this->hasMany(Comment::class);
    } //end of comments relation
}
