<!DOCTYPE html>
<html>
	<head>
  		<title>Universidad Del Valle Sede Norte Del Cauca</title>
		<link rel="icon" type="image/png" href="Imagenes/Favicon.ico" />
	   
         <link rel="stylesheet" href=" {{ URL::to('CSS/Principal.css') }} "/>
         <link rel="stylesheet" href=" {{ URL::to('CSS/VistaProfesor.css') }} "/>
         <LINK REL=StyleSheet HREF="CSS/VistaProfesor.css" TYPE="text/css" MEDIA=screen>

    	  <script type="text/javascript" src="JS/Jquery.js"></script>
		  <script type="text/javascript" src="JS/Principal.js"></script>
		   <script type="text/javascript" src="JS/Profesor.js"></script>
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
		 
			<div id="inicio" style="display: none">
			    <h2>Inicio</h2>
			    <p>Hola, Bienvenido </p>
			    <h1>NOMBRE: {{session()->get('nombre','no hay sesion')}}</h1><br>
			    <h1>ID: {{session()->get('id','no hay sesion')}}</h1>

			</div>	

			<div id="control" style="display: none">
			  <div id="menu">
			   <nav>
  	              <ul class="parent-menu">
                    <li><a href="#" onclick="registroDeAsistencia()">Registrar Asistencia</a></li> 

                    <li><a href="#" onclick="generarReporte()">Generar Reporte</a></li> 

                    <li><a href="#" onclick="generarInforme()">Generar Informe</a></li> 

				    <li><a href="#" onclick="misAsignaturas()">Mis Asignaturas</a></li> 
                 </ul>
               </nav>
		      </div>		
		    </div>

			<div id="admin" style="display: none">
			   <h2>CAMBIO DE CLAVE</h2>
			    <p>Esta opcion no esta funcional Por favor revisar</p>
			 </div>

			<div id="salir" style="display: none">
			    <h2>Salir</h2>
			    <p>Esta opcion no esta funcional Por favor revisar</p>
			</div>

		</section>
		
		<section class="opcionesMuestra">
      
      
            <div id="registrarHorario" class="registrarHorario" style="display: none" >
            	<h2 >Registro de Horario </h2>
            		
				 <div align='center'>  
			   
			   		<table border='1' id = 'contenedor' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 

					<h5> <label id ="respuesta" > </label> </h5>
				
				
				
				 </div>
             

             <input  type="button" name="AsistenciaAtras" value="Atras" class="pAsisAtras" onClick="pAsisAtras()" >
             <input  type="submit" name="AsistenciaGuardar" value="Guardar" class="pAsisGuardar">
             
            
			</div>

			<div id="generarReporte" class="generarReporte" style="display: none">
				<h2>Generar Reporte </h2>
			     	<div align='center' class="panelBlanco">

                     <h3>aqui puede ir un combobox con el codigo y el nombre de las asignturaa, el campo para el texto de la dificulta</h3>

			    	</div>
               
               <input  type="button" name="ReporteAtras" value="Atras" class="pReporAtras" onClick="pReporAtras()" >

			</div>

           
            <div id="generarInforme" class="generarInforme" style="display: none" >
            	<h2 >Crear Informe </h2>
            		
				 <div align='center'>  
			   
				
				 </div>
             

             <input  type="button" name="InformeAtras" value="Atras" class="pInforAtras" onClick="pInforAtras()" >
             <input  type="submit" name="CrearInforme" value="Crear Informe" class="pCrearInfor">
             
            
			</div>

			 <div id="CreandoInforme" class="CreandoInforme" style="display: none" >
            	<h2 >Crear Informe </h2>
            		
				 <div align='center'>  
			   
				
				 </div>
             

             <input  type="button" name="CreandoInformeAtras" value="Atras" class="pInforAtras" onClick="pCreandoInforAtras()" >
             <input  type="submit" name="GuardarInforme" value="GuardarInforme" class="pGuardarInfor">
             
            
			</div>

			 <div id="MisAsignaturas" class="MisAsignaturas" style="display: none" >
            	<h2 >Mis Asignaturas </h2>
            		
				 <div align='center'>  
			        <table border='1' id = 'contenedorMisAsignaturas' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 

					<h5> <label id ="respuesta" > </label> </h5>
				
				 </div>
             

             <input  type="button" name="MisAsignaturasAtras" value="Atras" class="pMisAsigAtras" onClick="pMisAsigAtras()" >
             
            
			</div>
		</section>

	</body>
</html>