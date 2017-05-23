<?php

namespace App\Http\Controllers;
use config\sesion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Usuarios;
use App\Horarios;
use App\Semestre;
use App\Registros;
use App\Asignatura_dependencia;
use App\Asignaturas;
use App\Temas;
use App\ReportesClases;
use App\Reportes;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;



include'TiempoController.php';

class ProfesorController extends Controller{



	
	public function calcularHorario(){
		
		$usuario = session()->get('id');

		$tiempo = new Tiempo();

		$dia = $tiempo->get_dia();
		
		$fecha = $tiempo->get_fecha();
		$temas=null;

		$horario = Horarios::where('dia',$dia)->where('id_usuario',$usuario)->get();
		
		
		 echo " <tr>  
			      <td width='150' style='font-weight: bold'><h5>IDENTIFICADOR</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
			     
			      <td width='150' style='font-weight: bold'><h5>DIA</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ASISTENCIA</h5></td>

			      <td width='150' style='font-weight: bold'><h5>TEMA</h5></td>

			    </tr> 
	       
                    ";


                     	

       	for($i = 0; $i < sizeof($horario); $i++ ){
       		
       		$registro = Registros::where('id_horario',$horario[$i]->id_Horario)->where('fecha',$fecha)->get();
			
			if(sizeof($registro) == 0){


				$array= Temas::where('codigo_asignatura',$this->getCodigoAsignatura($horario[$i]->id_asignatura_dependencia))->where('id_usuario',$usuario)->get();

				echo "string".sizeof($array);

				for ($t=0; $t < sizeof($array); $t++) { 
				
				 	$temas.= "<option value=".$array[$t]->id_tema.">".$array[$t]->nombre."</option>";

				}

				echo "  
				    <tr>  
				      <td width='150'><h5>".$horario[$i]->id_Horario."</h5></td> 
				      <td width='150'><h5>".$this->NombreAsignatura($horario[$i]->id_asignatura_dependencia)."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->dia."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->hora_inicial."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->cantidad_horas."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->id_usuario."</h5></td> 
				      <td width='150'><h5>"."<input  type='checkbox' onclick= 'toggleCheckbox(this,{$horario})' name='checkboses'  value= '{$i}'  <br>"."</td> 
				      <td width='150'><h5>"."<select  id='selectRegistro'>".$temas."</select></td> 


				    </tr>   
				"; 

				$temas=null; 

			}else{	

				
				//$array2="<option>".$this->getNombreTema($registro->tema)"</option>"; este seria el tema seleccionado
				
				$array2="<option>Tema seleccionado</option>";

				echo "  
				    <tr>  
				      <td width='150'><h5>".$horario[$i]->id_Horario."</h5></td> 
				      <td width='150'><h5>".$this->NombreAsignatura($horario[$i]->id_asignatura_dependencia)."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->dia."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->hora_inicial."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->cantidad_horas."</h5></td> 
				      <td width='150'><h5>".$horario[$i]->id_usuario."</h5></td> 
				      <td width='150'><h5>"."<input disabled checked type='checkbox' onclick= 'toggleCheckbox(this,{$horario})' name='checkboses'  value= '{$i}'  <br>"."</td> 
				      <td width='150'><h5>"."<select   id='selectRegistro' disabled>".$array2."</select></td> 

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
					      <td width='150'><h5>".$this->NombreAsignatura($asignaturas[$i]->id_asignatura_dependencia)."</h5></td>  
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
     
    $nombreAsignatura = Asignaturas::where('codigo',$codigoAsig)->value('nombre_asignatura');

     	
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

	


	public function semanaActual(){
	    
	    $tiempo = new Tiempo();
		$fecha = $tiempo->get_fecha(); //fecha actual

		#realiza resta entre dia actual y dia de inicio del semestre que esta en la tabla Semestre
		$dias_diferencia = DB::select('select DATEDIFF( "'.$fecha.'",(select fecha_inicio from Semestre)) as dias');
		$dias = $dias_diferencia[0]->dias;
		
		

		$semanas = 1+floor($dias / 7);	

		

		
		#retorna el número de semana actual partiendo de la fecha en la tabla Semestre
		return $semanas;
	}

	public function numDiaSemana($dia){
		$numdia = 0;
		switch ($dia) {
			case 'LUNES':
				$numdia = 1;
				break;
			case 'MARTES':
				$numdia = 2;
				break;
			case 'MIÉRCOLES':
				$numdia = 3;
				break;
			case 'JUEVES':
				$numdia = 4;
				break;
			case 'VIERNES':
				$numdia = 5;
				break;
			case 'SABADO':
				$numdia = 6;
				break;
			case 'DOMINGO':
				$numdia = 7;
				break;
		
		}

		return $numdia;
	}

	public function id_horarios_deuda(){

		$usuario = session()->get('id');

		$deuda = array();
		
		$ids = DB::select('select  id_Horario from Horarios where id_usuario ='.$usuario);
		#$ids = DB::select('select  id_Horario from Horarios where id_usuario = 1130621261');

		$tiempo = new Tiempo();
		$hoy = $this->numDiaSemana($tiempo->get_dia());
		$semana_actual = $this->semanaActual();
		
		for($i = 0; $i < sizeof($ids); $i++ ){

			$id = $ids[$i]->id_Horario;
			$count = DB::select('select  count(id_horario) as n from Registros where id_horario = '.$id);
			
			$nregistros = $count[0]->n;

			#$dia = DB::select('select  dia as n from Horarios where id_horario = '.$id);
			$dia = Horarios::where('id_horario',$id)->first();
			$diaHorario = $dia->dia; #dia del horario

			
			#$this->numDiaSemana($diaHorario)

			if ($semana_actual != $nregistros ) {
				$diferencia = $semana_actual - $nregistros;
				if  ($diferencia == 1 && $hoy > $this->numDiaSemana($diaHorario)){
				
			    }else{
			    	array_push($deuda,$id);				
					array_push($deuda,$diferencia);
			    }		
			} 
			

		}
		#retorna arreglo con id's que deben hasta el dia actual
		#seguido cada uno de  cuantas clases debe
		return $deuda;  

	}

	public function tablasDeuda(){

		$deuda = $this->id_horarios_deuda();
				echo " <tr>  
					      
					      <td width='150' style='font-weight: bold'><h5>ID HORARIO</h5></td>
					     
					      <td width='150' style='font-weight: bold'><h5>MATERIA</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>DIA</h5></td>
					      
					      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>

					  	<td width='150' style='font-weight: bold'><h5>N° CLASES QUE DEBE</h5></td>

					    </tr> 

                     <tr  >  
                    ";


		for ($i=0; $i < sizeof($deuda); $i = $i + 2) { 
			$horario = Horarios::where('id_horario',$deuda[$i])->first();
			echo "  
					    <tr>  
					      <td width='150'><h5>".$horario->id_Horario."</h5></td>  
					      <td width='150'><h5>".$horario->id_asignatura_dependencia."</h5></td> 
					      <td width='150'><h5>".$horario->dia."</h5></td> 
					      <td width='150'><h5>".$horario->hora_inicial."</h5></td> 
					      <td width='150'><h5>".$deuda[$i+1]."</h5></td> 
					    </tr>   
					";  
						

		}
		
	}
	
	public function asignaturas(){

		//$asignaturas = Asignaturas::lists('nombre_asignatura','codigo');
          
          	$asignaturas = Horarios::where('id_usuario',$usuario)->get();


             echo '<option value="0">[SELECCIONE]</option>';

	              for($i = 0; $i < sizeof($asignaturas); $i++ ){

	              	 echo '<option value="'.$asignaturas[$i]->id_asignatura_dependencia.'">'.$asignaturas[$i]->id_asignatura_dependencia.'</option>';

  
						
	                     	}

	}

	public function ListarAsignaturasUsuario(){


		$usuario = session()->get('id');


		$asignaturas = Horarios::where('id_usuario',$usuario)->get();

		$enviar='';
		$array='';

 		if($asignaturas==NULL){

 				$enviar	='<option value="0" disable>Usted no tiene asignaturas </option>';

 		}else{

 			 for($i = 0; $i < sizeof($asignaturas); $i++ ){

	          $array.=  '<option value="'.$this->getCodigoAsignatura($asignaturas[$i]->id_asignatura_dependencia).'">'.$this->getNombreAsignatura($asignaturas[$i]->id_asignatura_dependencia).'</option>';
       		
 			}

          $enviar= '<option value="0" disable>[Seleccione]</option>'.$array;
        }

	  return $enviar;
          
	}


	private function getNombreAsignatura($idAsig_dependencia){
    
    $nombreAsignatura='';
    
    $codigoAsig = Asignatura_dependencia::where('id_asignatura_dependencia',$idAsig_dependencia)->value('codigo_asignatura');
     
    $nombreAsignatura = Asignaturas::where('codigo',$codigoAsig)->value('nombre_asignatura');

     	
     return $nombreAsignatura;
     
	}
    
    private function getCodigoAsignatura($idAsig_dependencia){
    
    $codigoAsig='';
    
    $codigoAsig = Asignatura_dependencia::where('id_asignatura_dependencia',$idAsig_dependencia)->value('codigo_asignatura');

     	
     return $codigoAsig;
     
	}


	public function listarAsigParaReporte(){
     

       $tiempo = new Tiempo();
     $usuario = session()->get('id');
     $dia = $tiempo->get_dia();
     $fecha = $tiempo->get_fecha();
     $enviar='';
		$array=null;



        $horario = Horarios::Where('id_usuario',$usuario)->where('dia',$dia)->get();

        $registros=Registros::where('fecha',$fecha)->get();

       
        	
     
        for ($i=0; $i < sizeof($registros); $i++) { 
        	
        	for ($a=0; $a < sizeof($horario); $a++) { 
        		
        		if(($horario[$a]->id_Horario)==($registros[$i]->id_horario)){

	             $array.=  '<option value="'.$registros[$i]->id_Registros.'">'.$this->getNombreAsignatura($horario[$a]->id_asignatura_dependencia).'</option>';
                  

        		}
        	}
        }
        
        if ($array==NULL) {

        $enviar= '<option value="0" disable>Usted no tiene horarios</option>';

        }else{

        $enviar= '<option value="0" disable>[Seleccione]</option>'.$array;
          
          }

	  return $enviar;

	}


	public function registrarReporte(){
		

		
		$id_registro = $_GET['id_registro'];
		$tipo = $_GET['tipo'];
		$nEstudiantes = $_GET['nEstudiantes'];
		$descripcionRP= $_GET['descripcionRP'];


		ReportesClases::insert([ 'id_registro' => $id_registro ,'tipo' => $tipo , 'numeroEstudiantes'=> $nEstudiantes, 'descripcion'=> $descripcionRP ]);


		return "Reporte registrado";

	}

	public function crearTema(){


        $usuario = session()->get('id');

		$codigo_asignatura = $_GET['codigoAsig'];
		$NombreTema = $_GET['NombreTema'];
		$DescripcionTema = $_GET['DescripcionTema'];


		Temas::insert([ 'codigo_asignatura' => $codigo_asignatura ,'id_usuario' => $usuario , 'nombre'=> $NombreTema, 'descripcion'=> $DescripcionTema ]);


		return "Tema registrado";
	}



	 public function getPasswordUsuario( $usuario){


     $password = Usuarios::where('Numero_cedula',$usuario)->value('password');	

     return $password;
    }

    public function getNombreTema($id_tema){

    $usuario = session()->get('id');

    $tema = Temas::where('id_tema',$id_tema)->value('nombre');

    return $tema;
    }

	public function cambiarClave(){


	$mensaje='';		

 	$usuario = session()->get('id');


 	$passwordOldC  = $this->getPasswordUsuario($usuario);
     
 	$passwordOld = $_GET['PasswordOldp'];
 	$passwordNew = $_GET['PasswordNewp'];
 	$passwordNewC= $_GET['PasswordNewCp'];


 	if ($passwordOld == $passwordOldC) {

          if ($passwordNew==$passwordNewC) {

            	Usuarios::where('Numero_cedula',$usuario)->update(['password' => $passwordNewC]);

          	 $mensaje ='Su contraseña se ha modificado Satisfactoriamente!!';
      
          }else{
          
           $mensaje ='Las contraseñas no coinciden!!';
          }
   
       }else{

        $mensaje ='Tu contraseña antigua es incorrecta!!';
       }

 		return $mensaje;

	}

	


}