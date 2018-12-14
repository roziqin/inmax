<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenisproperty extends Model
{
    //
    protected $table = 'jenis_property';
    protected $primaryKey = 'id';
   	protected $fillable = ['id', 'nama_jenis', 'slug'];
    public $timestamps = false;
}
