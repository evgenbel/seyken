<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competitor;
use App\Models\Group;
use App\Models\Kate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Competitors extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$competitors = Competitor::orderBy('group_id')->paginate(10);

				return view('admin.competitor.list', [
						'competitors'	=>	$competitors
				]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
				return view('admin.competitor.create', [
				    'groups'    =>  $groups
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
						'fio' => 'required|max:255',
						'group_id' => 'required',
						'date_birth' => 'required|date_format:d.m.Y|before:today',
				]);

				Competitor::create([
						'fio' => $request->fio,
						'group_id' => $request->group_id,
						'city' => $request->city,
						'school' => $request->school,
						'date_birth' => Carbon::createFromFormat('d.m.Y', $request->date_birth)->toDateTimeString() ,
						'weight' => $request->weight,
				]);

				return redirect(route('admin.competitor'));
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
    public function edit(Competitor $competitor)
    {
        //
        $groups = Group::all();
				return view('admin.competitor.edit', [
						'competitor'	=>	$competitor,
            'groups'    =>  $groups
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competitor $competitor)
    {
        //
				$this->validate($request, [
						'fio' => 'required|max:255',
						'group_id' => 'required',
            'date_birth' => 'required|date_format:d.m.Y|before:today',
				]);

				$competitor->fio = $request->fio;
				$competitor->group_id = $request->group_id;
				$competitor->city = $request->city;
				$competitor->school = $request->school;
				$competitor->date_birth = Carbon::createFromFormat('d.m.Y', $request->date_birth)->toDateTimeString();
				$competitor->weight = $request->weight;
				$competitor->save();

				return redirect(route('admin.competitor'));
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
