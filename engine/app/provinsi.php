<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    //
    protected $table = 'provinces';
    protected $primaryKey = 'id';
   	protected $fillable = ['id', 'name'];
    public $timestamps = false;
}

class kabupaten extends Model
{
    //
    protected $table = 'regencies';
    protected $primaryKey = 'id';
   	protected $fillable = ['id', 'name'];
    public $timestamps = false;
}

class kecamatan extends Model
{
    //
    protected $table = 'districts';
    protected $primaryKey = 'id';
   	protected $fillable = ['id', 'name'];
    public $timestamps = false;
}

class kelurahan extends Model
{
    //
    protected $table = 'villages';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name'];
    public $timestamps = false;
}