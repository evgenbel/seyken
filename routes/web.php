<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('home');
Route::get('/test', 'WelcomeController@test');
Route::post('/', 'WelcomeController@points');
Route::post('/kata', 'WelcomeController@kata');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/admin', 'Admin\Home@index');
Route::get('/next/{id}', 'Admin\Home@next')->name('nextCompetitor');
Route::get('/endround', 'Admin\Home@endround')->name('endround');
Route::post('/disbaledround', 'Admin\Home@disbaledround')->name('disbaledround');
Route::get('/nextround', 'Admin\Home@nextround')->name('nextround');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
		Route::resource('competitions', 'Competitions', [
				'names'	=>	[
						'index'	=>	'competition',
						'create'	=>	'competition.new',
						'store'	=>	'competition.store',
						'edit'	=>	'competition.edit',
						'update'	=>	'competition.update',
				]
		]);

		Route::resource('kates', 'Kates', [
				'names'	=>	[
						'index'	=>	'kate',
						'create'	=>	'kate.new',
						'store'	=>	'kate.store',
						'edit'	=>	'kate.edit',
						'update'	=>	'kate.update',
				]
		]);

		Route::resource('competitor', 'Competitors', [
				'names'	=>	[
						'index'	=>	'competitor',
						'create'	=>	'competitor.new',
						'store'	=>	'competitor.store',
						'edit'	=>	'competitor.edit',
						'update'	=>	'competitor.update',
				]
		]);

		Route::resource('user', 'Users', [
				'names'	=>	[
						'index'	=>	'user',
						'create'	=>	'user.new',
						'store'	=>	'user.store',
						'edit'	=>	'user.edit',
						'update'	=>	'user.update',
				]
		]);

		Route::resource('group', 'Groups', [
				'names'	=>	[
						'index'	=>	'group',
						'create'	=>	'group.new',
						'store'	=>	'group.store',
						'edit'	=>	'group.edit',
						'update'	=>	'group.update',
				]
		]);

		Route::get('next/{competition}', 'Competitions@next')->name('competition.next');
		Route::get('prev/{competition}', 'Competitions@prev')->name('competition.prev');
		Route::get('remove/{competition}/{competitor}', 'Competitions@removeCompetitor')->name('competition.remove');
});
