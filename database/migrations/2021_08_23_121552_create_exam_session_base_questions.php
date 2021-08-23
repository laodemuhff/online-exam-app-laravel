<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSessionBaseQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_session_base_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_exam_session');
            $table->unsignedBigInteger('id_exam_session_question');
            $table->enum('question_validity', ['Valid', 'Invalid'])->nullable();

            $table->foreign('id_exam_session')->references('id')->on('exam_sessions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_exam_session_question')->references('id')->on('exam_session_questions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('exam_session_base_questions');
    }
}
