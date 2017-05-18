<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use App\Usuarios;
use App\Dependencias;
use App\Asignaturas;
use App\Asignatura_dependencia;
use App\Horarios;

use Carbon\Carbon;
use Excel;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\BD;
use config\sesion;
use App\Registros;

include'TiempoController.php';
class AdministradorController extends Controller
{

	public function subirDatos(){

		$tmp_name = $_FILES['archivoExcelProgramacionAcademica']['tmp_name'];

		if( move_uploaded_file($tmp_name, $tmp_name) ){

			$this->llenarBaseDeDatos( $tmp_name );
		}
	}


	//Llena toda las BD según el archivo de programación académica (excepto la tabla usuarios y registros)
	private function llenarBaseDeDatos( $nombreDelArchivo ){


		Excel::load( $nombreDelArchivo, function($reader) {

			$datos = $reader->toArray();


			//Se hace secuencialmente, decidí sacrificar la eficiencia por aumentar la legibilidad del código
			//además es algo que ejecutará el administrador una vez por semestre y tampoco es mucho tiempo
			//lo que debe esperar.
			$this->llenarTablaUsuariosConDocentes( $datos );
			$this->llenarTablaDependencias( $datos );
			$this->llenarTablaAsignaturas( $datos ); 
			$this->llenarTablaAsignaturas_Dependencias( $datos );
			$this->llenarTablaHorarios( $datos );


		});
	
		return "Listo, datos guardados en el servidor";

	}


	public function registrarUsuario(){

		
		$numero_cedula = $_GET['numero_cedula'];
		$password = $_GET['password'];
		$nombre = $_GET['nombre'];
		$correo = $_GET['correo'];
		$estado = $_GET['estado'];
		$id_perfil = $_GET['id_perfil'];

		Usuarios::insert([ 'numero_cedula' => $numero_cedula , 'password'=> $password , 'nombre' => $nombre, 'correo' => $correo, 'estado' => $estado,  'id_perfil' => $id_perfil]);


		return "Usuario registrado";
	}


	private function llenarTablaDependencias( $datos ){

		//Por cada registro del archivo excel...
		foreach ($datos as $registro) {

			if($registro[1] != null){
				
				$codigoDependencia = explode( '-', $registro[1] );
				
				//Verificamos si la dependencia ya está en la BD, si no está la insetamos
				if( Dependencias::where('codigo', '=', $codigoDependencia[0])->first() == null ){

					Dependencias::insert([ 'codigo' => $codigoDependencia[0] , 'nombre'=> 'actualizarNombreDependencia' , 'id_coordinador' => 'actualizarId_Coor' ]);
				}

			}

		}

	}

	private function llenarTablaUsuariosConDocentes( $datos ){

		//Por cada registro del archivo excel...
		foreach ($datos as $registro) {

			//Verificamos si el docente ya está en la BD, si no está lo insetamos
			if( $registro[9] != null && Usuarios::where('Numero_cedula', '=', $registro[9])->first() == null ){

				Usuarios::insert([ 'numero_cedula' => $registro[9] , 'password'=> $registro[9] , 'nombre' => $registro[8], 'correo' => 'actualizarCorreo', 'estado' => 1,  'id_perfil' => 2   ]);

			}
		}

	}

	private function llenarTablaAsignaturas( $datos ){

		//Por cada registro del archivo excel...
		foreach ($datos as $registro) {

			//Verificamos si la asignatura ya está en la BD, si no está la insetamos
			if( $registro[3] != null && Asignaturas::where('codigo', '=', $registro[3])->first() == null ){

				$horasSemanales = 0;
				if( $registro[11] != null )
					$horasSemanales = $registro[11];	

				Asignaturas::insert([ 'codigo' => $registro[3] , 'nombre_asignatura'=> $registro[7], 'horas_semanales' => $horasSemanales, 'jornada' => $this->calcularJornada( $registro[1] ) ]);

			}
		}		
	}

	private function llenarTablaAsignaturas_Dependencias( $datos ){

		//Por cada registro del archivo excel...
		foreach ($datos as $registro) {

			if($registro[1] != null){
				
				$codigoDependencia = explode( '-', $registro[1] );
				
				//Verificamos si la relación asignatura_dependencia ya está en la BD, si no está la insetamos
				if( Asignatura_dependencia::where('codigo_dependencia', '=', $codigoDependencia[0])
					->where('codigo_asignatura', '=', $registro[3])
					->first() == null ){

					Asignatura_dependencia::insert([ 'codigo_asignatura' => $registro[3], 'codigo_dependencia' => $codigoDependencia[0] ]);
				}

			}

		}

	}

	private function llenarTablaHorarios( $datos ){

		//Por cada registro del archivo excel...
		foreach ($datos as $registro) {

			if($registro[1] != null){
				
				$codigoDependencia = explode( '-', $registro[1] );
					
				$id_asignatura_dependencia = Asignatura_dependencia::where('codigo_dependencia', '=', $codigoDependencia[0])
									->where('codigo_asignatura', '=', $registro[3])
									->first()->id_asignatura_dependencia; 


				//La hora por defecto será la hora en que se este registrando los datos
				//cambia si en el excel está específicada la hora
				//si no está específicada es porque es presentación de tesis, en ese
				//caso se maneja de forma distinta					
				$dt = Carbon::now('America/Bogota');
				$fecha = $dt->toDateString(); 
				$horaInicial = $dt->toTimeString();

				if( $registro['a'] != null && $registro['a'] != 'NA') 					
					$horaInicial = $registro['a'];

				$dia = 'LUNES';
				if($registro[12] != null && $registro[12] != 'NA')
					$dia = $registro[12];

				//Verificamos si el horario ya está en la BD, si no está lo insetamos
				if( Horarios::where('id_asignatura_dependencia', '=', $id_asignatura_dependencia)
					->where('hora_inicial', '=', $horaInicial)
					->where('id_usuario', '=', $registro[9] )
					->first() == null ){

					Horarios::insert([ 'id_asignatura_dependencia' => $id_asignatura_dependencia , 'dia'=> $dia, 'hora_inicial' => $horaInicial, 'cantidad_horas' => $this->calcularCantidadHoras($horaInicial, $registro['b']), 'id_usuario' => $registro[9] ]);
				}

			}

		}

	}	


	private function calcularJornada( $jornada ){


		$arrayDependencia_jornada = explode( '-', $jornada );

		//Si el tamaño es 1, es una electiva o una obligatoria de ley
		//en este caso no registramos su jornada, ya que estas asignaturas no obedecen los filtros
		if( sizeof( $arrayDependencia_jornada ) == 1 )
			return '-';

		if( $arrayDependencia_jornada[1] == 'DIU' )
			return 'D';


		return 'N';
	}

	private function calcularCantidadHoras($horaInicial, $horaFinal){
		return 0;
	}


//--------------------Javier-----------------------------------------//

 
 public function ListarUsuarios(){

		//$Usuarios = Usuarios::lists('Numero_cedula','nombre');

		$Usuarios = Usuarios::all();
     $enviar=' ';
     $array='';
          
          for($i = 0; $i < sizeof($Usuarios); $i++ ){

	          $array.=  '<option value="'.$Usuarios[$i]->Numero_cedula.'">'.$Usuarios[$i]->Numero_cedula.'--'.$Usuarios[$i]->nombre.'</option>';
  
	      }

   $enviar.= '<option value="0" disable>[Seleccione]</option>'.$array;

	  return $enviar;

	}

		public function ListarAsignaturas(){

		//$asigDepen=Asignaturas_dependencia::all();

		$asig=Asignaturas::all();

		$enviar='';
		$array='';


          for($i = 0; $i < sizeof($asig); $i++ ){

	          $array.=  '<option value="'.$asig[$i]->codigo.'">'.$asig[$i]->codigo.'--'.$asig[$i]->nombre_asignatura.'</option>';
  
	      }

      $enviar.= '<option value="0" disable>[Seleccione]</option>'.$array;
          	 

	  return $enviar;
          
	}



	public function getNombreAsignatura($idAsig_dependencia){
    
    $nombreAsignatura='';
    
    $codigoAsig = Asignatura_dependencia::where('id_asignatura_dependencia',$idAsig_dependencia)->value('codigo_asignatura');
     
    $nombreAsignatura = Asignaturas::where('codigo',$codigoAsig)->value('nombre_asignatura');

     	
     return $nombreAsignatura;
     
	}

	public function getNombreUsuario($idUsuario){

    $NombreUsuario='';
     
    $NombreUsuario = Usuarios::where('Numero_Cedula',$idUsuario)->value('nombre');

     	
     return $NombreUsuario;
     
	}


	public function getTipoUsuario($idUsuario){

    $TipoUsuario='';
     
    $TipoUsuario = Usuarios::where('Numero_Cedula',$idUsuario)->value('id_perfil');

     	
     return $TipoUsuario;
     
	}

	public function getTipoUsuarioConIdhorario($idHorario){
   
    $TipoUsuario='';
    $idUsuario='';
     
    $idUsuario = Horarios::where('id_Horario',$idHorario)->value('id_usuario');

    $TipoUsuario = AdministradorController::getTipoUsuario($idUsuario);

     	
     return $TipoUsuario;
     
	}


	public function generarReporte(){
   

        $id_usuario = $_GET['id_usuario'];
		$asunto = $_GET['asunto'];
		$descripcion = $_GET['descripcion'];

		Usuarios::insert([ 'id_usuario' => $id_usuario ,'asunto' => $descripcion , 'password'=> $descripcion ]);


		return "reporte registrado";
   }
     

  

///falta temirnar la tabla para reportes


  public function cambiarClave(){
 	$mensaje='';		

 	$usuario = session()->get('id');
 	$passwordOldC  = session()->get('password');

 	$passwordOld = $_GET['passwordOld'];
 	$passwordNew = $_GET['passwordNew'];
 	$passwordNewC= $_GET['passwordNewC'];

 	
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



    public function crearHorario(){

    	$mensaje='';

        $idAsig_dependencia = $_GET['asig_Dependencia'];
		$dia = $_GET['dia'];
		$hora_inicial = $_GET['horaInicial'];
		$cantidad_horas = $_GET['cantidadHoras'];
		$id_usuario = $_GET['SelectId_usuarioCH'];

		$validar=Horarios::where('dia',$dia)->where('dia',$idAsig_dependencia)->where('dia',$hora_inicial)->where('dia',$id_usuario)->where('dia',$dia)->get();
 			
 			if ($validar==null) {
		 
		      Usuarios::insert([ 'id_asignatura_dependencia' => $idAsig_dependencia , 'dia'=> $dia , 'hora_inicial' => $hora_inicial, 'cantidad_horas' => $cantidad_horas, 'id_usuario' => $id_usuario]);
 			$mensaje = 'El horario se ha creado Satisfactoriamente!!';

 			}else{
              $mensaje = 'Ya existe un horario con estas especificaciones';
 			}

		return $mensaje;
	}

	public function CambiarClaveUsuarios(){
  

  	$mensaje='';		

 	$id_usuario = $_GET['id_usuario'];
 	$passwordNew = $_GET['passwordNew'];
 	$passwordNewC= $_GET['passwordNewC'];


 	
          if ($passwordNew==$passwordNewC) {

          	Usuarios::where('Numero_cedula',$id_usuario)->update(['password' => $passwordNewC]);
          	

          	 $mensaje ='Su contraseña se ha modificado Satisfactoriamente!!';
      
          }else{
          
           $mensaje ='Las contraseñas no coinciden!!';
          }


 		return $mensaje;

	}


    public function getPasswordUsuario( $usuario){


     $password = Usuarios::where('Numero_cedula',$usuario)->value('password');	

     return $password;
    }


	public function ListarProfesoresHoy(){

     
		$tiempo = new Tiempo();

		$dia = $tiempo->get_dia();

		
		$fecha = $tiempo->get_fecha();

     
        $horario = Horarios::where('dia',$dia)->get();

        $registros=Registros::where('fecha',$fecha)->get();

        $array=''; $array1='';



		 echo "
             <table border='1' id='asistieronHoy' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
             
                  
		        <tr>  
			      <td width='150' style='font-weight: bold'><h5>ID HORARIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>FECHA</h5></td>
			     
			      <td width='150' style='font-weight: bold'><h5>HORA LLEGADA</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td> 

			       <td width='150' style='font-weight: bold'><h5>DOCENTE</h5></td>

			    </tr>";



	              for($i = 0; $i < sizeof($registros); $i++ ){
                      
                    if (AdministradorController::getTipoUsuarioConIdhorario($registros[$i]->id_horario)==2) {
                      	
	              	  for($a = 0; $a< sizeof($horario); $a++ ){
                          
                          	if(($horario[$a]->id_Horario)==($registros[$i]->id_horario)){
                          		  $array1 = "
                          		        <td width='150'><h5>".AdministradorController::getNombreAsignatura($horario[$a]->id_asignatura_dependencia)."</h5></td> 
                          		        <td width='150'><h5>".$horario[$a]->hora_inicial."</h5></td> 
                          		        <td width='150'><h5>".$horario[$a]->cantidad_horas."</h5></td> 
                          		        <td width='150'><h5>".$horario[$a]->id_usuario."</h5></td>
                          		        <td width='150'><h5>".AdministradorController::getNombreUsuario($horario[$a]->id_usuario)."</h5></td>";
                          	}

                          	$array.=$array1;
                          	$array1=NULL;
                          }

	                echo "  
					    <tr>  
					      <td width='150'><h5>".$registros[$i]->id_horario."</h5></td>  
					      <td width='150'><h5>".$registros[$i]->fecha."</h5></td> 
					      <td width='150'><h5>".$registros[$i]->hora_llegada."</h5></td>

                          ".$array." </tr> ";
					    }
					    	$array=NULL;
                          	$array1=NULL;
					}

					 echo "</table>";
						
	                     	
	}

		public function ListarProfesoresHoySinAsistencia(){

     
		$tiempo = new Tiempo();

		$dia = $tiempo->get_dia();
		
		$fecha = $tiempo->get_fecha();

		$valor=null;
		$valor2=null;

     
        $horario = Horarios::where('dia',$dia)->get();

        $registros=Registros::where('fecha',$fecha)->get();

        $array='';     $array1='';$temporalS=array(); $temporalN=array();



		 echo "
             <table border='1' id='asistieronHoy' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
             
                  
		        <tr>  
			      <td width='150' style='font-weight: bold'><h5>ID HORARIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td> 

			       <td width='150' style='font-weight: bold'><h5>DOCENTE</h5></td>

			    </tr> 

	       
                    ";
                 

                  for($i = 0; $i < sizeof($horario); $i++ ){

 
	              	  for($a = 0; $a< sizeof($registros); $a++ ){

                          	if(($horario[$i]->id_Horario)==($registros[$a]->id_horario)){
                             
                                array_push($temporalN, $horario[$i]);

                                echo " temporalN PRIMER IF".$i.'--'.$horario[$i]->id_Horario." <BR>";
                             }


                          	  else{

                          	  	 echo "PRIMER ELSE ".$a." <BR>";
									
								if (AdministradorController::getTipoUsuario($horario[$i]->id_usuario)==2) {

                     						 echo " PROFESOR IF ".'--'.$horario[$i]->id_Horario."<BR>";

									for ($r=0; $r <sizeof($temporalS)  ; $r++) { 

										if($temporalS[$r]->id_Horario == $horario[$i]->id_Horario)  {
       										
       										echo " esta en que si va ".'--'.$horario[$i]->id_Horario." <BR>";
       										$valor = true;

       										
										}
									}


									for ($t=0; $t <sizeof($temporalN)  ; $t++) { 

										if($temporalN[$t]->id_Horario == $horario[$i]->id_Horario)  {
       										
       										echo " esta en que No va ".'--'.$horario[$i]->id_Horario." <BR>";
       										$valor2 = true;


										}
									}


									if (($valor != true)and($valor2 != true)) {
									 
									  echo "IF  VALORES ".'--'.$horario[$i]->id_Horario."<BR> ";

									   array_push($temporalS, $horario[$i]);
                                        
                                        $valor=null; $valor2=null;
									}
									 $valor=null; $valor2=null;
                          		 } 
                          	}
                        }
                   }                    
                 

 			 	
 			 	$resultado = array_unique($temporalS);



                for ($p=0; $p < sizeof($resultado); $p++) { 
                	
                	 echo  "<tr> 
                              <td width='150'><h5>".$temporalS[$p]->id_Horario."</h5></td>
                              <td width='150'><h5>".AdministradorController::getNombreAsignatura($temporalS[$p]->id_asignatura_dependencia)."</h5></td> 
                              <td width='150'><h5>".$temporalS[$p]->hora_inicial."</h5></td> 
                              <td width='150'><h5>".$temporalS[$p]->cantidad_horas."</h5></td> 
                              <td width='150'><h5>".$temporalS[$p]->id_usuario."</h5></td>
                              <td width='150'><h5>".AdministradorController::getNombreUsuario($temporalS[$p]->id_usuario)."</h5></td> 
                            </tr>" ;	
                }
			
			 echo " </table>";
	}


    public function ListarMonitoresHoy(){
     
		
		$tiempo = new Tiempo();

		$dia = $tiempo->get_dia();
		
		$fecha = $tiempo->get_fecha();

     
        $horario = Horarios::where('dia',$dia)->get();

        $registros=Registros::where('fecha',$fecha)->get();

        $array=''; $array1='';



		 echo "
             <table border='1' id='asistieronHoy' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
             
                  
		        <tr>  
			      <td width='150' style='font-weight: bold'><h5>ID HORARIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>FECHA</h5></td>
			     
			      <td width='150' style='font-weight: bold'><h5>HORA LLEGADA</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td> 

			       <td width='150' style='font-weight: bold'><h5>DOCENTE</h5></td>

			    </tr>";



	              for($i = 0; $i < sizeof($registros); $i++ ){
                      
                    if (AdministradorController::getTipoUsuarioConIdhorario($registros[$i]->id_horario)==3) {
                      	
	              	  for($a = 0; $a< sizeof($horario); $a++ ){
                          
                          	if(($horario[$a]->id_Horario)==($registros[$i]->id_horario)){
                          		  $array1 = "
                          		        <td width='150'><h5>".AdministradorController::getNombreAsignatura($horario[$a]->id_asignatura_dependencia)."</h5></td> 
                          		        <td width='150'><h5>".$horario[$a]->hora_inicial."</h5></td> 
                          		        <td width='150'><h5>".$horario[$a]->cantidad_horas."</h5></td> 
                          		        <td width='150'><h5>".$horario[$a]->id_usuario."</h5></td>
                          		        <td width='150'><h5>".AdministradorController::getNombreUsuario($horario[$a]->id_usuario)."</h5></td>";
                          	}

                          	$array.=$array1;
                          	$array1=NULL;
                          }

	                echo "  
					    <tr>  
					      <td width='150'><h5>".$registros[$i]->id_horario."</h5></td>  
					      <td width='150'><h5>".$registros[$i]->fecha."</h5></td> 
					      <td width='150'><h5>".$registros[$i]->hora_llegada."</h5></td>

                          ".$array." </tr> ";
					    }
					    	$array=NULL;
                          	$array1=NULL;
					}

					 echo "</table>";
						
	                     	
	}

		public function ListarMonitoresHoySinAsistencia(){

     
	$tiempo = new Tiempo();

		$dia = $tiempo->get_dia();
		
		$fecha = $tiempo->get_fecha();

		$valor=null; $valor2=null;

     
        $horario = Horarios::where('dia',$dia)->get();

        $registros=Registros::where('fecha',$fecha)->get();

        $array='';     $array1='';$temporalS=array(); $temporalN=array();



		 echo "
             <table border='1' id='asistieronHoy' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
             
                  
		        <tr>  
			      <td width='150' style='font-weight: bold'><h5>ID HORARIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>ASIGNATURA</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>HORA INICIO</h5></td>
			      
			      <td width='150' style='font-weight: bold'><h5>CANTIDAD HORAS</h5></td>

			      <td width='150' style='font-weight: bold'><h5>ID DOCENTE</h5></td> 

			       <td width='150' style='font-weight: bold'><h5>DOCENTE</h5></td>

			    </tr> 

	       
                    ";
                 

                  for($i = 0; $i < sizeof($registros); $i++ ){

 
	              	  for($a = 0; $a< sizeof($horario); $a++ ){

                          	if(($horario[$a]->id_Horario)==($registros[$i]->id_horario)){
                             
                                array_push($temporalN, $horario[$a]);
                             }
                          	  else{
									
								if (AdministradorController::getTipoUsuario($horario[$a]->id_usuario)==3) {

									for ($r=0; $r <sizeof($temporalS)  ; $r++) { 

										if($temporalS[$r]->id_Horario == $horario[$a]->id_Horario)  {
       										
       										$valor = true;
										}
									}


									for ($t=0; $t <sizeof($temporalN)  ; $t++) { 

										if($temporalN[$t]->id_Horario == $horario[$a]->id_Horario)  {
       										
       										$valor2 = true;
										}
									}




									if (($valor != true)and($valor2 != true)) {
									
									   array_push($temporalS, $horario[$a]);
                                        
                                        $valor=null; $valor2=null;
									}
                          		 } 
                          	}
                        }
                   }

                for ($p=0; $p < sizeof($temporalS); $p++) { 
                	
                	 echo  "<tr> 
                              <td width='150'><h5>".$temporalS[$p]->id_Horario."</h5></td>
                              <td width='150'><h5>".AdministradorController::getNombreAsignatura($temporalS[$p]->id_asignatura_dependencia)."</h5></td> 
                              <td width='150'><h5>".$temporalS[$p]->hora_inicial."</h5></td> 
                              <td width='150'><h5>".$temporalS[$p]->cantidad_horas."</h5></td> 
                              <td width='150'><h5>".$temporalS[$p]->id_usuario."</h5></td>
                              <td width='150'><h5>".AdministradorController::getNombreUsuario($temporalS[$p]->id_usuario)."</h5></td> 
                            </tr>" ;	
                }
			
			 echo " </table>";

						
	                     	
	}

    





}



