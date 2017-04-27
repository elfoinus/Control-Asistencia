<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura_dependencia extends Model
{
    protected $table = "Asignatura_dependencia";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'codigo_asignatura',
		'codigo_dependencia',
		'id_asignatura_dependencia',
		

		];
}