<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableExamSessionUserEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_session_user_enrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_exam_session');
            $table->unsignedBigInteger('id_user');
            $table->string('user_type');
            $table->string('user_session_code')->unique()->nullable();
            $table->integer('final_score')->nullable();
            $table->enum('final_score_status', ['Ready to evaluate', 'Verified'])->nullable();
            $table->timestamps();

            $table->foreign('id_exam_session')->references('id')->on('exam_sessions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_session_user_enrolls');
    }
}
