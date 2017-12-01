<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleSalidas extends Model
{
    use SoftDeletes;
    protected $table = "detalles_salidas";
    protected $fillable = array('equipos_id', 'alquileres_id','fecha','cantidad','subtotal','estado');
    protected $dates = ['deleted_at'];
}
