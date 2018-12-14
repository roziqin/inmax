<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    //
    protected $table = 'kabupaten';
    protected $primaryKey = 'id_kabupaten';
   	protected $fillable = ['id_kabupaten', 'nama_kabupaten'];
    public $timestamps = false;
}
