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

Route::group(['prefix' => 'exam-session', 'middleware' => 'validate_session'], function() {
    Route::get('/list/{status}', 'ExamSessionController@index')->name('exam-session');
    Route::get('/create', 'ExamSessionController@create')->name('exam-session.create');
    Route::post('/store', 'ExamSessionController@store')->name('exam-session.store');
    Route::get('/edit/{id}', 'ExamSessionController@edit')->name('exam-session.edit');
    Route::post('/update/{id}', 'ExamSessionController@update')->name('exam-session.update');
    Route::delete('/delete/{id}', 'ExamSessionController@delete')->name('exam-session.delete');
    Route::get('/start/{id}', 'ExamSessionController@startSession')->name('exam-session.start');
    Route::get('/end/{id}', 'ExamSessionController@endSession')->name('exam-session.end');
    Route::get('/submit/{id}', 'ExamSessionController@submitEnrollment')->name('exam-session.submit-enrollment');
});
