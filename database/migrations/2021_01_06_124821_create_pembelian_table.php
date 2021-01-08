<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string('kode_pembelian', 50)->primary();
            $table->dateTime('tanggal_pembelian');
            $table->string('kode_supplier', 50);
            $table->foreign('kode_supplier')->references('kode_supplier')
                ->on('master_supplier')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('total_biaya');
            $table->dateTime('tanggal_dibuat');
            $table->string('dibuat_oleh', 20);
            $table->foreign('dibuat_oleh')->references('username')
                ->on('master_user')
                ->onDelete('cascade')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
