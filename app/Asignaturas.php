<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model
{
    protected $table = "Asignaturas";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'codigo',
		'nombre_asignatura',
		'horas_semanales',
		'jornada',
		
		];
}
