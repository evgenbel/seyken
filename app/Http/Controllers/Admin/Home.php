<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competition;
use App\Models\CompetitorCompetition;
use App\User;
use Illuminate\Http\Request;

class Home extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$result = [];
				$c = Competition::current()->first();
				for($r = $c->round; $r>0; $r--){
						foreach ($c->competitors as $competitor){
								$points = [];
								foreach ($competitor->points as $point){
										$points[$point->user_id][$point->point_type] = $point->point * $point->kata->koef;
								}
								$result[$r][$competitor->id] = $competitor;
								$result[$r][$competitor->id]->list_point = $points;
								$result[$r][$competitor->id]->point = round($competitor->getPointRound($r), 2);
						}
						usort($result[$r], function($a1, $a2){
								return ($a1->point??0)-($a2->point??0);
						});
				}

				return view('admin.home',[
						'list'	=>	$result,
						'users'	=>	User::where('is_admin', 0)->get(),
            'currentRound'  =>  $c->round
				]);
    }

		public function next(int $id)
		{
				$c = CompetitorCompetition::current()->get()->first();
				if ($c){
						$c->is_current = 0;
						$c->save();
				}

				$c = CompetitorCompetition::find($id);
				if ($c){
						$c->is_current = 1;
						$c->save();
				}

				return redirect('/admin');
    }

		public function startround(Request $request)
		{
				$this->validate($request, [
						'exclude' => 'required',
				]);

				$c = Competition::current()->first();
				foreach ($request->exclude as $id){
					$cc = CompetitorCompetition::find($id);
					$cc->disabled_round = $c->round;
					$cc->save();
				}
				$c->round++;
				$c->save();
				return redirect('/admin');
    }

    public function endround(){
        $c = Competition::current()->first();
        foreach($c->competitors as $comp){
            $comp->is_current = 0;
            $comp->save();
        }
        return redirect('/admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
