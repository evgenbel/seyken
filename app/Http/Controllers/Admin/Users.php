<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

class Users extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$users = User::where('is_admin', 0)->paginate(10);

				return view('admin.user.list', [
						'users'	=>	$users
				]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				return view('admin.user.create');
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
						'name' => 'required|string|max:255',
						'email' => 'required|string|email|max:255|unique:users',
						'password' => 'required|string|min:6|confirmed',
				]);

				User::create([
						'name' => $request->name,
						'email' => $request->email,
						'set_kata' => $request->set_kata,
						'password' => Hash::make($request->password)
				]);

				return redirect(route('admin.user'));
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
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
				return view('admin.user.edit', [
						'user'	=>	$user
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
				$this->validate($request, [
						'name' => 'required|string|max:255',
						'email' => 'required|string|email|max:255|unique:users',
						'password' => 'required|string|min:6|confirmed',
				]);

				$user->name = $request->name;
				$user->email = $request->email;
				$user->set_kata = $request->set_kata;
				$user->password = Hash::make($request->password);
				$user->save();

				return redirect(route('admin.user'));
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
