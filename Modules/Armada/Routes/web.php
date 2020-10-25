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

Route::prefix('armada')->middleware('validate_session')->group(function() {
    Route::get('/', 'ArmadaController@index')->name('armada.list')->middleware('feature_control:armada_list');
    Route::get('table', 'ArmadaController@table')->name('armada.table')->middleware('feature_control:armada_list,armada_update,armada_delete');
    Route::get('create', 'ArmadaController@create')->name('armada.create')->middleware('feature_control:armada_create');
    Route::post('store', 'ArmadaController@store')->name('armada.store')->middleware('feature_control:armada_create');
    Route::get('edit/{id}', 'ArmadaController@edit')->name('armada.edit')->middleware('feature_control:armada_update');
    Route::post('update/{id}', 'ArmadaController@update')->name('armada.update')->middleware('feature_control:armada_update');
    Route::delete('delete/{id}', 'ArmadaController@delete')->name('armada.delete')->middleware('feature_control:armada_delete');
});

Route::prefix('tipe_armada')->middleware('validate_session')->group(function(){
    Route::get('/', 'TipeArmadaController@index')->name('tipe_armada.list');
    Route::post('store', 'TipeArmadaController@store')->name('tipe_armada.store')->middleware('feature_control:tipe_armada_create');
    Route::post('update/{id}', 'TipeArmadaController@update')->name('tipe_armada.update')->middleware('feature_control:tipe_armada_update');
    Route::delete('delete/{id}', 'TipeArmadaController@delete')->name('tipe_armada.delete')->middleware('feature_control:tipe_armada_delete');
});