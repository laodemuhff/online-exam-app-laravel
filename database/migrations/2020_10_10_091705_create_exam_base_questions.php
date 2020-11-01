<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamBaseQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_base_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_exam');
            $table->unsignedBigInteger('id_question');
            $table->enum('question_validity', ['Valid', 'Invalid'])->nullable();
            $table->timestamps();

            $table->foreign('id_exam')->references('id')->on('exams')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('exam_base_questions');
    }
}
