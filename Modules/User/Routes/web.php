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

Route::group(['prefix' => 'user', 'middleware' => 'validate_session'], function() {
    Route::get('list/{level}', 'UserController@index')->name('user')->middleware('feature_control:user.management.list');
    Route::get('/create', 'UserController@create')->name('user.create')->middleware('feature_control:user.management.create');
    Route::post('/store', 'UserController@store')->name('user.store')->middleware('feature_control:user.management.create');
    Route::get('/edit/{id}', 'UserController@edit')->name('user.edit')->middleware('feature_control:user.management.update');
    Route::post('/update/{id}', 'UserController@update')->name('user.update')->middleware('feature_control:user.management.update');
    Route::delete('/delete/{id}', 'UserController@delete')->name('user.delete')->middleware('feature_control:user.management.delete');
    Route::get('/info/{id}', 'UserController@info')->name('user.info')->middleware('feature_control:user.management.info');
});

