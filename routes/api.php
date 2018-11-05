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
		return ['round'=>$c->round, 'group'=>$c->group->name];
});

Route::get('/cinfo', function () {
		$c = App\Models\Competition::current()->first();
		if ($c){
				$cc = $c->currentCompetitor->first();

				if ($cc){
						$cc->kata;
						$cc->user;
            $points = $cc->getPoints();
            $sum = 0;
            foreach ($points as $point){
                $sum += $point->point;
            }
            $cc->sum = $sum;
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
		        if ($c->group_id!=$competitor->user->group_id)
		            continue;
//            $competitor->point = $competitor->getPointRound($c->round);
            $points = $competitor->getPoints();
            $sum = 0;
            $last_round = 0;
            $res_points = [];
            for($i=1; $i<=$c->round; $i++){
                $res_points[$i] = (object)['round'=>$i, 'point'=>0];
            }

            foreach($points as $point){
                $sum += $point->point;
                $last_round = $point->round;
                $res_points[$last_round] = $point;
            }
		        $result[] = [
		            'round'   =>  $c->round,
		            'fio'   =>  $competitor->user->fio,
                    'disabled'  =>  $competitor->disabled_round==$c->round,
		            'date_birth'   =>  $competitor->user->date_birth,
		            'points'   =>  $res_points,
		            'point'   =>  $sum
            ];
        }
        usort($result, function($a1, $a2){
            $point1 = 0;
            $point2 = 0;
            if (isset($a1['points']))
            foreach ($a1['points'] as $point){
                $point1 += $point->point;
            }
            if (isset($a2['points']))
            foreach ($a2['points'] as $point){
                $point2 += $point->point;
            }
            $res = $point2-$point1;
            return $res>0?1:(($res<0)?-1:0);
        });
		    foreach ($result as $k=>&$item){
		        $item['num'] = $k+1;
        }
		}
		return $result;
});