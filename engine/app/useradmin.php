<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class useradmin extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';
   	protected $fillable = ['id', 'name', 'email', 'password', 'role', 'status'];
}
