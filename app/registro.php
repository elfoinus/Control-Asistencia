<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    protected $table = "Registros";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'id_Registros',
		'id_horario',
		'fecha',
		'hora_llegada',
			


		];
}
