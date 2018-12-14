<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ownermeta extends Model
{
    //
    protected $table = 'owner_meta';
    protected $primaryKey = 'id_meta';
   	protected $fillable = ['id_meta', 'owner_id', 'status', 'value'];
    public $timestamps = false;
}
