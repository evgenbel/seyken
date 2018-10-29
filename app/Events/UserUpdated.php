<?php

namespace App\Events;

use App\Models\Competition;
use App\Models\CompetitorCompetition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CompetitorCompetition $model)
    {
        //
        $user = $model->user;
        if (isset($model->kata))
            $kataname = $model->kata->name;
        $this->user = $model;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['change-competitor'];
    }

    //Транслировать короткое имя события без полного namespace path
    public function broadcastAs()
    {
        return ['UserUpdated'];
    }
}
