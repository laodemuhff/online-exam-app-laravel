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

Route::prefix('user')->middleware('validate_session')->group(function() {
    Route::prefix('admin-management')->group(function() {
        Route::get('create', 'Admin\AdminManagementController@create')->middleware('feature_control:admin_management_create')->name('admin.admin.management.create');
        Route::post('store', 'Admin\AdminManagementController@store')->middleware('feature_control:admin_management_create')->name('admin.admin.management.store');
        Route::get('/', 'Admin\AdminManagementController@index')->middleware('feature_control:admin_management_list,admin_management_update,admin_management_delete')->name('admin.admin.management.list');
        Route::get('table', 'Admin\AdminManagementController@table')->middleware('feature_control:admin_management_list,admin_management_update,admin_management_delete')->name('admin.admin.management.table');
        Route::get('edit/{id}', 'Admin\AdminManagementController@edit')->middleware('feature_control:admin_management_update')->name('admin.admin.management.edit');
        Route::post('update/{id}', 'Admin\AdminManagementController@update')->middleware('feature_control:admin_management_update')->name('admin.admin.management.update');
        Route::delete('delete/{id}', 'Admin\AdminManagementController@delete')->middleware('feature_control:admin_management_delete')->name('admin.admin.management.delete');
    });
});
