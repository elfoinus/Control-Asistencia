<?php

namespace App\Http\Controllers;
use config\sesion;
use Illuminate\Support\Facades\DB;

use App\Usuarios;
use App\Horarios;
use App\Semestre;
use App\Registros;


include'TiempoController.php';

class ProfesorController extends Controller{



	
	public function calcularHorario(){
		
		$usuario = session()->get('id');

		$tiempo = new Tiempo();

		$dia = $tiempo->get_dia();
		
		$fecha = $tiempo->get_fecha();

		$horario = Horarios::where('dia',$dia)->where('id_usuario',$usuario)->get();
		
		
		 echo " <tr>  
			      <td width='150' style='font-weight: bold'><h5>IDENTIFICADOR</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
			     
			      <td width='150' style='font-weight: bold'><h5>DIA</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ASISTENCIA</h5></td>

			    </tr> 

	       
                    ";
                     	

       	for($i = 0; $i < sizeof($horario); $i++ ){
       		
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
			
			
	   	 	$tiempo = new Tiempo();
			
			$dia = $tiempo->get_dia();

	   	 	$horario = Horarios::where('id_usuario',$usuario)->where('dia',$dia)->get();
	   	 		
			$fecha = $tiempo->get_fecha();
			$hora = $tiempo->get_hora();	
			
			Registros::insert([ 'id_horario' => $horario[$n]->id_Horario , 'fecha'=> $fecha , 'hora_llegada' => $hora ]);
			

				
			#echo "se realizo el registro con "."fecha: ".$fecha." hora: ".$hora." id-horario: ".$horario[$n]->id_Horario;
			echo "registro realizo satisfactoriamente :D";
			# i = numero de registro en horario que se va a guardar
			# h = consulta de horarios mostrada al usuario
			#en este metodo se debe insertar en la tabla Registros con la fecha/hora actual
			#el id de horario que corresponda i que esta en h , 
			#nota: comparar si la hora de llegada esta cerca a la hora de  inicio indicada en h
		
	}

	




	public function combobox(){


	} 




	public function semanaActual(){
	    
	    $tiempo = new Tiempo();
		$fecha = $tiempo->get_fecha();

		#realiza resta entre dia actual y dia de inicio del semestre que esta en la tabla Semestre
		$dias_diferencia = DB::select('select DATEDIFF( "'.$fecha.'",(select fecha_inicio from Semestre)) as dias');
		$dias = $dias_diferencia[0]->dias;
		
		if($dias < 7){
			$semanas = 1;
		}else{

		$semanas = floor($dias / 7);	

		}

		
		#retorna el número de semana actual partiendo de la fecha en la tabla Semestre
		return $semanas;
	}


	public function id_horarios_deuda(){

		$usuario = session()->get('id');

		$deuda = array();

		$ids = DB::select('select  id_Horario from Horarios where id_usuario ='.$usuario);
		#$ids = DB::select('select  id_Horario from Horarios where id_usuario =789');

		for($i = 0; $i < sizeof($ids); $i++ ){

			$id = $ids[$i]->id_Horario;
			$count = DB::select('select  count(id_horario) as n from Registros where id_horario = '.$id);

			$semana_actual = $this->semanaActual();

			if ($semana_actual != $count[0]->n) {
				array_push($deuda,$id);
				
			} 
			
		}
		
		#for($i = 0; $i < sizeof($deuda); $i++ ){
		#echo $deuda[$i].'-';
		#}
		return $deuda;  #retorna arreglo con id's horarios que no estan al dia, es decir no bien con la asistencia
	}


}