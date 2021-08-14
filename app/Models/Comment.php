<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 'user_id', 'post_id', 'client_id'
    ]; //end of fillable

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    } //end of returning the createdAt as simple date 

    public function user()
    {
        return $this->belongsTo(User::class);
    } //end of user relation

    public function client()
    {
        return $this->belongsTo(Client::class);
    } //end of user relation

    public function post()
    {
        return $this->belongsTo(Post::class);
    } //end of post relation
}
