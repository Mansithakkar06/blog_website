<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function reply()
    {
        return $this->hasMany(Comment::class, 'reply_id')->whereStatus("approved")->with('reply', 'user');
    }
}
