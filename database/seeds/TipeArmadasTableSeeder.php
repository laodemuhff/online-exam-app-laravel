<?php

use Illuminate\Database\Seeder;

class TipeArmadasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipe_armadas')->delete();
        
        \DB::table('tipe_armadas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipe' => 'avanza ',
                'created_at' => '2020-10-25 08:29:05',
                'updated_at' => '2020-10-25 08:29:09',
            ),
            1 => 
            array (
                'id' => 2,
                'tipe' => 'toyota',
                'created_at' => '2020-10-25 08:29:06',
                'updated_at' => '2020-10-25 08:29:09',
            ),
            2 => 
            array (
                'id' => 3,
                'tipe' => 'mutsubishi',
                'created_at' => '2020-10-25 08:29:06',
                'updated_at' => '2020-10-25 08:29:09',
            ),
            3 => 
            array (
                'id' => 4,
                'tipe' => 'kawasaki',
                'created_at' => '2020-10-25 08:29:07',
                'updated_at' => '2020-10-25 08:29:10',
            ),
            4 => 
            array (
                'id' => 5,
                'tipe' => 'kijang',
                'created_at' => '2020-10-25 08:29:07',
                'updated_at' => '2020-10-25 08:29:10',
            ),
            5 => 
            array (
                'id' => 6,
                'tipe' => 'honda',
                'created_at' => '2020-10-25 08:29:08',
                'updated_at' => '2020-10-28 14:33:41',
            ),
            6 => 
            array (
                'id' => 7,
                'tipe' => 'chevrolet',
                'created_at' => '2020-10-28 15:01:56',
                'updated_at' => '2020-10-28 15:01:56',
            ),
        ));
        
        
    }
}