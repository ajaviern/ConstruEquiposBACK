<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Detalles_Ingresos extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "detalles_ingresos";
    protected $fillable = array('id','id_detalles_salidas','cantidad_ingreso','fecha_ingreso');
    public $timestamps = false;
}
