<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $table = 'master_barang';
    protected $fillable = ['kode_barang', 'nama_barang', 'deskripsi_barang', 'harga_satuan','stok'];
    public $timestamps = false;
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
}
