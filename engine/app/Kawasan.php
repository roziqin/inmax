<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    //
    protected $table = 'kawasan';
    protected $primaryKey = 'id_kawasan';
   	protected $fillable = ['id_kawasan', 'nama_kawasan'];
    public $timestamps = false;
}
