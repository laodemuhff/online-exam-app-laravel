<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInExamSessionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('multiple_choice_answer')->change();
            $table->foreign('multiple_choice_answer')->references('id')->on('options');
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
