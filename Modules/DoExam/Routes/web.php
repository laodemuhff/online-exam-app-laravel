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
    Route::get('home', 'DoExamController@index')->name('home')->middleware('restrict_exam_session');
    Route::get('session', 'DoExamController@showSession')->name('show-session')->middleware('restrict_exam_session');
    Route::post('register-session', 'DoExamController@registerSession')->name('register-session');
    Route::post('submit', 'DoExamController@submitExam')->name('submit-exam');
});
