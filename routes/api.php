<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/round', function () {
		$c = App\Models\Competition::current()->first();
		return $c->round;
});

Route::get('/cinfo', function () {
		$c = App\Models\Competition::current()->first();
		if ($c){
				$cc = $c->currentCompetitor->first();
				if ($cc){
						$cc->kata;
						$cc->user;
						$cc->point = $cc->point();
				}
		}
		return $cc;
});

Route::get('/points', function () {
		$c = App\Models\Competition::current()->first();
		if ($c){
				$cc = $c->currentCompetitor->first();
				$points = [];
				if ($cc){
            $points = $cc->roundPoints();
        }
		}
		return $points;
});

Route::get('/roundResult', function () {
		$c = App\Models\Competition::current()->first();
		if ($c){
		    $result = [];
		    foreach ($c->competitors as $competitor){
		        if ($competitor->disabled_round>0 && $competitor->disabled_round<$c->round)
		            continue;
            $competitor->point = $competitor->getPointRound($c->round);
		        $result[] = [
		            'fio'   =>  $competitor->user->fio,
                'disabled'  =>  $competitor->disabled_round==$c->round,
		            'date_birth'   =>  $competitor->user->date_birth,
		            'point'   =>  $competitor->getPointRound($c->round)
            ];
        }
        usort($result, function($a1, $a2){
            $res = ($a2['point']??0)-($a1['point']??0);
            return $res>0?1:(($res<0)?-1:0);
        });
		    foreach ($result as $k=>&$item){
		        $item['num'] = $k+1;
        }
		}
		return $result;
});