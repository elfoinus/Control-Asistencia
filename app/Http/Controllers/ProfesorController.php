<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\BD;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use config\sesion;

use App\Usuarios;
use App\Horarios;
use App\registro;

use Carbon\Carbon; 
 

class ProfesorController extends Controller{



	
	public function calcularHorario(){
		$idHorario;
		$asig;$nomAsig;
		$dia;$hInicio;$cHoras;$idProfesor;

		# esta funcion imprime la tabla de los horarios disponibles para el profesor a la vista profesor
		$usuario = session()->get('id');
		# hacer que solo retorne los registros que tengan el dia actual con carbon  http://carbon.nesbot.com/docs/

		$horario = Horarios::where('id_usuario',$usuario)->get();
       
		 echo " <tr>  
					      <td width='150' style='font-weight: bold'><h5>IDENTIFICADOR</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
					     
					      <td width='150' style='font-weight: bold'><h5>DIA</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

					      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td>

					      <td width='150' style='font-weight: bold'><h5>ASISTENCIA</h5></td>

					    </tr> 

                     <tr  >  
                    ";
                     	

	               for($i = 0; $i < sizeof($horario); $i++ ){
                     $idHorario=$horario[$i]->id_Horario;
                     $asig=$horario[$i]->id_asignatura_dependencia;
                     $dia=$horario[$i]->dia;
                     $hInicio=$horario[$i]->hora_inicial;
                     $cHoras= $horario[$i]->cantidad_horas;
                     $idProfesor = $horario[$i]->id_usuario;

                     $nomAsig= ProfesorController::nombreAsignatura($asig);

					echo "  
					    <tr>  
					      <td width='150'><h5>".$idHorario."</h5></td> 
					      <td width='150'><h5>".$nomAsig."</h5></td> 
					      <td width='150'><h5>".$dia."</h5></td> 
					      <td width='150'><h5>".$hInicio."</h5></td> 
					      <td width='150'><h5>".$cHoras."</h5></td> 
					      <td width='150'><h5>".$idProfesor."</h5></td> 
					      <td width='150'><h5>"."<input type='checkbox' onclick= 'toggleCheckbox(this,{$horario})' name='checkboses'  value= '{$i}'  <br>"."</td> 

					    </tr>   
					";  
						
	                     	}
	                     	
					
	}

	public function misAsignaturas(){
			# esta funcion imprime la tabla de las asignaturas del profesor a la vista profesor
        $id_asignatura_depen;
        $dia;
        $hInicial;
        $cHoras;
        $NombreAsig;

		$usuario = session()->get('id');

		$asignaturas = Horarios::where('id_usuario',$usuario)->get();
       
		 echo " <tr>  
					      
					      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
					     
					      <td width='150' style='font-weight: bold'><h5>DIA</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

					  

					    </tr> 

                     <tr  >  
                    ";
                     	

	              for($i = 0; $i < sizeof($asignaturas); $i++ ){
                      $id_asignatura_depen= $asignaturas[$i]->id_asignatura_dependencia;
                      $dia=$asignaturas[$i]->dia;
                      $hInicial = $asignaturas[$i]->hora_inicial;
                      $cHoras=$asignaturas[$i]->cantidad_horas;

                      $NombreAsig = ProfesorController::NombreAsignatura($id_asignatura_depen);
                      
					  echo "  
					    <tr>  
					      <td width='150'><h5>".$NombreAsig."</h5></td>  
					      <td width='150'><h5>".$dia."</h5></td> 
					      <td width='150'><h5>".$hInicial."</h5></td> 
					      <td width='150'><h5>".$cHoras."</h5></td> 
					    </tr>";  
	                }
	}

	public function NombreAsignatura($idAsig_dependencia){
    $nombreAsignatura="--";$codigoAsig="--";

    $codigoAsig = BD::table('asignatura_dependencia')->where('id_asignatura_dependencia','=',$idAsig_dependencia)->value('codigo_asignatura');
    
    $nombreAsignatura = BD::table('asignaturas')->where('codigo_asignatura','=',$codigoAsig)->value('nombre_asignatura');
     
    return $nombreAsignatura;
	}

	public function NombreProfesor($idProfesor){
    $nombreProfesor="--";

    $nombreProfesor = BD::table('usuarios')->where('Numero_cedula','=',$idProfesor)->value('nombre');
     
     
    return $nombreProfesor;
	}

	public function insertarRegistro(){
		
		$n = $_GET['envio'];
			$usuario = session()->get('id');
			# hacer que solo retorne los registros que tengan el dia actual con carbon  http://carbon.nesbot.com/docs/

			$horari = Horarios::where('id_usuario',$usuario)->get();
	   	 	
	   	 	

	   	 	$horario = $horari[$n];
		
			$dt = Carbon::now();
			$fecha = $dt->toDateString(); 
			$hora = $dt->toTimeString();
			

			/*DB::table('Registros')->insert(
			[ 'id_horario' => $horario->id_Horario , 'fecha'=> $fecha , 'hora_llegada' => $hora ]
			);
		   */
			
			echo "llego número: ".$n."se ha marcado el registro con  fecha: ".$fecha." y hora: ".$hora;
			# i = numero de registro en horario que se va a guardar
			# h = consulta de horarios mostrada al usuario
			#en este metodo se debe insertar en la tabla Registros con la fecha/hora actual
			#el id de horario que corresponda i que esta en h , 
			#nota: comparar si la hora de llegada esta cerca a la hora de  inicio indicada en h
		
	}


	private function getUsuario(){

		return $this->usuario;
	}

	private function setUsuario($nuevo){

		$this->usuario = $nuevo;
	}


	public function combobox(){


	} 





}