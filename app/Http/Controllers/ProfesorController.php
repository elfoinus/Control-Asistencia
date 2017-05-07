<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\BD;

use config\sesion;

use App\Usuarios;
use App\Horarios;
use App\Registros;

use Carbon\Carbon; 

class ProfesorController extends Controller{



	
	public function calcularHorario(){


		# esta funcion imprime la tabla de los horarios disponibles para el profesor a la vista profesor
		$usuario = session()->get('id');

		date_default_timezone_set('America/Bogota'); //Asignas la zona horaria de tu país.
		setlocale(LC_TIME, 'spanish'); //Fijamos el tiempo local
		
		$dia=strftime("%A"); // Guardamos el Nombre del día de la semana.
	
		$dia = strtoupper($dia);
		# hacer que solo retorne los registros que tengan el dia actual con carbon  http://carbon.nesbot.com/docs/

		$dt = Carbon::now('America/Bogota');
		$fecha = $dt->toDateString();

	//	$dia = "MIERCOLES";   // aqui se cambia el dia para probar 
			
		//$horario = Horarios::where('dia',$dia)->where('id_usuario',$usuario)->get();
		

		
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
                     	

	              /* for($i = 0; $i < sizeof($horario); $i++ ){
	           		
	           		$registro = Registros::where('id_horario',$horario[$i]->id_Horario)->where('fecha',$fecha)->get();
					
					if(sizeof($registro) == 0){
						echo "  
						    <tr>  
						      <td width='150'><h5>".$horario[$i]->id_Horario."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->id_asignatura_dependencia."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->dia."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->hora_inicial."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->cantidad_horas."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->id_usuario."</h5></td> 
						      <td width='150'><h5>"."<input  type='checkbox' onclick= 'toggleCheckbox(this,{$horario})' name='checkboses'  value= '{$i}'  <br>"."</td> 

						    </tr>   
						";  
					}else{	

						echo "  
						    <tr>  
						      <td width='150'><h5>".$horario[$i]->id_Horario."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->id_asignatura_dependencia."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->dia."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->hora_inicial."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->cantidad_horas."</h5></td> 
						      <td width='150'><h5>".$horario[$i]->id_usuario."</h5></td> 
						      <td width='150'><h5>"."<input disabled checked type='checkbox' onclick= 'toggleCheckbox(this,{$horario})' name='checkboses'  value= '{$i}'  <br>"."</td> 

						    </tr>   
						";
					}

               }
	                    	
					*/
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

	

	public function NombreAsignatura($idAsig_dependencia){
    $nombreAsignatura;
    $codigoAsig = Asignatura_dependencia::where('id_asignatura_dependencia',$idAsig_dependencia)->value('codigo_asignatura');
     
    $nombreAsignatura = Asignaturas::where('codigo_asignatura',$codigoAsig)->value('nombre_asignatura');

     	
     return $nombreAsignatura;
     
	}

	public function NombreProfesor($idProfesor){
    $NombreProfesor;
     
    $NombreProfesor = Asignaturas::where('Numero_Cedula',$idProfesor)->value('nombreNombreProfesor');

     	
     return $NombreProfesor;
     
	}



	public function insertarRegistro(){
		
		    $n = $_GET['envio'];
			$usuario = session()->get('id');
			
			
	   	 	
			date_default_timezone_set('America/Bogota'); //Asignas la zona horaria de tu país.
			setlocale(LC_TIME, 'spanish'); //Fijamos el tiempo local
			
			$dia=strftime("%A"); // Guardamos el Nombre del día de la semana.
		
			$dia = strtoupper($dia);
	   	 	//$dia = 'MIERCOLES';  // cambiar el dia para hacer pruebas 
	   	 	$horario = Horarios::where('id_usuario',$usuario)->where('dia',$dia)->get();
	   	 		
		
			$dt = Carbon::now('America/Bogota');
			$fecha = $dt->toDateString(); 
			$hora = $dt->toTimeString();
			

			/*DB::table('Registros')->insert(
			[ 'id_horario' => $horario[$n]->id_Horario , 'fecha'=> $fecha , 'hora_llegada' => $hora ]
			);
		    */
			Registros::insert([ 'id_horario' => $horario[$n]->id_Horario , 'fecha'=> $fecha , 'hora_llegada' => $hora ]);
			

				
			#echo "se realizo el registro con "."fecha: ".$fecha." hora: ".$hora." id-horario: ".$horario[$n]->id_Horario;
			echo "registro realizdo satisfactoriamente :D";
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


	public function asignaturas(){

		//$asignaturas = Asignaturas::lists('nombre_asignatura','codigo');
          
          	$asignaturas = Horarios::where('id_usuario',$usuario)->get();


             echo '<option value="0">[SELECCIONE]</option>';

	              for($i = 0; $i < sizeof($asignaturas); $i++ ){

	              	 echo '<option value="'.$asignaturas[$i]->id_asignatura_dependencia.'">'.$asignaturas[$i]->id_asignatura_dependencia.'</option>';

  
						
	                     	}

	}

}