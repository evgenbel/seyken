<?php

namespace App\Events;

use App\Models\Competition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RoundUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $round;
    public $group;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Competition $model)
    {
        //
				$this->round=$model->round;
				$this->group=$model->group->name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['change-round'];
    }

    //Транслировать короткое имя события без полного namespace path
    public function broadcastAs()
    {
        return ['RoundUpdated'];
    }
}
