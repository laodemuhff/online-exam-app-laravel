<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin_evo',
                'email' => 'admin_evo@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$uNa.4KZFxtDTGcHTfvrd0O/.fPOxpWulZvKAU5sPF2pFfaoQuQILm',
                'level' => '1',
                'mobile_number' => '081237788101',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'admin_evo2',
                'email' => 'admin_evo2@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$JEaXFpibWDtv0MQPYZAIOOJhSnvhDtbU2GWFOSh0gOnrmb3GIx782',
                'level' => '2',
                'mobile_number' => '081237788102',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin_evo3',
                'email' => 'admin_evo3@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$HRG3J1JryXSMTbj.qwd8SeXvoqxHlLFJYJWHIprnIboaQ2gEgCv7i',
                'level' => '2',
                'mobile_number' => '081237788103',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'admin_evo4',
                'email' => 'admin_evo4@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$SptY3KXdn5ec8BQj5LiyMOyIZYPt8nxpcDD6m2IGNAtDhJrPuIsxC',
                'level' => '2',
                'mobile_number' => '081237788104',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'admin_evo5',
                'email' => 'admin_evo5@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$coQ1rxcUfOzsYyGPJ4./zuuQQrxZx6kXoeYyhVoG4ZOceUyASZs7y',
                'level' => '2',
                'mobile_number' => '081237788105',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}