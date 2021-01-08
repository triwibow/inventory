<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_pelanggan')->insert([
            'kode_pelanggan' => 'P001',
            'nama_pelanggan' => 'wibowo',
            'no_telp_pelanggan' =>'081328819326',
            'alamat_pelanggan' => 'Jl Wates km 10'
        ]);
    }
}
