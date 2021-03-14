<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentActiveNavInExamSessionUserEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_user_enrolls', function (Blueprint $table) {
            $table->integer('current_active_nav')->nullable()->after('is_registered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_session_user_enrolls', function (Blueprint $table) {
            $table->dropColumn('current_active_nav');
        });
    }
}
