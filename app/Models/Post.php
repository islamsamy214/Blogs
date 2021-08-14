<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'image', 'user_id', 'category_id'
    ]; //end of fillable

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    } //end of returning the createdAt as simple date 

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('images/posts/' . $this->image);
    } //end of retreving image directly

    public function user()
    {
        return $this->belongsTo(User::class);
    } //end of user relation

    public function category()
    {
        return $this->belongsTo(Category::class);
    } //end of category relation

    public function comments()
    {
        return $this->hasMany(Comment::class);
    } //end of comments relation
}
