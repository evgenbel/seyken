<?php

namespace App\Http\Controllers;

use App\Events\PointUpdated;
use App\Events\RoundUpdated;
use App\Models\Competition;
use App\Models\CompetitorCompetition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
		public function test(){
            DB::enableQueryLog();
            $c = Competition::current()->first()->competitors->first()->points->first();
//				$c->round++;
//				$c->save();
//            dd(DB::getQueryLog());
//            dd($c->competitor()->get());
//            var_dump($c->cc_id);
//            var_dump($c);
//            $c->competitor()->get();
//            dd(DB::getQueryLog());
//            exit;
            event(new PointUpdated($c));
            exit('ok');
		}

		public function index(Competition $c)
		{
            $point_sended = false;
            $currentPoint = 0;
            $sum = 0;
            $c = Competition::current()->first();
            $current = false;
            if ($c){
                $current = $c->currentCompetitor()->with('kata')->with('user')->get()->first();

                if ($current){
                    foreach ($current->getPoints() as $point){
                        $sum += $point->point;
                        if ($point->round == $c->round)
                            $currentPoint = $point->point;
                    }

                    if (Auth::check()) {
                        $point_sended = $current->is_pointed($c->round, Auth::user()->id);
                        $point_sended = !empty($point_sended);
                    }
                }
            }

            return view('welcome', [
                'competition' => $c,
                'competitor' => $current,
                'point_sended' => $point_sended,
                'point' => round($currentPoint, 2),
                'sum' => round($sum, 2),
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
						'kata' => 'required',
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
