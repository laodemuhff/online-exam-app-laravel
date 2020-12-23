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

Route::prefix('setting')->middleware('validate_session')->group(function() {
    //Maintenance Mode
    Route::prefix('maintenance-mode')->middleware('feature_control:setting_maintenance_mode')->group(function() {
        Route::get('/', 'MaintenanceModeController@index')->name('setting.maintenance.mode');
        Route::post('update', 'MaintenanceModeController@update')->name('setting.maintenance.mode.update');
    });

    Route::prefix('wordings')->middleware('feature_control:setting_wordings')->group(function() {
        Route::get('/', 'WordingsController@index')->name('setting.wordings');
        Route::post('update', 'WordingsController@update')->name('setting.wordings.update');
    });
});
