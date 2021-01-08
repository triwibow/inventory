<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_user')->insert([
            'username' => 'admin',
            'password' => Hash::make('12345'),
            'jabatan' =>'ADMINISTRATOR',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        DB::table('master_user')->insert([
            'username' => 'satya',
            'password' => Hash::make('12345'),
            'jabatan' =>'FAKTURIS',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);

        DB::table('master_user')->insert([
            'username' => 'robi',
            'password' => Hash::make('12345'),
            'jabatan' =>'LOGISTIK',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }
}
