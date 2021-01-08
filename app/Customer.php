<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'master_pelanggan';
    protected $fillable = ['kode_pelanggan', 'nama_pelanggan', 'no_telp_pelanggan', 'alamat_pelanggan'];
    public $timestamps = false;
    protected $primaryKey = 'kode_pelanggan';
    protected $keyType = 'string';
}
