<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PeticionesInternas extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "peticionesinternas";
    protected $fillable = array('id', 'id_usuario');
    public $timestamps = false;
}
