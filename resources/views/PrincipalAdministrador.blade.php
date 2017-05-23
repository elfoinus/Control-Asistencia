 <!DOCTYPE html>
<html>
	<head>
  		<title>Universidad Del Valle Sede Norte Del Cauca</title>
		<link rel="icon" type="image/png" href="{{ URL::to('Imagenes/Favicon.ico') }} " />
	    <link rel="stylesheet" href=" {{ URL::to('CSS/Principal.css') }} ">
	    <link rel="stylesheet" href=" {{ URL::to('CSS/VistaAdministrador.css') }} ">

    	  <script type="text/javascript" src="JS/Jquery.js"></script>
		  <script type="text/javascript" src="JS/Principal.js"></script>
		  <script type="text/javascript" src="JS/Administrador.js"></script>

    	  <meta charset="UTF-8">

	</head>

	<body>
      
		<header>
				<div class="wrapper">
					<div class="logo"><img src="Imagenes/Favicon.gif"><h1>Gestion Integral</h1></div>
					
					<nav>
						<a id = "eti1" href="#" onclick="mostrar(1)">Inicio</a>
						<a id = "eti2" href="#" onclick="mostrar(2)">Control</a>
						<a id = "eti3" href="#" onclick="mostrar(3)">Administración</a>
						<a id = "eti4" href="/" onclick="">Salir</a>
					</nav>
					</div>
				</div>

		</header>
      
		<section class="wrapper">
		 
			<div id="inicio" style="display: none">
			    <h2>Inicio</h2>

			    <p>Hola, Bienvenido</p>
                <h1>{{$mensaje}}</h1>
			</div>	

		    <div id="control" style="display: none">
			  <div id="menu">
			   <nav>
  	              <ul class="parent-menu">
                    <li><a href="#">Asistencia</a> 
    	              <ul> 
			    		<li><a href="#" onClick="AsistenciaProfesores()" >Asistencia Profesores</a></li> 
			    		<li><a href="#" onClick="AsistenciaMonitores()" >Asistencia Monitores</a></li> 
    			  	  </ul> 
                    </li> 

                    <li><a href="#" onClick="generarReporte()">Generar Reporte</a></li>
                     <li><a href="#" onClick="cambioClave()">Cambio de clave</a></li>  
                 </ul>
               </na
               v>
		      </div>		
		    </div>

			<div id="admin" style="display: none">
				<div id="menu1">
			     <nav>
					  <ul class="parent-menu">
					    <li><a href="#">Configuracion</a> 
					    	<ul> 
					    		<li><a href="#" onClick="subirProgramacion()">Subir Programacion</a></li> 
					    		<li><a href="#" onClick="crearProgramacion()" >Crear Programacion</a></li> 
					    	
					    	</ul> 
					    </li> 

					<li><a href="#">Informes</a>
					  <ul> 
            <li><a href="#">Horas trabajadas a la semana</a></li>
            <li><a href="#">Horas faltantes</a></li> 
            <li><a href="#">Horas trabajadas por el mes</a></li> 
            <li><a href="#">Salario a pagar mensualmente</a></li> 
           </ul>
					</li> 

					<li><a href="#">Soporte</a>
					 <ul> 
					 	  <li><a href="#" onClick="crearUsuario()">Crear Usuario</a></li>
					    <li><a href="#" onclick="cambiarClaveUsuario()">Cambiar clave de Usuario</a></li> 
					 </ul>
				 </li> 

				</ul>
       </nav>
			</div>
			</div>
			
      <form method="POST">
			    <div id="salir" style="display: none">
		        <h2>Salir</h2>
			</div>
        </form>
		</section>

		<section>

			<div class="asisProfes" id="asisProfes" style="display: none">
				<h2>Asistencia de Profesores</h2>
                
                <div class="panelBlanco" >
                  <div>
                    <table>
                    <td>
                    <input type='button' class='registrar' value='Asistencia Hoy' onClick='asistenciaHoyProfesores()'>
                    <input type='button' class='registrar' value='Sin Registro Hoy' onClick='SinRegistroHoyProfesores()'>
                    </td>
                    </table>
                  </div>

                  <div name='panelBlancoInterno' id='panelBlancoInterno'>
                  
                   <h3>tabla</h3>
                  
                  </div>


                </div>

               <input  type="button" name="AsisProfesAtras" value="Atras" class="Atras" onClick="AsisProfesAtras()" >
           
			</div>
             
      <div class="AsisMonitores" id="AsisMonitores" style="display: none">
				<h2>Asistencia de Monitores</h2>
           
           <div class="panelBlanco" >
                  <div>
                    <table>
                    <td>
                    <input type='button' class='registrar' value='Asistencia Hoy' onClick='asistenciaHoyMonitores()'>
                    <input type='button' class='registrar' value='Sin Registro Hoy' onClick='SinRegistroHoyMonitores()'>
                    </td>
                    </table>
                  </div>

                  <div name='panelBlancoInterno2' id='panelBlancoInterno2'  >
                  
                   <h3>tabla</h3>
                  
                  </div>
                </div>

               <input  type="button" name="AsisMonitoresAtras" value="Atras" class="Atras" onClick="AsisMonitoresAtras()" >

			</div>


       <div class="generarReporte" id="generarReporte" style="display: none">
				<h2>Generar Reporte</h2>

              <form  method='get' action="{{ URL::asset('proceso/registrarReporte') }}"> 

                 <div class="panelBlanco" >
                  
                 <div>
                    <label class="label">Seleccione el Usuario:</label>
                    <select id='selectReport' name='selectReport'></select>
                 </div>

                 <div> 
                   <label class='label'>Asunto:</label>
                   <input class='input' type='text' placeholder='asunto' name='asuntoReport' id='asuntoReport'>
                 </div>

                 <div>
                 <label class='label' >Descripcion:</label>
                 <textarea class='textarea' name='descripcionReport' id='descripcionReport'></textarea>
                 </div>

                 <div>
                 <label class='label' name='mensajeReport' id='mensajeReport' ></label>
                 </div>

                </div>

               <input  type="button" name="generarRepGuardar" value="Generar Reporte" class="registrar" onClick="generarReporteGuardar()" >
               </form>
               <input  type="button" name="generarReporteAtras" value="Atras" class="Atras" onClick="generarReporteAtras()" >
         
       </div>

        <div name="cambiarClave" id="cambiarClave" class="transparente" style="display: none" >
          
          <h2>Cambiar de Clave</h2>
            

            <div align='center' class="panelBlanco2">  

                <div>
                  <label class="label">Contraseña Antigua:</label>
                  <input type="password" class="password" placeholder="Contraseña Vieja"  id="PasswordOldq" required>
                </div>

               <div>
                <label class="label">Nueva contraseña:</label>
                <input type="password" class="password" placeholder="Contraseña Nueva"  id="PasswordNewq" required>
               </div>

              <div>
               <label class="label">Confirme Nueva contraseña:</label>
               <input type="password" class="password" placeholder="Confirmar Contraseñan Nueva" id="PasswordNewCq" required>
              </div> 

              <div>
                <label class="label" name='mensajeClave' id='mensajeClave' >configuracion de clave</label>
              </div>     

            </div>
            
                <input type="button" name="cambiarContraseña" value="Renovar Clave" class="registrar" onClick="guardarCambioClave()">
             
                <input  type="button" name="cambioClaveAtras" value="Cancelar" class="Atras" onClick="cambioClaveAtras()" >

       </div>


			 <div name="subirProgramacion" id="subirProgramacion" class="transparente" style="display: none">
                
                <h2 id="h2_formularioSubirArchivo">Subir Progamacion Academica</h2>

                <form enctype="multipart/form-data" method="POST" id="formularioSubirArchivo" action="/subirDatos">
                  {{ csrf_field() }}
                 <div class="panelBlanco">

                	<div aling='center'>
                		<label  class="label">Archivo a importar:</label>
                	    <input type="file" accept=".xls,.xlsx" class="input" value="file" name="archivoExcelProgramacionAcademica" required>
                	</div>

                	<div>
                         <label  class="label">Fecha Inicial:</label>
                         <input type="date" name="fechaInicial" value="fecha Inicial:" class="input" id="fechaInicial" required>
                	</div>

					<div>
						 <label  class="label">Fecha Final:</label>
                         <input type="date" name="fechaFinal" value="fecha Final:" class="input" id="fechaFinal" required>
					</div>

                	               
                 </div>

                 <button class="registrar" onclick="guardar()"> Guardar </button>
                
                </form> 

               <input type="button" name="subirProgramacionAtras" id="subirProgramacionAtras" value="Atras" class="Atras" onClick="subirProgramacionAtras()">

			 </div>
 
       <div name="crearProgramacion" id="crearProgramacion" class="transparente" style="display: none">

               <h2>Crear un Horario</h2>
                
               {{csrf_field()}}
                <div class="panelBlanco">
                 
                   <div >
                      {!! Form::label('null', 'Id asignatura y dependencia') !!}

                       <select  id='SelectId_asignaturaDepeCH'></select>
                   
                   </div>

                    <div class="">
                      {!! Form::label('null', 'Dia') !!}

                       <select id='dia'>
                        <option disable>Seleccione</option>
                        <option value='LUNES'>LUNES</option>
                        <option value='MARTES'>MARTES</option>
                        <option value='MIERCOLES'>MIERCOLES</option>
                        <option value='JUEVES'>JUEVES</option>
                        <option value='VIERNES'>VIERNES</option>
                        <option value='SABADO'>SABADO</option>
                        <option value='DOMINGO'>DOMINGO</option>
                         
                       </select>
                     
                   </div>

                    <div class="">
                      {!! Form::label('null', 'Hora Inicial') !!}
                      <input type="time"  class="input" id="horaInicial" required>
                   </div>

                   <div class="">
                      {!! Form::label('null', 'Cantida de Horas') !!}

                      <input type="number"  class="input" id="cantidadHoras" required>
                   </div>

                   <div class="">
                      {!! Form::label('null', 'Id del Usuario') !!}

                      <select id='SelectId_usuarioCH'></select>
                       
                   </div>
                      <label class="label" id='mensajeCH' name='mensajeCH'>Usted va a crear un Horario</label>
                   
                  </div>

                 <button class="registrar" onClick="crearHorario()">Crear Horario</button>
                 

                 <input  type="button" id="crearProgramacionAtras" name="crearProgramacionAtras" value="Atras" class="Atras" onClick="crearProgramacionAtras()">
       </div>


			 <div name='crearUsuario' id="crearUsuario"  class="transparente" style="display: none">
  				<h2> Crear Usuario</h2>
              
                
                 <div class="panelBlanco" >
                 	
                   <div class="">
                      {!! Form::label('null', 'Numero de cedula') !!}
                      
                       <input id="numero_cedula" type='text' placeholder='Cedula' class='input' required>
                   </div>
                  
                   <div class="">
                      {!! Form::label('null', 'Nombre') !!}

                      <input id="nombre" type='text' placeholder='nombre' class='input' required>
                   </div>

				           <div class="">
                      {!! Form::label('null', 'Contraseña') !!}

                      <input id="password" type='password' placeholder='Contraseña' class='password' required>
                   </div>

                   <div class="">
                      {!! Form::label('null', 'E-Mail') !!}

                      <input id="correo" type='email' placeholder='correo' class='input' required>
                   </div>     

                 
                  <div class="">
                      {!! Form::label('null', 'Id del perfil') !!}

                      <div > 
                       <select id="id_perfil" >
                       	 <option disable>Seleccione</option>
                         <option value='0'>Administrador</option>
                         <option value='1'>Coordinador</option>
                         <option value='2'>Profesor</option>
                         <option value='3'>Monitor</option>
                       </select>
                     </div>
 				          </div>

    	           <div class="">
                      {!! Form::label('null', 'Estado') !!}

                       <select id="estado" >
                         <option disable>Seleccione</option>
                         <option value='0'>Desativado</option>
                         <option value='1'>Activado</option>
                         
                       </select>

                 </div>     
                    <label class="label" id='mensaje1' name='mensaje1'>Usted va a crear un usuario</label>

              
              </div>
                 <button class="registrar" onClick="registrarUsuario()">registrar usuario  </button>

                 <input  type="button" id="crearUsuarioAtras" name="crearUsuarioAtras" value="Atras" class="Atras" onClick="crearUsuarioAtras()">

        </div>


        <div name="cambiarClaveUsuario" id="cambiarClaveUsuario" class="transparente" style="display: none" >

           <h2>Cambiar de Clave a Usuarios</h2>
            

            <div align='center' class="panelBlanco2">  

                <div>
                     <label class="label">Usuario:</label>

                     <select id='selectClaveUsuarios' name='selectClaveUsuarios'></select>

                 </div>

             <div>
               <label class="label">Nueva contraseña:</label>
               <input type="password" class="password" placeholder="Contraseña Nueva"  id="passwordNewCUsus" required>
             </div>

             <div>
               <label class="label">Confirme Nueva contraseña:</label>
               <input type="password" class="password" placeholder="Confirmar Contraseñan Nueva" id="passwordNewCCUsus" required>
             </div>     

             <div>
                <label class="label" id='mensajeCUsus'></label>
             </div> 

           </div>
                    
              <input type="button" name="cambiarClaveUsuarioGuardar" value="Renovar Clave" class="registrar" onClick="cambiarClaveUsuarioGuardar()">
           

              <input  type="button" name="cambiarClaveUsarioAtras" value="Cancelar" class="Atras" onClick="cambiarClaveUsuarioAtras()" >

        </div>        


		</section>

	</body>
</html>