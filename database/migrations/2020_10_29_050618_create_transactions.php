<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_faktur');
            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->string('no_hp_customer');
            $table->unsignedBigInteger('id_armada');
            $table->integer('durasi_sewa');
            $table->dateTime('pickup_date');
            $table->string('note')->nullable();
            $table->enum('status_lepas_kunci', ['off key', 'shipped off key'])->nullable();
            $table->enum('status_pengambilan', ['taken in place', 'send out car'])->nullable();
            $table->enum('status_transaksi', ['pending', 'cancelled', 'on rent', 'success'])->default('pending');
            $table->string('cancelled_by')->nullable();
            $table->double('grand_total');
            $table->integer('is_deleted')->default(0);
            $table->timestamps();

            $table->foreign('id_armada')->references('id')->on('armadas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
