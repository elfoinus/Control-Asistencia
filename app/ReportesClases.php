<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportesClases extends Model
{
    protected $table = "Reportesclases";
    
    public $timestamps = false;
    public $incrementing = false;

	protected $fillable = [
	
		'id_reporteClases',
		'id_registro',
		'tipo',
		'nEstudiantes',
		'descripcionRP',

		];
}
