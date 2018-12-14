<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    //
    protected $table = 'owner';
    protected $primaryKey = 'id';
   	protected $fillable = ['id', 'nama', 'alamat', 'no_hp', 'email', 'no_ktp'];
    public $timestamps = false;
}
