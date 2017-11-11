<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Alquiler extends Model
{
    use SoftDeletes;
    protected $table = "alquileres";
    protected $fillable = array('fecha','usuarios_id','estado','total');
    protected $dates = ['deleted_at'];
}
