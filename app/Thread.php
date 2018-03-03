<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Comment;
use App\Vote;

class Thread extends Model {
    protected $appends = ['vote_count'];

    protected $visible = ['id', 'created_at', 'title', 'comments', 'vote_count'];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function votes() {
        return $this->morphMany(Vote::class, 'voteable');
    }

    // Accessors
    public function getVoteCountAttribute() {
        return $this->votes->where('type', 1)->count() - $this->votes->where('type', 0)->count();
    }
}
