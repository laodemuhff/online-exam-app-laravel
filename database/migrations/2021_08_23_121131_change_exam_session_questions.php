<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExamSessionQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_questions', function(Blueprint $table){
            // remove old column
            $table->dropForeign('exam_session_questions_exam_session_code_foreign');
            $table->dropColumn('exam_session_code');

            $table->dropForeign('exam_session_questions_id_question_foreign');
            $table->dropColumn('id_question');

            $table->dropColumn('question_validity');

            // add new column
            $table->string('question_description');
            $table->enum('type', ['essay', 'multiple_choice']);
            $table->tinyInteger('use_default_correct_point')->nullable()->default(1);
            $table->tinyInteger('use_default_wrong_point')->nullable()->default(1);
            $table->integer('correct_point')->nullable();
            $table->integer('wrong_point')->nullable();
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
