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

Route::group(['prefix' => 'question', 'middleware' => 'validate_session'], function() {
    Route::get('/', 'QuestionController@index')->name('question.list');
    Route::get('/create', 'QuestionController@create')->name('question.create');
});
