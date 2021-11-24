<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQuestionDesctiptionsInExamSessionQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function changeColumnType($table, $column, $newColumnType) {                
        DB::statement("ALTER TABLE $table CHANGE $column $column $newColumnType");
    } 

    public function up()
    {
        $this->changeColumnType('exam_session_questions','question_description','TEXT');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_session_questions', function (Blueprint $table) {
            //
        });
    }
}
