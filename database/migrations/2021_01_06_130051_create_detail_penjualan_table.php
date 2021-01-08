<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->string('kode_penjualan', 50);
            $table->foreign('kode_penjualan')->references('kode_penjualan')
                ->on('penjualan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('kode_barang', 50);
            $table->foreign('kode_barang')->references('kode_barang')
                ->on('master_barang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('harga_satuan');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
}
