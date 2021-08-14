<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;
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
        return asset('images/clients/' . $this->image);
    } //end of retreving image directly

    public function comments()
    {
        return $this->hasMany(Comment::class);
    } //end of comments relation
}
