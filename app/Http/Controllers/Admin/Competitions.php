<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competition;
use App\Models\Competitor;
use App\Models\Kate;
use App\Models\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Competitions extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$competitions = Competition::orderBy('start', 'DESC')->paginate(10);

				return view('admin.competition.list', [
						'competitions'	=>	$competitions
				]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				return view('admin.competition.create',[
						'kata'	=>	Kate::all(),
						'competitors'	=>	Competitor::all(),
						'groups'	=>	Group::all(),
				]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				$this->validate($request, [
						'name' => 'required|max:255',
				]);

				$competition = Competition::create([
						'name' => $request->name,
						'start' => Carbon::createFromFormat('d.m.Y', $request->start)->toDateTimeString() ,
						'end' => Carbon::createFromFormat('d.m.Y', $request->end)->toDateTimeString(),
						'round' => 1,
                        'group_id'  =>  $request->group_id
				]);
				$competition->kates()->sync($request->kata);;
				foreach ($request->competitor as $c){
						$competition->competitors()->create([
								'competitor_id'=>$c,
								'weight'	=>	1
						]);
				}
				$competition->save();
				return redirect(route('admin.competition'));
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
    public function edit(Competition $competition)
    {
        //
				return view('admin.competition.edit', [
						'competition'	=>	$competition,
						'kata'	=>	Kate::all(),
//						'users'	=>	User::where('is_admin',0)->get(),
						'competitors'	=>	Competitor::all()
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        //
				$this->validate($request, [
						'name' => 'required|max:255',
				]);

				$competition->name = $request->name;
				$competition->start =  Carbon::createFromFormat('d.m.Y', $request->start)->toDateTimeString();
				$competition->end =  Carbon::createFromFormat('d.m.Y', $request->end)->toDateTimeString();
				$competition->kates()->sync($request->kata);
//				$competition->users()->sync($request->user);
                if (!empty($request->competitor))
                    foreach ($request->competitor as $c) {
                        $competition->competitors()->create([
                            'competitor_id' => $c,
                            'weight' => 1
                        ]);
                    }
				$competition->save();
				return redirect(route('admin.competition'));
    }

    public function removeCompetitor(Request $request, Competition $competition){
//				$this->validate($request, [
//						'competitor' => 'required|int',
//				]);
//				var_dump($request->competitor);
//				return $competition->name;
				$competition->competitors()->find($request->competitor)->delete();
				return redirect(route('admin.competition.edit', ['id'=>$competition->id]));
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

		public function next(Competition $competition)
		{
			$competition->round++;
			$competition->save();
			return redirect(route('admin.competition'));
    }

		public function prev(Competition $competition)
		{
				if ($competition->round>1){
						$competition->round--;
						$competition->save();
				}
			return redirect(route('admin.competition'));
    }
}
