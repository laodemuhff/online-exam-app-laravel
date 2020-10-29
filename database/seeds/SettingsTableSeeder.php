<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'maintenance_start_date',
                'value' => '2020-08-01',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:49:48',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'maintenance_end_date',
                'value' => '2020-08-28',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:49:48',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'maintenance_background',
                'value' => 'http://localhost/evo_transport/public/image/maintenance/unnamed.png',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:28:15',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'maintenance_image',
                'value' => 'http://localhost/evo_transport/public/image/maintenance/clipart1758033.png',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:28:15',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'maintenance_title',
                'value' => 'Website is on Maintenance',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:49:48',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'maintenance_content',
                'value' => 'Please Wait, We are on Maintenance Mode',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:49:48',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'maintenance_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2020-10-29 03:49:48',
            ),
        ));
        
        
    }
}