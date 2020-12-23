<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeveralColumnsInExamSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            $table->enum('check_on_exam_similarity',['1','0'])->after('use_base_questions')->default(0);
            $table->enum('disallow_navigation',['1','0'])->after('use_base_questions')->default(0);
            $table->enum('disallow_multiple_login',['1','0'])->after('use_base_questions')->default(0);
            $table->enum('allow_scrambled_options',['1','0'])->after('use_base_questions')->default(0);
            $table->enum('allow_scrambled_questions',['1','0'])->after('use_base_questions')->default(0);
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
            $table->dropColumn('allow_scrambled_options');
            $table->dropColumn('allow_scrambled_questions');
            $table->dropColumn('disallow_multiple_login');
            $table->dropColumn('disallow_navigation');
            $table->dropColumn('check_on_exam_similarity');
        });
    }
}
