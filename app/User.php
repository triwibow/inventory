<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends  Authenticatable
{
    protected $table = 'master_user';
    protected $fillable = ['username', 'password', 'jabatan'];
    protected $primaryKey = 'username';
    protected $keyType = 'string';
}
