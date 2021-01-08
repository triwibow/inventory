<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_detail extends Model
{
    protected $table = 'detail_penjualan';
    protected $fillable = ['kode_penjualan', 'kode_barang', 'harga_satuan', 'jumlah'];
    public $timestamps = false;
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
}
