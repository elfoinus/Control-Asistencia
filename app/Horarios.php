<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table = "Horarios";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'id_Horario',
		'id_asignatura_dependencia',
		'dia',
		'hora_inicial',
		'cantidad_horas',
		'id_usuario',
		
		];
}
