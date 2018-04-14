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
				$points = $cc->roundPoints();
		}
		return $points;
});