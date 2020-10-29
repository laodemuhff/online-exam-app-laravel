<?php

use Illuminate\Database\Seeder;

class DriversTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('drivers')->delete();
        
        \DB::table('drivers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'farhan fauzan',
                'phone' => '087778718255',
                'created_at' => '2020-10-29 04:44:58',
                'updated_at' => '2020-10-29 04:48:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'umam mualana',
                'phone' => '0866555123132',
                'created_at' => '2020-10-29 04:49:06',
                'updated_at' => '2020-10-29 04:49:42',
            ),
        ));
        
        
    }
}