<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    protected $toTruncate = ['user_admin_features','admin_features','users', 'settings'];

    public function run()
    {
        Schema::disableForeignKeyConstraints();

        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $this->call(UsersTableSeeder::class);
        $this->call(AdminFeaturesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);

    }
}
