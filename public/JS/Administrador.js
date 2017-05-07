function AsistenciaProfesores(){

    $('#asisProfes').show();

	$('#menu').hide();
}

function AsistenciaMonitores(){

    $('#AsisMonitores').show();

	$('#menu').hide();
}

function crearUsuario(){

$('#menu1').hide();

$('#crearUsuario').show();

}

function crearUsuarioAtras(){

 $('#crearUsuario').hide();

	$('#menu1').show();
}
 
function registrarUsuario(){
	alert('aqui registra el usuario y se limpia el Formulario'); 

}

 
function subirProgramacion(){

	$('#subirProgramacion').show();
	$('#menu1').hide();
}

function subirProgramacionAtras(){

	$('#subirProgramacion').hide();
	$('#menu1').show();
}


function generarReporte(){
load('cargarAsignaturas');

 $('#generarReporte').show();

	$('#menu').hide();
}


function generarReporteAtras(){


 $('#generarReporte').hide();

	$('#menu').show();
}

function generarReporteGuardar(){

	alert('Generar el reporte a una asignatura de cierto profesor');

}



function AsisMonitoresAtras(){

     $('#menu').show();

	$('#AsisMonitores').hide();
}

function AsisProfesAtras(){

	$('#menu').show();

	$('#asisProfes').hide();
}


function GuardarProgramacion(){
	alert('tomar los datos y subir el archivo, para llenar horarios');
}

function guardarCambioClave(){

  alert('hacer el insert y mostrar que se cambio correctamente la contraseña');

  document.getElementById("#PasswordOld").reset();
  document.getElementById("#PasswordNew").reset();
  document.getElementById("#PasswordNewC").reset();

}

function cambioClave(){
	$("#menu").hide();
  $("#cambiarClave").show();
}

function cambioClaveAtras(){

  $("#menu").show();
  $("#cambiarClave").hide();
}

function crearProgramacion(){

  $("#menu1").hide();
  $("#crearProgramacion").show();

}

function crearHorario(){

	alert('Guardar datos y limpiar');
}

function crearProgramacionAtras(){

  $("#menu1").show();
  $("#crearProgramacion").hide();
}

function cambiarClaveUsuario(){

  $("#menu1").hide();

$("#cambiarClaveUsuario").show();
}

function cambiarClaveUsuarioAtras(){

 $("#menu1").show();

$("#cambiarClaveUsuario").hide();
}

function cambiarClaveUsuarioGuardar(){

	alert('guardar datos y limpiar');
}
