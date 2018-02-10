<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Thread;

class Comment extends Model {
    protected $visible = ['id', 'created_at', 'thread_id', 'message'];

    public function thread() {
        return $this->belongsTo(Thread::class);
    }
}
