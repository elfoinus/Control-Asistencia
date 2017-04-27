<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\BD;

use config\sesion;

use App\Usuarios;
use App\Horarios;
use App\registro;

use Carbon\Carbon; 
 

class ProfesorController extends Controller{



	
	public function calcularHorario(){
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

		
	                 //   $nombreAsignatura = id_asignatura_dependencia::where('codigo_asignatura',$horario[$i]->id_asignatura_dependencia)->get();
                       //.$nombreAsignatura."</h5></td>  

					echo "  
					    <tr>  
					      <td width='150'><h5>".$horario[$i]->id_Horario."</h5></td> 
					      <td width='150'><h5>".$horario[$i]->id_asignatura_dependencia."</h5></td> 
					      <td width='150'><h5>".$horario[$i]->dia."</h5></td> 
					      <td width='150'><h5>".$horario[$i]->hora_inicial."</h5></td> 
					      <td width='150'><h5>".$horario[$i]->cantidad_horas."</h5></td> 
					      <td width='150'><h5>".$horario[$i]->id_usuario."</h5></td> 
					      <td width='150'><h5>"."<input type='checkbox' onclick= 'toggleCheckbox(this,{$horario})' name='checkboses'  value= '{$i}'  <br>"."</td> 

					    </tr>   
					";  
						
	                     	}
	                     	
					
	}

	public function misAsignaturas(){
			# esta funcion imprime la tabla de las asignaturas del profesor a la vista profesor

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
   
					echo "  
					    <tr>  
					      <td width='150'><h5>".$asignaturas[$i]->id_asignatura_dependencia."</h5></td>  
					      <td width='150'><h5>".$asignaturas[$i]->dia."</h5></td> 
					      <td width='150'><h5>".$asignaturas[$i]->hora_inicial."</h5></td> 
					      <td width='150'><h5>".$asignaturas[$i]->cantidad_horas."</h5></td> 
					    </tr>   
					";  
						
	                     	}
	}

	public function retornarNombreAsignatura($idAsig_dependencia){
    $nombreAsignatura;
    $AsignaturaDep = Asignatura_dependencia::where('id_asignatura_dependencia',$idAsig_dependencia)->get();
     
     for ($i=0; $i < sizeof($AsignaturaDep); $i++) { 
     	
     	$nombreAsignatura=$AsignaturaDep[$i]->codigo_asignatura;
     }

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