<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\BD;

use config\sesion;

use App\Asignaturas;
use App\Usuarios;
use App\Horarios;
use App\Registros;

use Carbon\Carbon; 

class AdministradorController extends Controller{



	
	public function asignaturas(){

		//$asignaturas = Asignaturas::lists('nombre_asignatura','codigo');
          
          	$asignaturas = Horarios::where('id_usuario',$usuario)->get();


             echo '<option value="0">[SELECCIONE]</option>';

	             for($i = 0; $i < sizeof($asignaturas); $i++ ){

	              	 echo '<option value="'.$asignaturas[$i]->id_asignatura_dependencia.'">'.$asignaturas[$i]->id_asignatura_dependencia.'</option>';

  
						
	                     	}

	}

}