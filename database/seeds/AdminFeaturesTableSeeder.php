<?php

use Illuminate\Database\Seeder;

class AdminFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admin_features')->insert([
            'key' => 'setting_maintenance_mode',
            'module' => 'Settings',
            'action' => 'maintenance mode'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'admin_management_create',
            'module' => 'Admin Management',
            'action' => 'create'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'admin_management_list',
            'module' => 'Admin Management',
            'action' => 'list'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'admin_management_update',
            'module' => 'Admin Management',
            'action' => 'update'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'admin_management_delete',
            'module' => 'Admin Management',
            'action' => 'delete'
        ]);


        DB::table('admin_features')->insert([
            'key' => 'armada_list',
            'module' => 'Armada Management',
            'action' => 'list'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'armada_create',
            'module' => 'Armada Management',
            'action' => 'create'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'armada_update',
            'module' => 'Armada Management',
            'action' => 'update'
        ]);

        DB::table('admin_features')->insert([
            'key' => 'armada_delete',
            'module' => 'Armada Management',
            'action' => 'delete'
        ]);

    }
}
