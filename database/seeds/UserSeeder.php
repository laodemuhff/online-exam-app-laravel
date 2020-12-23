<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@exam.id',
            'phone' => '0812377712333',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'level' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Yudi Prayudi',
            'email' => 'yudip@uii.ac.id',
            'phone' => '0812377712334',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'level' => 'instructor',
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Elyza Gustri Wahyuni',
            'email' => 'elyzagw@uii.ac.id',
            'phone' => '0812377712335',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'level' => 'instructor',
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Sri Mulyati',
            'email' => 'sri_mulyati@uii.ac.id',
            'phone' => '0812377712337',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'level' => 'instructor',
            'remember_token' => Str::random(10),
        ]);

        factory(App\Models\User::class, 50)->create();
    }
}
