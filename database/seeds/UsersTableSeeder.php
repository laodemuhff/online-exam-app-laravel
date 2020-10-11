<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin_evo',
            'email' => 'admin_evo@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 1,
            'mobile_number' => '081237788101'
        ]);

        DB::table('users')->insert([
            'name' => 'admin_evo2',
            'email' => 'admin_evo2@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 2,
            'mobile_number' => '081237788102'
        ]);

        DB::table('users')->insert([
            'name' => 'admin_evo3',
            'email' => 'admin_evo3@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 2,
            'mobile_number' => '081237788103'
        ]);

        DB::table('users')->insert([
            'name' => 'admin_evo4',
            'email' => 'admin_evo4@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 2,
            'mobile_number' => '081237788104'
        ]);

        DB::table('users')->insert([
            'name' => 'admin_evo5',
            'email' => 'admin_evo5@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 2,
            'mobile_number' => '081237788105'
        ]);
    }
}
