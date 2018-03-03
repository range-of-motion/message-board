<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Thread;

class Comment extends Model {
    protected $appends = ['vote_count'];

    protected $visible = ['id', 'created_at', 'thread_id', 'message', 'vote_count'];

    public function thread() {
        return $this->belongsTo(Thread::class);
    }

    public function votes() {
        return $this->morphMany(Vote::class, 'voteable');
    }

    // Accessors
    public function getVoteCountAttribute() {
        return $this->votes->where('type', 1)->count() - $this->votes->where('type', 0)->count();
    }
}
