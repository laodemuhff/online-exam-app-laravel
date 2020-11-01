<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSessionQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_session_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_session_code');
            $table->unsignedBigInteger('id_question');
            $table->enum('question_validity', ['Valid', 'Invalid'])->nullable();
            $table->timestamps();

            $table->foreign('exam_session_code')->references('exam_session_code')->on('exam_sessions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_question')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_session_questions');
    }
}
