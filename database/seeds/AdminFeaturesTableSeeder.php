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
                'key' => 'user_management_list',
                'module' => 'User Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'user_management_create',
                'module' => 'User Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'user_management_update',
                'module' => 'User Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'user_management_delete',
                'module' => 'User Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'user_management_detail',
                'module' => 'User Management',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'exam_management_list',
                'module' => 'Exam Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'exam_management_create',
                'module' => 'Exam Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'exam_management_update',
                'module' => 'Exam Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'exam_management_delete',
                'module' => 'Exam Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'exam_session_management_create',
                'module' => 'Exam Session Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'exam_session_management_update',
                'module' => 'Exam Session Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'exam_session_management_delete',
                'module' => 'Exam Session Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'exam_session_management_detail',
                'module' => 'Exam Session Management',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'exam_management_detail',
                'module' => 'Exam Management',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'exam_session_management_list',
                'module' => 'Exam Session Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'exam_evaluation_list',
                'module' => 'Exam Evaluation',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'exam_evaluation_detail',
                'module' => 'Exam Evaluation',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'question_management_list',
                'module' => 'Question Management',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'question_management_create',
                'module' => 'Question Management',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'question_management_update',
                'module' => 'Question Management',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'question_management_delete',
                'module' => 'Question Management',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'question_management_detail',
                'module' => 'Question Management',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'user_enroll_list',
                'module' => 'User Enroll',
                'action' => 'list',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'user_enroll_detail',
                'module' => 'User Enroll',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'report_list',
                'module' => 'Report',
                'action' => 'List',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'report_detail',
                'module' => 'Report',
                'action' => 'detail',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'report_download',
                'module' => 'Report',
                'action' => 'download',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'user_entoll_create',
                'module' => 'User Enroll',
                'action' => 'create',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'user_enroll_update',
                'module' => 'User Enroll',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'user_enroll_delete',
                'module' => 'User Enroll',
                'action' => 'delete',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'exam_evaluation_update',
                'module' => 'Exam Evaluation',
                'action' => 'update',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}