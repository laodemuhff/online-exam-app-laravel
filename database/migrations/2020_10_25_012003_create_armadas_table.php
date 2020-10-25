<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_armada');
            $table->unsignedInteger('id_tipe_armada');
            $table->enum('status_armada', ['ready','not ready']);
            $table->enum('status_driver', ['pakai supir','tidak pakai supir']);
            $table->double('price');
            $table->timestamps();

            $table->foreign('id_tipe_armada')->references('id')->on('tipe_armadas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('armadas');
    }
}
