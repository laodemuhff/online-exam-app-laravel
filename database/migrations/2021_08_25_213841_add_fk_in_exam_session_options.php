<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkInExamSessionOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_options', function (Blueprint $table) {
            $table->foreign('id_exam_session_question')->references('id')->on('exam_session_questions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_session_options', function (Blueprint $table) {
            $table->dropForeign('exam_session_options_id_exam_session_question_foreign');
        });
    }
}
