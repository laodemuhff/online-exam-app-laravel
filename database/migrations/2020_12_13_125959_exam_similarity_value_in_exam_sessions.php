<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamSimilarityValueInExamSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            $table->double('exam_similarity_value')->after('check_on_exam_similarity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            $table->dropColumn('exam_similarity_value');
        });
    }
}
