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

Route::get('login', 'Admin\AuthController@login')->name('login')->middleware('guest');
Route::post('login', 'Admin\AuthController@loginPost')->name('admin.login.post');

Route::group(['middleware' => ['validate_session']], function(){
	Route::get('/', 'Admin\AuthController@dashboard')->name('admin.dashboard');
	Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');
});
