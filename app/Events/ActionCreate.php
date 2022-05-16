<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;
use App\Models\Event;


class ActionCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Экземпляр заказа.
     *
     * @var \App\Models\Order
     */
    public $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {

        //
        $this->event = $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
