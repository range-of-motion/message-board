<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentCreated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thread;
    public $created_at;
    public $message;

    public function __construct($thread, $created_at, $message) {
        $this->thread = $thread;
        $this->created_at = $created_at;
        $this->message = $message;
    }

    public function broadcastOn() {
        return new Channel('threads');
    }
}
