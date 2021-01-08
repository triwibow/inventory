<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('kode_penjualan', 50)->primary();
            $table->dateTime('tanggal_penjualan');
            $table->string('kode_pelanggan', 50);
            $table->foreign('kode_pelanggan')->references('kode_pelanggan')
                ->on('master_pelanggan')
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
        Schema::dropIfExists('penjualan');
    }
}
