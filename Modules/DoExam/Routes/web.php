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

Route::group(['prefix' => 'doexam', 'middleware' => 'validate_session:entry'], function() {
    Route::get('register-session', 'DoExamController@index')->name('register-session');
});
