<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSessionOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_session_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_exam_session_question');
            $table->string('option_label',50);
            $table->string('option_description',191);
            $table->tinyInteger('answer_status')->default(0);
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
        Schema::dropIfExists('exam_session_options');
    }
}
