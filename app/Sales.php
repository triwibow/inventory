<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'penjualan';
    protected $fillable = ['kode_penjualan', 'tanggal_penjualan', 'kode_pelanggan', 'total_biaya', 'tanggal_dibuat', 'dibuat_oleh'];
    public $timestamps = false;
    protected $primaryKey = 'kode_penjualan';
    protected $keyType = 'string';

    public function barang(){
        return $this->hasManyThrough(Stuff::class,Sales_detail::class,'kode_penjualan', 'kode_barang');
    }

    public function detailPenjualan(){
        return $this->hasMany(Sales_detail::class, 'kode_penjualan');
    }
}
