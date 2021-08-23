<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeInExamSessionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_answers', function (Blueprint $table) {
            $table->dropForeign('exam_session_answers_multiple_choice_answer_foreign');
            $table->foreign('multiple_choice_answer')->references('id')->on('options')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_session_answers', function (Blueprint $table) {
            //
        });
    }
}
