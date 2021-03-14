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

Route::prefix('answer')->group(function() {
    Route::post('save', 'AnswerController@saveAnswer')->name('answer.save');
    Route::post('save-nav-position', 'AnswerController@saveNavPosition')->name('nav.save');
});
