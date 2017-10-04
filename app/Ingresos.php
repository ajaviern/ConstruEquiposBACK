<?php
/**
 * Created by PhpStorm.
 * User: Javier Nuñez
 * Date: 10/08/2017
 * Time: 7:04 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ingresos extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "ingresos";
    protected $fillable = array('id', 'id_alquiler','id_alquiler_tabla_intersecto');
    public $timestamps = false;

}