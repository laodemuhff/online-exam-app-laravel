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

Route::prefix('driver')->middleware('validate_session')->group(function() {
    Route::get('/', 'DriverController@index')->name('driver.list')->middleware('feature_control:driver_list');
    Route::get('table', 'DriverController@table')->name('driver.table')->middleware('feature_control:driver_list,driver_update,driver_delete');
    Route::post('store', 'DriverController@store')->name('driver.store')->middleware('feature_control:driver_create');
    Route::post('update/{id}', 'DriverController@update')->name('driver.update')->middleware('feature_control:driver_update');
    Route::delete('delete/{id}', 'DriverController@delete')->name('driver.delete')->middleware('feature_control:driver_delete');
    Route::delete('assign', 'DriverController@assignDriver')->name('driver.assign')->middleware('feature_control:driver_assign');
});