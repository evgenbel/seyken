<?php

namespace App\Models;

use App\Events\PointUpdated;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
		protected $fillable = [
			'point_type',
			'point',
			'round',
		  'user_id',
      'kate_id'
		];
    //

    public static function boot()
    {
        parent::boot();
        Point::updating(function(Point $model){
            event(new PointUpdated($model));
        });
    }

    public function kata()
    {
        return $this->belongsTo('App\Models\Kate', 'kate_id', 'id');
    }

    public function competitor()
    {
        return $this->belongsTo(CompetitorCompetition::class, 'cc_id', 'id');
    }
}
