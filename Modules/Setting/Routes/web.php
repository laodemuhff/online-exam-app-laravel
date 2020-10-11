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
    //App Version
    Route::prefix('app-version')->middleware('feature_control:setting_app_version')->group(function(){
        Route::get('/', 'Admin\SettingController@appVersion')->name('setting.app-version.index');
        Route::post('store', 'Admin\SettingController@store')->name('setting.app-version.store');
        Route::post('update', 'Admin\SettingController@update')->name('setting.app-version.update');
        Route::post('delete', 'Admin\SettingController@delete')->name('setting.app-version.delete');
        Route::post('update-setting', 'Admin\SettingController@updateSetting')->name('setting.app.version-setting.update');
        Route::post('update-block', 'Admin\SettingController@updateBlock')->name('setting.app-version.block.update');
    });
    //Maintenance Mode
    Route::prefix('maintenance-mode')->middleware('feature_control:setting_maintenance_mode')->group(function() {
        Route::get('/', 'Admin\MaintenanceModeController@index')->name('setting.maintenance.mode');
        Route::post('update', 'Admin\MaintenanceModeController@update')->name('setting.maintenance.mode.update');
    });
});
