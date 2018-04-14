<?php

namespace App\Http\Controllers;

use App\Events\RoundUpdated;
use App\Models\Competition;
use App\Models\CompetitorCompetition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
		public function round(){
				$c = Competition::current()->first();
//				$c->round++;
//				$c->save();
//				event(new RoundUpdated($c));
		}

		public function index(Competition $c)
		{

				$point_sended = false;
				$resultPoints = [];
				$sum = 0;
				$k = 0;

				$c = Competition::current()->first();
				if ($c){
						$current = $c->currentCompetitor->first();
						if ($current){
								$resultPoints = $current->roundPoints($c->round);
						}

						foreach ($resultPoints as $p) {
								$sum += $p->point;
								$k++;
								if (Auth::check()) {
										if ($p->user_id == Auth::user()->id) {
												$point_sended = true;
										}
								}
						}
				}


				return view('welcome', [
						'competition' => $c,
						'point_sended' => $point_sended,
						'result' => $resultPoints,
						'point' => $k > 0 ? (number_format($sum / $k, 2)) : 0,
				]);
		}

		public function result(Competition $c)
		{
//				$c = Competition::current()->first();
//				foreach ($c->currentCompetitor as $cc) {
//						$resultPoints = $cc->roundPoints();
//				}
		}

		public function points(Request $request, CompetitorCompetition $cc)
		{
				$this->middleware('auth');
				$this->validate($request, [
						'action' => 'required|exists:competitor_competitions,id,is_current,1',
						'point' => 'required|array',
				]);

				$val = $cc->find($request->action);
				foreach ($request->point as $pid => $value_point) {
						$val->points()->create([
								'point_type' => $pid,
								'point' => $value_point,
								'round' => $val->competition->round,
								'user_id' => Auth::user()->id,
                'kate_id'   =>  $val->kate_id
						]);
				}

				return redirect('/');
		}

		public function kata(Request $request, CompetitorCompetition $cc)
		{
				$this->middleware('auth');
				$this->validate($request, [
						'kata' => 'required|exists:kates,id',
						'action' => 'required|exists:competitor_competitions,id,is_current,1',
				]);

				$val = $cc->find($request->action);
				if ($val) {
						$val->kate_id = $request->kata;
						$val->save();
				}

				return redirect('/');
		}
}
