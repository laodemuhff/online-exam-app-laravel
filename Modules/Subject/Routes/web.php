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

Route::group(['prefix' => 'subject', 'middleware' => ['validate_session']], function(){
    Route::get('/', 'SubjectController@index')->name('subject.list');
    Route::post('/update/{id}', 'SubjectController@update')->name('subject.update');
    Route::post('/store', 'SubjectController@store')->name('subject.store');
    Route::delete('/delete/{id}', 'SubjectController@delete')->name('subject.delete');
});
