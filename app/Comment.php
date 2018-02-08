<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Thread;

class Comment extends Model {
    public function thread() {
        return $this->belongsTo(Thread::class);
    }
}
