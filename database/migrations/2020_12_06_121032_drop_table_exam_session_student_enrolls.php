<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableExamSessionStudentEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('exam_session_student_enrolls');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('exam_session_student_enrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_session_code');
            $table->unsignedBigInteger('id_user');
            $table->string('student_session_code')->unique()->nullable();
            $table->timestamps();

            $table->foreign('exam_session_code')->references('exam_session_code')->on('exam_sessions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }
}
