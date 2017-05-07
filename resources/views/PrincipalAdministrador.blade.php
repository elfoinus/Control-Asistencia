<!DOCTYPE html>
<html>
	<head>
  		<title>Universidad Del Valle Sede Norte Del Cauca</title>
		<link rel="icon" type="image/png" href="{{ URL::to('Imagenes/Favicon.ico') }} " />
	    <link rel="stylesheet" href=" {{ URL::to('css/Principal.css') }} ">
	    <link rel="stylesheet" href=" {{ URL::to('css/VistaAdministrador.css') }} ">

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
               </nav>
		      </div>		
		    </div>

			<div id="admin" style="display: none">
				<div id="menu1">
			      	<nav>
					  <ul class="parent-menu">
					    <li><a href="#">Configuracion</a> 
					    	<ul> 
					    		<li><a href="#" onClick="subirProgramacion()">Subir Programacion</a></li> 
					    		<li><a href="#" onClick="crearProgramacion()">Crear Programacion</a></li> 
					    	
					    	</ul> 
					    </li> 

					<li><a href="#">Informes</a>
					 <ul> 
					 	<li><a href="#">item</a></li>
					    <li><a href="#">item</a></li> 
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
			    <p>Esta opcion no esta funcional Por favor revisar</p>
			</div>
			
        </form>
		</section>

		<section>

			<div class="asisProfes" id="asisProfes" style="display: none">
				<h2>Asistencia de Profesores</h2>
                
                <div class="panelBlanco" >
                  <h3>holsa</h3>
                </div>

               <input  type="button" name="AsisProfesAtras" value="Atras" class="Atras" onClick="AsisProfesAtras()" >

           
			</div>
             
     <div class="AsisMonitores" id="AsisMonitores" style="display: none">
				<h2>Asistencia de Monitores</h2>
                
                <div class="panelBlanco" >
                  <h3>holsa</h3>
                </div>

               <input  type="button" name="AsisMonitoresAtras" value="Atras" class="Atras" onClick="AsisMonitoresAtras()" >

           
			 </div>


      <div class="generarReporte" id="generarReporte" style="display: none">
				<h2>Generar Reporte</h2>
                <form>
                <div class="panelBlanco" > 
                 <div>
                 <label class="label">Seleccione la asignaura:</label>
                 <!select id='asigna'name='asigna'> 
                 <!/select>



                 </div>
                </div>
                </form>

               <input  type="button" name="generarReporteAtras" value="Atras" class="Atras" onClick="generarReporteAtras()" >

               <input  type="submit" name="generarRepGuardar" value="Generar Reporte" class="registrar" onClick="generarReporteGuardar()" >
           
			 </div>

			 
			 <div name="cambiarClave" id="cambiarClave" class="transparente" style="display: none" >

        <h2>Cambiar de Clave</h2>
		    
				 <div align='center' class="panelBlanco2">  

		            <div>
                     <label class="label">Contraseña Antigua:</label>
  				     <input type="password" class="password" placeholder="Contraseña Vieja" name="passwordOld" id="PasswordOld" required>
  				    </div>

					<div>
  				     <label class="label">Nueva contraseña:</label>
  				     <input type="password" class="password" placeholder="Contraseña Nueva" name="passwordNew" id="PasswordNew" required>
                    </div>

                    <div>
				     <label class="label">Confirme Nueva contraseña:</label>
  				     <input type="password" class="password" placeholder="Confirmar Contraseñan Nueva" name="passwordNewC" id="PasswordNewC" required>
			        </div>		  

			    </div>
             
             		<input  type="button" name="cambioClaveAtras" value="Cancelar" class="Atras" onClick="cambioClaveAtras()" >
                    <input type="submit" name="cambiarContraseña" value="Renovar Clave" class="registrar" onClick="guardarCambioClave()">

               
               </div>


			 <div name="subirProgramacion" id="subirProgramacion" class="transparente" style="display: none">
                
                <h2>Subir Progamacion Academica</h2>

                <form>
                 <div class="panelBlanco2">

                	<div aling='center'>
                		<label  class="label">Archivo a importar:</label>
                	    <input type="file" class="input" value="file" name="file" required>
                	</div>

                	<div>
                         <label  class="label">Fecha Inicial:</label>
                         <input type="date" name="fechaInicial" value="fecha Inicial:" class="input" id="fechaInicial" required>
                	</div>

					<div>
						 <label  class="label">Fecha Final:</label>
                         <input type="date" name="fechaFinal" value="fecha Final:" class="input" id="fechaFinal" required>
					</div>

                	<label disable  class="label"> mensaje@@@@$##$##</label>

                	               
                 </div>

                 <input type="submit" name="GuardarProgramacion" value="Guardar Programacion" class="registrar" id="GuardarProgramacion" onClick="GuardarProgramacion()">
              
                </form> 

               <input type="button" name="subirProgramacionAtras" id="subirProgramacionAtras" value="Atras" class="Atras" onClick="subirProgramacionAtras()">

			 </div>

			 <div name="crearProgramacion" id="crearProgramacion" class="transparente" style="display: none">
               <h2>Crear un Horario</h2>
               	<form>
                <div class="panelBlanco">
                 
                   <div >
                      {!! Form::label('id_Horario', 'Id Horario') !!}
                      {!! Form::text('id_Horario',null, ['class' => 'input', 'required' => 'required' ]) !!}
                   </div>

                   <div >
                      {!! Form::label('id_asignaturaDepen', 'Id asignatura y dependencia') !!}

                       <select name='id_asignaturaDepe' id='id_asignaturaDepe'>
                          
                         
                       </select>
                     
                   </div>

                    <div class="">
                      {!! Form::label('dia', 'Dia') !!}

                       <select name='dia' id='dia'>
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
                      {!! Form::label('horaInicial', 'Hora Inicial') !!}
                      <input type="date" name="horaInicial" value="hora Inicial:" class="input" id="horaInicial" required>
                   </div>


                   <div class="">
                      {!! Form::label('cantidadHoras', 'Cantida de Horas') !!}
                      {!! Form::text('cantidadHoras',null, ['class' => 'input', 'required' => 'required' ]) !!}
                   </div>

                   <div class="">
                      {!! Form::label('id_usuario', 'Id del Usuario') !!}

                      <select name='id_usuario' id='id_usuario'>
                       	<option disable>Seleccione</option>
                         
                       </select>
                   </div>

                  </div>

                 <input  type="submit" name="crearHorario" value="Crear Horario" class="registrar" onClick="crearHorario()">

              	</form>

                 <input  type="button" id="crearProgramacionAtras" name="crearProgramacionAtras" value="Atras" class="Atras" onClick="crearProgramacionAtras()">

             </div>

			 <div name='crearUsuario' id="crearUsuario"  class="transparente" style="display: none">
  				<h2> Crear Usuario</h2>
                
                 <form method='POST'>

                 <div class="panelBlanco" >
                 	
                   <div class="">
                      {!! Form::label('Numero_cedula', 'Numero de cedula') !!}
                      {!! Form::text('Numero_cedula', null, ['placeholder'=>"Cedula",'class' => 'input', 'required' => 'required' ]) !!}
                   </div>
                  
                   <div class="">
                      {!! Form::label('nombre', 'Nombre') !!}
                      {!! Form::text('nombre', null, ['class' => 'input' , 'required' => 'required']) !!}
                   </div>


				           <div class="">
                      {!! Form::label('password', 'Contraseña') !!}

                      <input type='password' placeholder='Contraseña' class='password' required>
                   </div>

                   <div class="">
                      {!! Form::label('correo', 'E-Mail') !!}
                      {!! Form::email('correo', null, ['placeholder'=>"Ejemplo@ejemplo.com",'class' => 'input' , 'required' => 'required']) !!}
                   </div>     

                 
                  <div class="">
                      {!! Form::label('id_perfil', 'Id del perfil') !!}

                      <div > 
                       <select >
                       	<option disable>Seleccione</option>
                         <option value='0'>Administrador</option>
                         <option value='1'>Coordinador</option>
                         <option value='2'>Profesor</option>
                         <option value='3'>Monitor</option>
                       </select>
                     </div>
 				 </div>

   


    	           <div class="">
                      {!! Form::label('estado', 'Estado') !!}
                      {!! Form::text('estado', null, ['class' => 'input' , 'required' => 'required']) !!}
                   </div>     


                </div>

                 <input  type="submit" name="registrarUsuario" value="Registrar" class="registrar" onClick="registrarUsuario()"  >
                
              	</form>

                 <input  type="button" id="crearUsuarioAtras" name="crearUsuarioAtras" value="Atras" class="Atras" onClick="crearUsuarioAtras()">

			
			
		    </div>


        <div name="cambiarClaveUsuario" id="cambiarClaveUsuario" class="transparente" style="display: none" >

           <h2>Cambiar de Clave a Usuarios</h2>
        
            <div align='center' class="panelBlanco2">  

                <div>
                     <label class="label">Usuario:</label>

                      <select>
                        <option disable > Seleccione</option>

                      </select>
                 </div>

             <div>
               <label class="label">Nueva contraseña:</label>
               <input type="password" class="password" placeholder="Contraseña Nueva" name="passwordNew" id="PasswordNew" required>
             </div>

             <div>
               <label class="label">Confirme Nueva contraseña:</label>
               <input type="password" class="password" placeholder="Confirmar Contraseñan Nueva" name="passwordNewC" id="PasswordNewC" required>
            </div>      

          </div>
             
              <input  type="button" name="cambiarClaveUsarioAtras" value="Cancelar" class="Atras" onClick="cambiarClaveUsuarioAtras()" >
                    
              <input type="submit" name="cambiarClaveUsuarioGuardar" value="Renovar Clave" class="registrar" onClick="cambiarClaveUsuarioGuardar()">

        </div>




		</section>

	</body>
</html>