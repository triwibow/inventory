<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_supplier')->insert([
            'kode_supplier' => 'S001',
            'nama_supplier' => 'PT. Abadi',
            'no_telp_supplier' =>'081328819329',
            'alamat_supplier' => 'Jl Bantul km 16'
        ]);
    }
}
