<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VoteCountUpdated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $target_id;
    public $target_type;
    public $vote_count;

    public function __construct($target_id, $target_type, $vote_count) {
        $this->target_id = $target_id;
        $this->target_type = $target_type;
        $this->vote_count = $vote_count;
    }

    public function broadcastOn() {
        return new Channel('threads');
    }
}
