<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competitor;
use App\Models\Kate;
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
				$competitors = Competitor::paginate(10);

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
				return view('admin.competitor.create');
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

				Competitor::create([
						'fio' => $request->fio,
						'city' => $request->city,
						'school' => $request->school,
						'date_birth' => $request->date_birth,
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
				return view('admin.competitor.edit', [
						'competitor'	=>	$competitor
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
						'name' => 'required|max:255',
				]);

				$competitor->fio = $request->fio;
				$competitor->city = $request->city;
				$competitor->school = $request->school;
				$competitor->date_birth = $request->date_birth;
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
