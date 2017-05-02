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

                    <li><a href="#" onclick="registrarTemas()">Registrar temas</a></li> 

				    <li><a href="#" onclick="misAsignaturas()">Mis Asignaturas</a></li> 
                 </ul>
               </nav>
		      </div>		
		    </div>

			
		    <div id="admin" class="cambiarClave" style="display: none" >
            	<h2 >Cambio de Clave </h2>
            	
            	<form method='POST'>
				 <div align='center' class="panelBlanco2">  

                     <label class="label">Contraseña Antigua:</label>
  				     <input type="password" class="password" placeholder="Contraseña Vieja" name="passwordOld" id="PasswordOld" required>
  				     
  				     <label class="label">Nueva contraseña:</label>
  				     <input type="password" class="password" placeholder="Contraseña Nueva" name="passwordNew" id="PasswordNew" required>

				     <label class="label">Confirme Nueva contraseña:</label>
  				     <input type="password" class="password" placeholder="Confirmar Contraseñan Nueva" name="passwordNewC" id="PasswordNewC" required>
			         
				  </div>
             
             		<input  type="button" name="cambioClaveAtras" value="Cancelar" class="pAsisAtras" onClick="mostrar(1)" >
                    <input type="submit" name="cambiarContraseña" value="Renovar Clave" class="bcambioClave">

                </form>
            
			</div>
			

			<div id="salir" style="display: none">
			    <h2>Salir</h2>
			    <p>Esta opcion no esta funcional Por favor revisar</p>
			</div>

		</section>
		
		<section class="opcionesMuestra">
      
      
            <div id="registrarHorario" class="registrarHorario" style="display: none" >
            	<h2 >Registro de Horario </h2>
            		
				 <div align='center' class="panelBlanco">  
			   
			   		<table border='1' id = 'contenedor' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 

					<h5> <label id ="respuesta" > </label> </h5>
				
				
				
				 </div>
             

             <input  type="button" name="AsistenciaAtras" value="Atras" class="pAsisAtras" onClick="pAsisAtras()" >
             
            
			</div>

			<div id="generarReporte" class="generarReporte" style="display: none">
			   <h2>Generar Reporte </h2>
			    <div align='center' class="panelBlanco">

			     	<ul> 
			     		 <li>
			     		 	<label class="label">Seleccione la Asignatura:</label>
			         	    <select  class= "selectRepor" id="selectRepor" requerid>
                             <option disable>Seleccionar</option>
			     	        </select>
			     	     </li>
			     	</ul>
                     
                      	
                          <label> Dificulta  {{ Form::radio('tipoReporte','Dificulta') }}</label>   
                          <label> Reporte simple  {{ Form::radio('tipoReporte','Reporte Simple') }}</label>   
                          <label> Porovecho   {{ Form::radio('tipoReporte','Provechoso') }}</label>   
                      

                      <div>
                       <ul>
			    		  <li>
			    		  	<label class="label">Drescripcion: </label><textarea id="DescripcionReporte" class="textarea" value="Descripcion del Reporte" required></textarea>
                		  </li>
                		</ul>
			    	  </div>
			     </div>
			    	
               
               <input  type="button" name="ReporteAtras" value="Atras" class="pReporAtras" onClick="pReporAtras()" >
               <input  type="submit" name="GuardarReporte" value="Guardar Reporte" class="GuardarReporte">
            
			</div> 

           
            <div id="regisTemas1" class="regisTemas" style="display: none" >
            	<h2 >Registrar temas</h2>
            		
				 <div align='center' class="panelBlanco2" id="panelBlanco1">
                    
                   <table class="table">
			     	 <tr> 
			     		<td> <label class="label">Seleccione la Asignatura:</label></td>
			     		<td><select class= "selectRepor" id="selectTemas">
                            <option disable>Seleccionar</option>
			     		  </select>
			     		</td>
			     	  </tr>
                    </table>
                 
                 </div>

               <input  type="button" name="TemasAtras" value="Atras" class="pTemasAtras" onClick="pTemasAtras()" >
               <input  type="button" name="Temas" value="Registrar Temas" class="Temas"  onClick="pRegistrarTemas()">
             
            
			</div>

             <div id="regisTemas2" class="regisTemas" style="display: none" >
             	<h2 >Registrar temas</h2>

			  <div  class="panelBlanco2" align='center' >
                
               
               	<ul>
			      <li>
			      	<label class="label">Nombre del tema:</label> <input type="text" nema=id="NombreTema" class="input" id="NombreTema" required>
			      </li>
			    </ul>

			    <ul>
			      <li>
			      	<label class="label">Drescripcion: </label><textarea id="DescripcionTema" class="textarea" value="Descripcion del tema " required></textarea>
                  </li>
                </ul>
               
			   
              </div>

             	 <input  type="button" name="RegistrandoTemasAtras" value="Atras" class="pTemasAtras" onClick="pRegistrandoTemasAtras()" >
             	 <input  type="submit" name="GuardarInforme" value="Agregar Tema"  class="Temas" onClick="pRegistrandoTemasGuardar()">
             
            
			</div>

			 <div id="MisAsignaturas" class="MisAsignaturas" style="display: none" >
            	<h2 >Mis Asignaturas </h2>
            		
				 <div align='center' class="panelBlanco">  
			        <table border='1' id = 'contenedorMisAsignaturas' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
					   
					</table> 

					
				
				 </div>
             

             <input  type="button" name="MisAsignaturasAtras" value="Atras" class="pMisAsigAtras" onClick="pMisAsigAtras()" >
             
            
			</div>
		</section>

	</body>
</html>