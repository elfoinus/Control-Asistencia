<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = "Usuarios";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'Numero_cedula',
		'password',
		'nombre',
		'correo',
		'estado',
		'id_perfil',

		];
}
