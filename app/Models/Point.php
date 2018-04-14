<?php

namespace App\Models;

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

    public function kata()
    {
        return $this->belongsTo('App\Models\Kate', 'kate_id', 'id');
    }
}
