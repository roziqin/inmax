<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscribe extends Model
{
    //
    protected $table = 'subscribers';
    protected $primaryKey = 'subscrib_id';
   	protected $fillable = ['subscrib_id', 'subscrib_email', 'subscrib_timestamp'];
}
