<?php

use Illuminate\Database\Seeder;

class StuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_barang')->insert([
            'kode_barang' => 'B001',
            'nama_barang' => 'Indomie Goreng',
            'deskripsi_barang' =>'mie instant goreng sedap',
            'harga_satuan' => 2500,
            'stok' => 0
        ]);
    }
}
