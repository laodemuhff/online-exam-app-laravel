<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartedOnGoingAtInExamSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('started_by')->nullable()->after('exam_datetime');
            $table->dateTime('started_on_going_at')->nullable()->after('exam_datetime');

            $table->foreign('started_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
            //
        });
    }
}
