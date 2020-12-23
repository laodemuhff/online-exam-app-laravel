<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE admin_features ADD CONSTRAINT key_unique UNIQUE (`key`)");
       
        DB::statement("ALTER TABLE exam_sessions MODIFY COLUMN use_base_questions enum('1', '0') NOT NULL DEFAULT '1'");
        DB::statement("ALTER TABLE exam_sessions MODIFY COLUMN exam_session_status enum('Pending', 'On Going', 'Terminated') NOT NULL DEFAULT 'Pending'");
       
        DB::statement("ALTER TABLE exam_session_answers DROP COLUMN exam_session_code");
        DB::statement("ALTER TABLE exam_session_answers DROP COLUMN id_user");
        DB::statement("ALTER TABLE exam_session_answers ADD COLUMN user_session_code VARCHAR(50) NOT NULL");
        DB::statement("ALTER TABLE exam_session_answers ADD COLUMN given_point INT NULL");
        
        DB::statement("ALTER TABLE exam_session_answers ADD CONSTRAINT FK_user_session_code FOREIGN KEY (user_session_code) REFERENCES exam_session_user_enrolls(user_session_code)");
        DB::statement("ALTER TABLE exam_session_answers ADD CONSTRAINT FK_id_question FOREIGN KEY(id_question) REFERENCES questions(id)");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE admin_features DROP INDEX key_unique');

        DB::statement("ALTER TABLE exam_session_answers DROP FOREIGN KEY FK_user_session_code");
        DB::statement("ALTER TABLE exam_session_answers DROP FOREIGN KEY FK_id_question");

        DB::statement("ALTER TABLE exam_session_answers DROP COLUMN user_session_code");
        DB::statement("ALTER TABLE exam_session_answers DROP COLUMN given_point");
        DB::statement("ALTER TABLE exam_session_answers ADD COLUMN exam_session_code VARCHAR(50) NOT NULL");
        DB::statement("ALTER TABLE exam_session_answers ADD COLUMN id_user INT");
    }
}
