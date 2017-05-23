<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
     protected $table = "Temas";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'id_tema',
		'codigo_asignatura',
		'id_usuario',
		'nombre',
		'descripcion',

		];
}
