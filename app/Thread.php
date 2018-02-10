<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Comment;

class Thread extends Model {
    protected $visible = ['id', 'created_at', 'title'];

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
