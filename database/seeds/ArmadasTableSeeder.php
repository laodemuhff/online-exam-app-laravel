<?php

use Illuminate\Database\Seeder;

class ArmadasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('armadas')->delete();
        
        \DB::table('armadas')->insert(array (
            0 => 
            array (
                'id' => 4,
                'kode_armada' => 'asdasdasd',
                'id_tipe_armada' => 1,
                'status_armada' => 'ready',
                'status_driver' => 'tidak pakai supir',
                'price' => 45000000.0,
                'photo' => 'http://localhost/evo_transport/public/\\image\\armada\\ALL NEW JAZZ.png',
                'created_at' => '2020-10-25 10:20:22',
                'updated_at' => '2020-10-25 10:20:22',
            ),
            1 => 
            array (
                'id' => 5,
                'kode_armada' => 'asdadad',
                'id_tipe_armada' => 1,
                'status_armada' => 'ready',
                'status_driver' => 'pakai supir',
                'price' => 500000.0,
                'photo' => 'http://localhost/evo_transport/public/image/armada/ALL NEW JAZZ.png',
                'created_at' => '2020-10-25 10:22:07',
                'updated_at' => '2020-10-25 10:22:07',
            ),
            2 => 
            array (
                'id' => 6,
                'kode_armada' => 'asdasdad',
                'id_tipe_armada' => 2,
                'status_armada' => 'not ready',
                'status_driver' => 'pakai supir',
                'price' => 300000.0,
                'photo' => 'http://localhost/evo_transport/public/image/armada/JAZZ RS.png',
                'created_at' => '2020-10-25 10:58:28',
                'updated_at' => '2020-10-25 10:58:28',
            ),
            3 => 
            array (
                'id' => 7,
                'kode_armada' => 'toyotaabc',
                'id_tipe_armada' => 2,
                'status_armada' => 'ready',
                'status_driver' => 'pakai supir',
                'price' => 500000.0,
                'photo' => 'http://localhost/evo_transport/public/image/armada/AYLA.png',
                'created_at' => '2020-10-25 11:02:46',
                'updated_at' => '2020-10-25 12:03:21',
            ),
            4 => 
            array (
                'id' => 8,
                'kode_armada' => 'Avanza-8782',
                'id_tipe_armada' => 1,
                'status_armada' => 'ready',
                'status_driver' => 'pakai supir',
                'price' => 4000000.0,
                'photo' => 'http://localhost/evo_transport/public/image/armada/AGYA.png',
                'created_at' => '2020-10-28 15:13:17',
                'updated_at' => '2020-10-28 15:13:17',
            ),
        ));
        
        
    }
}