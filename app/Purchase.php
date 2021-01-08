<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'pembelian';
    protected $fillable = ['kode_pembelian', 'tanggal_pembelian', 'kode_supplier', 'total_biaya', 'tanggal_dibuat', 'dibuat_oleh'];
    public $timestamps = false;
    protected $primaryKey = 'kode_pembelian';
    protected $keyType = 'string';

    public function barang(){
        return $this->hasManyThrough(Stuff::class,Purchase_detail::class,'kode_pembelian', 'kode_barang');
    }

    public function detailPembelian(){
        return $this->hasMany(Purchase_detail::class, 'kode_pembelian');
    }

}
