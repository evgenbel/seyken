<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'date_birth'
    ];

    protected $fillable = [
    		'fio',
    		'city',
    		'school',
    		'date_birth',
    		'weight',
		];
    //

		public function competitions()
		{
				return $this->hasMany('App\Models\CompetitorCompetition');
		}
}
