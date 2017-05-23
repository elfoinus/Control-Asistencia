<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
    protected $table = "Reportes";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [

		'id_reporte',
		'id_usuario',
		'asunto',
		'descripcion',
		];
}
