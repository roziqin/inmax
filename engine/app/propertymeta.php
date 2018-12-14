<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class propertymeta extends Model
{
    //
    protected $table = 'propertymeta';
    protected $primaryKey = 'meta_id';
   	protected $fillable = ['meta_id', 'property_id', 'meta_key', 'meta_value'];
   	public $timestamps = false;
}
