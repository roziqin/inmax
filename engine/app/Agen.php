<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    //
    protected $table = 'agen';
    protected $primaryKey = 'agen_id';
   	protected $fillable = ['agen_id', 'agen_nama', 'agen_hp', 'agen_email', 'agen_bbm', 'agen_anggota', 'agen_keterangan', 'agen_avatar','agen_alamat'];
    public $timestamps = false;
}
