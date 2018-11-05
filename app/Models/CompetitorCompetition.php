<?php

namespace App\Models;

use App\Events\UserUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompetitorCompetition extends Model
{

    protected $fillable = ['competitor_id', 'weight'];

    public static function boot()
    {
        parent::boot();
        CompetitorCompetition::updating(function(CompetitorCompetition $model){
            event(new UserUpdated($model));
        });
    }

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
            return $this->hasMany('App\Models\Point', 'cc_id', 'id');
    }

    public function getPointRound($round){
    if (!$round)
        $round = $this->competition->round;
    return DB::table('points')->where('round', $round)
        ->where('cc_id', $this->id)
        ->join('kates', 'kates.id', '=', 'points.kate_id')
        ->select(DB::raw('AVG(point*kates.koef) as point'))
        ->first()->point;
    }

    public function getPoints(){
    return DB::table('points')
        ->where('cc_id', $this->id)
        ->join('kates', 'kates.id', '=', 'points.kate_id')
        ->select('round',DB::raw('AVG(point*kates.koef) as point'))
        ->groupBy('round')
        ->orderBy('round')->get();
    }

    public function scopePoint($filter, $round = false){
    if (!$round)
        $round = $this->competition->round;
    return DB::table('points')->where('round', $round)
        ->where('cc_id', $this->id)
        ->join('kates', 'kates.id', '=', 'points.kate_id')
        ->select(DB::raw('AVG(point*kates.koef) as point'))
        ->first()->point;
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
                ->where('cc_id', $this->id)
                ->join('users', 'users.id', '=', 'points.user_id')
                ->join('kates', 'kates.id', '=', 'points.kate_id')
                ->select('points.user_id','users.name', DB::raw('AVG(point*kates.koef) as point'))
                ->groupBy('points.user_id', 'users.name')->get();
    }

    public function is_pointed($round, $user){
        return $this->points()->where('cc_id', $this->id)->where('round', $round)->where('user_id', $user)->get();
    }
}
