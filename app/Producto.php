<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Producto as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "producto";
    protected $fillable = array('id', 'nombre');
    public $timestamps = false;
}
