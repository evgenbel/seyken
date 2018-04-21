<?php

namespace App\Models;

use App\Events\RoundUpdated;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
		protected $dates = [
				'created_at',
				'updated_at',
				'start',
				'end',
		];

		protected $fillable = ['name', 'start', 'end', 'round'];
    //

		public static function boot()
		{
				parent::boot();
//				Competition::updating(function(Competition $model){
////						$c = Competition::current()->first();
////						if ($c->round!=$model->round){
//								event(new RoundUpdated($model));
////						}
//				});
		}

		/**
     * текущее соревнование
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query){
        return $query->where('start','<=',date('Y-m-d'))
            ->where('end', '>=', date('Y-m-d'));
    }

    public function competitors()
    {
        return $this->hasMany('App\Models\CompetitorCompetition');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function currentCompetitor()
    {
        return $this->hasMany('App\Models\CompetitorCompetition')
            ->where('is_current', 1);
    }

		public function kates()
		{
				return $this->belongsToMany('App\Models\Kate');
		}

		public function users()
		{
				return $this->belongsToMany('App\User');
		}
}
