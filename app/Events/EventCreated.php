<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;
    public $userId;
    public function __construct($event, $userId)
    {
        $this->event = $event;
        $this->userId = $userId;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('event.created.'  . $this->event->id . '.' . $this->userId);
    }
}
