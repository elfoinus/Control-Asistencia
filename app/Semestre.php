<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    protected $table = "Semestre";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'fecha_inicio',
		'fecha_fin',
					
		];
}
