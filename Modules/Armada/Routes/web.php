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
    Route::get('data', 'Admin\armadaController@data')->name('armada.data')->middleware('feature_control:armada_list');
    Route::get('/', 'Admin\armadaController@index')->name('armada.list')->middleware('feature_control:armada_list');
    Route::get('create', 'Admin\armadaController@create')->name('armada.create')->middleware('feature_control:armada_create');
    Route::post('store', 'Admin\armadaController@store')->name('armada.store')->middleware('feature_control:armada_create');
    Route::get('edit/{id}', 'Admin\armadaController@edit')->name('armada.edit')->middleware('feature_control:armada_update');
    Route::post('update', 'Admin\armadaController@update')->name('armada.update')->middleware('feature_control:armada_update');
    Route::delete('delete/{id}', 'Admin\armadaController@delete')->name('armada.delete')->middleware('feature_control:armada_delete');
    Route::post('image/store', 'Admin\armadaController@storeImage')->name('armada.store.image');
    Route::delete('image/delete', 'Admin\armadaController@deleteImage')->name('armada.delete.image');
});