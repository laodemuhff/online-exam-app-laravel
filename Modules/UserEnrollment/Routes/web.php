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

Route::prefix('user-enrollment')->middleware('validate_session:admin')->group(function() {
    Route::get('/{id}', 'UserEnrollmentController@index')->name('user-enrollment');
    Route::post('/save', 'UserEnrollmentController@saveUserEnrollment')->name('user-enrollment-save');
    Route::delete('/delete/{id}', 'UserEnrollmentController@deleteUserEnrollment')->name('user-enrollment-delete');
});
