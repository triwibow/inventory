<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_detail extends Model
{
    protected $table = 'detail_pembelian';
    protected $fillable = ['kode_pembelian', 'kode_barang', 'harga_satuan', 'jumlah'];
    public $timestamps = false;
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
}
