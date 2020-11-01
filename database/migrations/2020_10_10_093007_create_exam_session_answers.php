<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSessionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_session_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_session_code');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_question');
            $table->unsignedBigInteger('multiple_choice_answer');
            $table->string('essay_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_session_answers');
    }
}
