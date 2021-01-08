<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pelanggan', function (Blueprint $table) {
            $table->string('kode_pelanggan', 50)->primary();
            $table->string('nama_pelanggan', 50);
            $table->string('no_telp_pelanggan', 15);
            $table->text('alamat_pelanggan');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pelanggan');
    }
}
