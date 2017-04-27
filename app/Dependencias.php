<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencias extends Model
{
    protected $table = "Dependencias";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'codigo',
		'nombre',
		'id_coordinador',
		

		];
}