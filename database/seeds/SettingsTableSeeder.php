<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key' => 'maintenance_start_date',
            'value' => '2020-08-12',
        ]);

        DB::table('settings')->insert([
            'key' => 'maintenance_end_date',
            'value' => '2020-08-19',
        ]);

        DB::table('settings')->insert([
            'key' => 'maintenance_background',
            'value' => 'data/maintenance-mode/2020-08-12_043217.png',
        ]);

        DB::table('settings')->insert([
            'key' => 'maintenance_image',
            'value' => 'data/maintenance-mode/2020-08-12_043218.png',
        ]);

        DB::table('settings')->insert([
            'key' => 'maintenance_title',
            'value' => 'Website is on Maintenance',
        ]);

         DB::table('settings')->insert([
            'key' => 'maintenance_content',
            'value' => 'Please Wait',
        ]);
    }
}

Route::get('data', 'Admin\armadaController@data')->name('armada.data')->middleware('feature_control:armada_list');
Route::get('/', 'Admin\armadaController@index')->name('armada.list')->middleware('feature_control:armada_list');
Route::get('create', 'Admin\armadaController@create')->name('armada.create')->middleware('feature_control:armada_create');
Route::post('store', 'Admin\armadaController@store')->name('armada.store')->middleware('feature_control:armada_create');
Route::get('edit/{id}', 'Admin\armadaController@edit')->name('armada.edit')->middleware('feature_control:armada_update');
Route::post('update', 'Admin\armadaController@update')->name('armada.update')->middleware('feature_control:armada_update');
Route::delete('delete/{id}', 'Admin\armadaController@delete')->name('armada.delete')->middleware('feature_control:armada_delete');
