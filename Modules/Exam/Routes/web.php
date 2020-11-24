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

Route::group(['prefix' => 'exam', 'middleware' => 'validate_session'], function() {
    Route::get('/', 'ExamController@index')->name('exam.list');
    Route::get('/create', 'ExamController@create')->name('exam.create');
    Route::post('/store', 'ExamController@store')->name('exam.store');
    Route::get('/edit/{id}', 'ExamController@edit')->name('exam.edit');
    Route::post('/update/{id}', 'ExamController@update')->name('exam.update');
    Route::delete('/delete/{id}', 'ExamController@delete')->name('exam.delete');
    Route::get('/detail/{id}', 'ExamController@detail')->name('exam.detail');
});
