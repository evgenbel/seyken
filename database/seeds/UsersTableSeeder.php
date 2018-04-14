<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
				DB::table('users')->truncate();
				DB::table('type_points')->truncate();
				\App\User::create([
						'email' => 'admin@seyken.belov',
						'name' => 'Admin',
						'password' => Hash::make('Abra1234'),
						'is_admin' => 1
				]);

				$user = \App\User::create([
						'email' => 'user1@seyken.belov',
						'name' => 'User1',
						'password' => Hash::make('Abra123'),
						'set_kata'	=>	1
				]);
				$user->typePoints()->create([
						'name'	=>	'Скорость'
						]);
				$user->typePoints()->create([
						'name'	=>	'Сила'
				]);
				$user = \App\User::create([
						'email' => 'user2@seyken.belov',
						'name' => 'User2',
						'password' => Hash::make('Abra123')
				]);
				$user->typePoints()->create([
						'name'	=>	'Скорость'
				]);
				$user->typePoints()->create([
						'name'	=>	'Сила'
				]);
				$user = \App\User::create([
						'email' => 'user3@seyken.belov',
						'name' => 'User3',
						'password' => Hash::make('Abra123')
				]);
				$user->typePoints()->create([
						'name'	=>	'Скорость'
				]);
				$user->typePoints()->create([
						'name'	=>	'Сила'
				]);
				$user = \App\User::create([
						'email' => 'user4@seyken.belov',
						'name' => 'User4',
						'password' => Hash::make('Abra123')
				]);
				$user->typePoints()->create([
						'name'	=>	'Скорость'
				]);
				$user->typePoints()->create([
						'name'	=>	'Сила'
				]);
				$user = \App\User::create([
						'email' => 'user5@seyken.belov',
						'name' => 'User5',
						'password' => Hash::make('Abra123')
				]);
				$user->typePoints()->create([
						'name'	=>	'Скорость'
				]);
				$user->typePoints()->create([
						'name'	=>	'Сила'
				]);
    }
}
