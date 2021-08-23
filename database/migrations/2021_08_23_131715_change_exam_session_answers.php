<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExamSessionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_answers', function(Blueprint $table){
            // drop old column
            $table->dropForeign('FK_id_question');
            $table->dropColumn('id_question');

            $table->dropForeign('exam_session_answers_multiple_choice_answer_foreign');

            // create new column
            $table->unsignedBigInteger('id_exam_session_question')->after('id');

            $table->foreign('id_exam_session_question')->references('id')->on('exam_session_questions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('multiple_choice_answer')->references('id')->on('exam_session_options')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
