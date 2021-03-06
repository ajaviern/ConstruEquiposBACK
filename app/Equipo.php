<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "equipos";
    protected $fillable = array('id', 'categoria','descripcion', 'modelo', 'estado','cantidad','valor','totalExistencias');
    public $timestamps = false;

}
