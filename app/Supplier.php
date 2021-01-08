<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'master_supplier';
    protected $fillable = ['kode_supplier', 'nama_supplier', 'no_telp_supplier', 'alamat_supplier'];
    public $timestamps = false;
    protected $primaryKey = 'kode_supplier';
    protected $keyType = 'string';
}
