<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kate;
use Illuminate\Http\Request;

class Kates extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$kates = Kate::paginate(10);

				return view('admin.kate.list', [
						'kates'	=>	$kates
				]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				return view('admin.kate.create');
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

				Kate::create([
						'name' => $request->name,
						'koef' => $request->koef
				]);

				return redirect(route('admin.kate'));
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
    public function edit(Kate $kate)
    {
        //
				return view('admin.kate.edit', [
						'kate'	=>	$kate
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kate $kate)
    {
        //
				$this->validate($request, [
						'name' => 'required|max:255',
				]);

				$kate->name = $request->name;
				$kate->koef = $request->koef;
				$kate->save();

				return redirect(route('admin.kate'));
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
