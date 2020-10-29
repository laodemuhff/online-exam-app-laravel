<?php

use Illuminate\Database\Seeder;

class AdminFeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_features')->delete();
        
        \DB::table('admin_features')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'setting_maintenance_mode',
                'module' => 'Settings',
                'action' => 'maintenance mode',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'admin_management_create',
                'module' => 'Admin Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'admin_management_list',
                'module' => 'Admin Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'admin_management_update',
                'module' => 'Admin Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'admin_management_delete',
                'module' => 'Admin Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'armada_list',
                'module' => 'Armada Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'armada_create',
                'module' => 'Armada Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'armada_update',
                'module' => 'Armada Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'armada_delete',
                'module' => 'Armada Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'tipe_armada_list',
                'module' => 'Tipe Armada Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'tipe_armada_create',
                'module' => 'Tipe Armada Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'tipe_armada_delete',
                'module' => 'Tipe Armada Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'tipe_armada_update',
                'module' => 'Tipe Armada Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}