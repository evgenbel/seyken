<?php

namespace App\Events;

use App\Models\Competition;
use App\Models\CompetitorCompetition;
use App\Models\Point;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PointUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $points;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Point $model)
    {
        //
        $competitor = $model->competitor;
        $round = $competitor->competition->round;
        $current = 0;
        $sum = 0;
        foreach ($competitor->getPoints() as $point){
            $sum += $point->point;
            if ($point->round == $round)
                $current = $point->point;
        }
        $this->points = [
            'current'   =>  round($current, 2),
            'sum'   =>  round($sum, 2),
        ];
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
        return ['PointUpdated'];
    }
}
