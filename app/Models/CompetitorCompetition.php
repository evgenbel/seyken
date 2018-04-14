<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompetitorCompetition extends Model
{

		protected $fillable = ['competitor_id', 'weight'];

    public function user()
    {
        return $this->belongsTo('App\Models\Competitor', 'competitor_id', 'id');
    }

		public function competition()
    {
        return $this->belongsTo('App\Models\Competition');
    }

		public function kata()
		{
				return $this->belongsTo('App\Models\Kate', 'kate_id', 'id');
		}

		public function points()
		{
				return $this->hasMany('App\Models\Point', 'cс_id', 'id');
		}

		public function getPointRound($round){
        if (!$round)
            $round = $this->competition->round;
        return DB::table('points')->where('round', $round)
            ->where('cс_id', $this->id)
            ->join('kates', 'kates.id', '=', 'points.kate_id')
            ->select(DB::raw('AVG(point*kates.koef) as point'))
            ->first()->point;
    }

		public function scopePoint($filter, $round = false){
        if (!$round)
            $round = $this->competition->round;
        return DB::table('points')->where('round', $round)
            ->where('cс_id', $this->id)
            ->join('kates', 'kates.id', '=', 'points.kate_id')
            ->select(DB::raw('AVG(point*kates.koef) as point'))
            ->first()->point;
//
//    		return $this->kata?$this->points->where('round', $round)
//                ->avg('point') * $this->kata->koef:0;
		}

    public function scopeCurrent($query)
    {
        return $query->where('is_current',1);
    }

		public function scopeRoundPoints($filter, $round = false)
		{
        if (!$round)
            $round = (int)$this->competition->round;

				return DB::table('points')->where('round', $round)
						->where('cс_id', $this->id)
						->join('users', 'users.id', '=', 'points.user_id')
						->join('kates', 'kates.id', '=', 'points.kate_id')
						->select('points.user_id','users.name', DB::raw('AVG(point*kates.koef) as point'))
						->groupBy('points.user_id', 'users.name')->get();
    }
}
