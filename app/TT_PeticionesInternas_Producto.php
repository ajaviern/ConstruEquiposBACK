<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TT_PeticionesInternas_Producto extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "tt_peticionesinternas_producto";
    protected $fillable = array('id', 'id_peticionesinternas','id_producto','aprobado','cantidad');
    public $timestamps = false;
}
