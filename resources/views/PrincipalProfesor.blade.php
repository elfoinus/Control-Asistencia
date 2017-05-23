<!DOCTYPE html>
<html>
	<head>
  		<title>Universidad Del Valle Sede Norte Del Cauca</title>
		<link rel="icon" type="image/png" href="Imagenes/Favicon.ico" />
	   
         <link rel="stylesheet" href=" {{ URL::to('CSS/Principal.css') }} "/>
         <link rel="stylesheet" href=" {{ URL::to('CSS/VistaProfesor.css') }} "/>

         <link rel="stylesheet" href=" {{ URL::to('CSS/nivo-slider.css') }} "/>
         <link rel="stylesheet" href=" {{ URL::to('CSS/Sliders.css') }} "/>


    	  <script type="text/javascript" src="JS/Jquery.js"></script>
		  <script type="text/javascript" src="JS/Principal.js"></script>
		   <script type="text/javascript" src="JS/Profesor.js"></script>

		    <script type="text/javascript" src="JS/jquery.nivo.Slider.js"></script>
		    <script type="text/javascript"> 
            $(window).on('load', function() {
               $('#slider').nivoSlider(); 
             }); 
        </script>
    	    <meta charset="UTF-8" >
	</head>

	<body>

		<header>
				<div class="wrapper">
					<div class="logo"><img src="Imagenes/Favicon.gif"><h1>Gestion Integral</h1></div>
					<nav>
						<a id = "eti1" href="#" onclick="mostrar(1)">Inicio</a>
						<a id = "eti2" href="#" onclick="mostrar(2)">Control</a>
						<a id = "eti3" href="#" onclick="mostrar(3)">Cambio de clave</a>
						<a id = "eti4" href="/" onclick="">Salir</a>
					</nav>
					</div>
				</div>

		</header>

        


		<section class="contenido wrapper">
		
		 <div id="control" style="display: none">
			  <div id="menu">
			   <nav>
  	              <ul class="parent-menu">
                    <li><a href="#" onclick="registroDeAsistencia()">Registrar Asistencia</a></li>

                    <li><a href="#" onclick="clasesPorRecuperar()">Clases por Recuperar</a></li> 

                    <li><a href="#" onclick="generarReporte()">Generar Reporte</a></li> 

                    <li><a href="#" onclick="registrarTemas()">Registrar temas</a></li> 

				    <li><a href="#" onclick="misAsignaturas()">Mis Asignaturas</a></li> 
                 </ul>
               </nav>
		      </div>		
		    </div>

		</section>

		<section>

			<div id="inicio" style="display: none">
			   <div name="bienvenida"class='transparenteIni' >

			    <h2>Hola, Bienvenido </h2>

			    <h1>{{session()->get('nombre','no hay sesion')}}</h1><br>

			   </div>

				<div name='slider' class='transparenteIni' style='height: 450px;'>
			      <div class="slider-wrap theme-default">

       				<div id="slider" class="nivoSlider">     
         			    <img src="{{ asset('Imagenes/imgSlider0.jpg') }}">
       	 		        <img src="{{ asset('Imagenes/imgSlider1.jpg') }}">
         			    <img src="{{ asset('Imagenes/imgSlider2.jpg') }}">
         			    <img src="{{ asset('Imagenes/imgSlider3.jpg') }}">
         			    <img src="{{ asset('Imagenes/imgSlider4.jpg') }}">
       			    </div> 

      			   </div>
      			  </div>

      			  <div name='notificaciones' id='notificaciones' class='transparenteIni'>


      			  </div>
      		</div>
      	</section>

		<section class="contenido wrapper">

		    <div id="admin" class="cambiarClave" style="display: none" >
            	<h2 >Cambio de Clave </h2>
            	
            	
				 <div align='center' class="panelBlanco2">  

		            <div>
                     <label class="label">Contraseña Antigua:</label>
  				     <input type="password" class="password" placeholder="Contraseña Vieja" id="PasswordOldp" required>
  				    </div>

					<div>
  				     <label class="label">Nueva contraseña:</label>
  				     <input type="password" class="password" placeholder="Contraseña Nueva" id="PasswordNewp" required>
                    </div>

                    <div>
				     <label class="label">Confirme Nueva contraseña:</label>
  				     <input type="password" class="password" placeholder="Confirmar Contraseñan Nueva" id="PasswordNewCp" required>
			        </div>

			        <label id='mensajeClave'></label>		  

			    </div>
             
             		<input  type="button" name="cambioClaveAtras" value="Cancelar" class="pAsisAtras" onClick="mostrar(1)" >
                    <input type="submit" name="cambiarContraseña" value="Renovar Clave" class="bcambioClave" onClick="cambiarClavep()">

             
            
			</div>
			

			<div id="salir" style="display: none">
			    <h2>Salir</h2>
			</div>

		</section>

		
		<section class="opcionesMuestra">
      
      
            <div id="registrarHorario" class="transparente" style="display: none" >
            	<h2 >Registro de Horario </h2>
            		<h6 id = 'semana'></h6>
				 <div align='center' class="panelBlanco">  
			        
			   		<table border='1' id='contenedor' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 

					<h5> <label id ="respuesta" > </label> </h5>
				
				 </div>
             

             <input  type="button" name="AsistenciaAtras" value="Atras" class="pAsisAtras" onClick="pAsisAtras()" >
             
            
			</div>

			  <div id="clasesPorRecuperar" class="transparente" style="display: none" >
            	<h2 >Clases Por Recuperar</h2>
            		
				 <div align='center' class="panelBlanco">  

			   		<table border='1' id='tablaRecuperar' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 
				
				 </div>

             <input  type="button" name="recuperarAtras" value="Atras" class="pAsisAtras" onClick="recuperarAtras()" >
             
             <input  type="button" name="recuperarUnaClase" value="Recuperar una Clase" class="pGuardar" onClick="recuperarClases()" >


            
			</div>

			<div id="generarReporte" class="generarReporte" style="display: none">
			   <h2>Generar Reporte </h2>

			   <form method='get' action="{{ URL::asset('proceso/registrarReporte') }}">
			    <div align='center' class="panelBlanco">

			     	<div>
			     	  <label class="label">Seleccione la Asignatura:</label>
			          <select  name="selectReporProfesor" id="selectReporProfesor" requerid> </select>
			     	 
			     	</div>

			     	   
                    <div > 
                    	<label class="label"> Tipo de reporte: </label> 
   						<select  id="selectTipoReporProfesor" requerid> 
   							<option disebled>Seleccionar</option>
   							<option value='dificulta'>Dificulta</option>
   							<option value='simple'>Simple</option>
   							<option value='provechoso'>Provechoso</option>

   						</select>
                    </div>
                     
                    <div>
                    	<label class="label">Numero de estudiantes:</label>

                    	<input  type="number"  id='nEstudiantes' class="input" requerid >
                        
                    </div>

                    <div>
                      <label class="label">Drescripcion: </label>
                      <textarea id="descripcionRP" class="textarea" required></textarea>
                	
			    	</div>
			    	<div>
						<label class="label" name='mensajeRP' id='mensajeRP'></label>
			    	</div>

			     </div>
			    	
               
               <input  type="button" name="GuardarReporte" value="Guardar Reporte" class="guardar" onclick="guardarReporte()">
			</form>

               <input  type="button" name="ReporteAtras" value="Atras" class="pReporAtras" onClick="pReporAtras()" >
            
			</div> 

           
            <div id="regisTemas1" class="regisTemas" style="display: none" >
            	<h2>Registrar temas</h2>
            	<form method='get' action="{{ URL::asset('proceso/crearTema') }}">
				 <div align='center' class="panelBlanco2" id="panelBlanco1">
                    
                   <div>
                   		<label class="label">Seleccione la Asignatura:</label>

			     		<select id="selectAsigTemas" name="selectAsigTemas"> </select>
			     	</div>

			     		                 
                 </div>

               <input  type="button" name="TemasAtras" value="Atras" class="pTemasAtras" onClick="pTemasAtras()" >
               <input  type="button" name="Temas" value="Registrar Temas" class="Temas"  onClick="pRegistrarTemas()">
             
            
			</div>

             <div id="regisTemas2" class="regisTemas" style="display: none" >
             	<h2 >Registrar temas</h2>

			  <div  class="panelBlanco2" align='center' >
                
               
               	<div>
			      	<label class="label">Nombre del tema:</label>
			      	 <input type="text" id="NombreTema" class="input"  required>
			      </div>

			    <div>
			      	<label class="label">Drescripcion: </label>
			      	<textarea id="DescripcionTema" class="textarea" value="Descripcion del tema " required></textarea>
                 </div>

                <div>
                	<label class="label" id='mensajeTema' name='mensajeTema'></label>
                </div>

                </div>

             	 <input  type="button" name="GuardarInforme" value="Agregar Tema"  class="Temas" onClick="pRegistrandoTemasGuardar()">
             
             	 <input  type="button" name="RegistrandoTemasAtras" value="Atras" class="pTemasAtras" onClick="pRegistrandoTemasAtras()" >

            
			</div>

			 <div id="MisAsignaturas" class="MisAsignaturas" style="display: none" >
            	<h2 >Mis Asignaturas </h2>
            		
				 <div align='center' class="panelBlanco">  
			        <table border='1' id = 'contenedorMisAsignaturas' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 

					
				
				 </div>
             

             <input  type="button" name="MisAsignaturasAtras" value="Atras" class="pMisAsigAtras" onClick="pMisAsigAtras()" >
             
            
			</div>
		</sectio

	}n>

	</body>
</html>