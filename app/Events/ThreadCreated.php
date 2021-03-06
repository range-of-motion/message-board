<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Thread;

class ThreadCreated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $created_at;
    public $title;

    public function __construct($id, $created_at, $title) {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->title = $title;
    }

    public function broadcastOn() {
        return new Channel('threads');
    }
}
