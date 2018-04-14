<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kate extends Model
{
    //
		public function competitions()
		{
				return $this->belongsToMany('App\Models\Competition');
		}

		public function competitor()
		{
				return $this->hasMany('App\Models\CompetitorCompetition');
		}


}
