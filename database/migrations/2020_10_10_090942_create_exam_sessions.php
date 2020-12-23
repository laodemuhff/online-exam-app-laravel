<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_exam');
            $table->string('exam_session_code')->unique();
            $table->datetime('exam_datetime')->nullable();
            $table->integer('exam_duration')->nullable();
            $table->integer('register_duration')->nullable();
            $table->enum('use_base_questions', [true, false])->default(true);
            $table->enum('exam_session_status', ['Pending', 'On Going', 'Terminated', 'Forbidden'])->default('Pending');
            $table->timestamps();

            $table->foreign('id_exam')->references('id')->on('exams')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_sessions');
    }
}
