<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = array('id', 'cedula', 'name', 'apellido', 'telefono', 'rol', 'email', 'password');
    public $timestamps = false;


    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

}
