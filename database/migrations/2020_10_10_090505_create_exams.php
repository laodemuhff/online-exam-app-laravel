<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_title');
            $table->integer('total_question')->default(0);
            $table->integer('max_score')->default(100);
            $table->integer('default_wrong_point')->default(1);
            $table->integer('default_correct_point')->default(0);
            $table->enum('exam_status', ['Active', 'Inactive']);
            $table->enum('oecp_1', [true, false]);
            $table->enum('oecp_2', [true, false]);
            $table->enum('oecp_3', [true, false]);
            $table->enum('oecp_4', [true, false]);
            $table->enum('oecp_5', [true, false]);
            $table->enum('oecp_6', [true, false]);
            $table->enum('oecp_8', [true, false]);
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
        Schema::dropIfExists('exams');
    }
}
