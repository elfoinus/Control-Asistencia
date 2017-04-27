<!DOCTYPE html>
<html>
	<head>
  		<title>Universidad Del Valle Sede Norte Del Cauca</title>
		<link rel="icon" type="image/png" href="Imagenes/Favicon.ico" />
	   <link rel="stylesheet" href=" {{ URL::to('CSS/Principal.css') }} "/>
    	  <script type="text/javascript" src="JS/Jquery.js"></script>
		  <script type="text/javascript" src="JS/Principal.js"></script>
    	  <meta charset="UTF-8">

	</head>

	<body>

		<header>
				<div class="wrapper">
					<div class="logo"><img src="Imagenes/Favicon.gif"><h1>Gestion Integral</h1></div>
					<nav>
						<a id = "eti1" href="#" onclick="mostrar(1)">Inicio</a>
						<a id = "eti2" href="#" onclick="mostrar(2)">Control</a>
						<a id = "eti3" href="#" onclick="mostrar(3)">Seguimientos</a>
						<a id = "eti4" href="/" onclick="">Salir</a>
					</nav>
					</div>
				</div>

		</header>

		<section class="contenido wrapper">
		 
			<div id="inicio" style="display: none">
			    <h2>Inicio</h2>

			    <p>Hola, Bienvenido</p>
			    <h1>{{$mensaje}}</h1>
			</div>	

			<div id="control" style="display: none">
				<div id="menu">
			   <nav>
  	                <ul class="parent-menu">
                    <li><a href="#">Manejo de solicitudes</a> 
    	              <ul> 
			    		<li><a href="#">Recuperacion de clases</a></li> 
			    		<li><a href="#">Sugerencias</a></li> 
			    		<li><a href="#">Quejas</a></li> 
			    		<li><a href="#">Reglamos</a></li> 

    				</ul> 
                  </li> 

                  <li><a href="#">Generar Reporte</a>
					 <ul> 
					  <li><a href="#">item</a></li>
					  <li><a href="#">item</a></li> 
					  
					</ul>
				</li> 
				<li><a href="#">Cambio de clave</a>
					 <ul> <li><a href="#">item</a></li>
					  <li><a href="#">item</a></li> 
					  
					</ul>
					</li>  
               </ul>
           </nav>
		 </div>		
		</div>

			<div id="admin" style="display: none">
				<div id="menu">
			      	<nav>
					  <ul class="parent-menu">
					    <li><a href="#">Horarios</a> 
					    	<ul> 
					    		<li><a href="#">item</a></li> 
					    		<li><a href="#">item</a></li> 
					    	
					    		<li><a href="#">item</a></li> 
					    	</ul> 
					    </li> 



					<li><a href="#">Informes</a>
					 <ul> <li><a href="#">item</a></li>
					  <li><a href="#">item</a></li> 
					  <li><a href="#">item</a></li> 
					 
					</ul>
					</li>  
					<li><a href="#">Profesores</a>
					 <ul> <li><a href="#">item</a></li>
					  <li><a href="#">item</a></li> 
					  <li><a href="#">item</a></li> 
					 
					</ul>
					</li>  
				</ul>
              </nav>
			 </div>
			 </div>

			<div id="salir" style="display: none">
			    <h2>Salir</h2>
			    <p>Esta opcion no esta funcional Por favor revisar</p>
			</div>

		</section>

	</body>
</html>