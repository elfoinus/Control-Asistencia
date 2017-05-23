function registrarUsuario(){

     var  gnumero_cedula= document.getElementById("numero_cedula").value;
     var  gpassword= document.getElementById("password").value;
     var  gnombre= document.getElementById("nombre").value;
     var  gcorreo= document.getElementById("correo").value;
     var  gid_perfil= document.getElementById("id_perfil").value ;
     var  gestado= document.getElementById("estado").value;

 $.ajax({

   data: {
      numero_cedula: gnumero_cedula,//document.getElementById("numero_cedula").value,
      password: gpassword,//document.getElementById("password").value,
      nombre: gnombre,///document.getElementById("nombre").value,
      correo: gcorreo,///document.getElementById("correo").value,
      estado: gestado,
      id_perfil: gid_perfil///document.getElementById("id_perfil").value               
    },
    
    url: 'proceso/registrarUsuario',
    
    type: 'get', 
                
    beforeSend: function () {
        $("#mensaje1").html("Registrando, espere por favor...");
      },
      
    success:  function (response) {

        $("#mensaje1").html(response);

    }
    
  });

}


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

 
function subirProgramacion(){

  $('#subirProgramacion').show();
  $('#menu1').hide();
}

function subirProgramacionAtras(){

  $('#subirProgramacion').hide();
  $('#menu1').show();
}


function generarReporte(){

$('#selectReport').load('listarUsuarios');
 $('#generarReporte').show();

  $('#menu').hide();
}


function generarReporteAtras(){
        
 $('#generarReporte').hide();

  $('#menu').show();
}


function generarReporteGuardar(){


  $.ajax({

   data: {
      id_usuario: document.getElementById("selectReport").value,
      asunto: document.getElementById("asuntoReport").value,
      descripcion: document.getElementById("descripcionReport").value
    },
    
    url: 'proceso/generarReporte',
    
    type: 'get', 
                
    beforeSend: function () {
        $("#mensajeReport").html("Generando Reporte, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeReport").html(response);      
    }
    
  });

}

function AsisMonitoresAtras(){

     $('#menu').show();

  $('#AsisMonitores').hide();
}

function AsisProfesAtras(){

  $('#menu').show();

  $('#asisProfes').hide();
}



function guardar(){  

            var f = $(this);
            var formData = new FormData(document.getElementById("formularioSubirArchivo"));
            //formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({

                url: "subirDatos",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function(){

                  $("#h2_formularioSubirArchivo").html("Cargando por favor espere...");

                },

                success: function(respuesta){
                  $("#h2_formularioSubirArchivo").html(respuesta);
                }

            })
                .done(function(respuesta){
                    
                });
}

function guardarCambioClave(){
   
var Vieja=document.getElementById("PasswordOldq").value;
 var Nueva=document.getElementById("PasswordNewq").value;
 var NuevaC=document.getElementById("PasswordNewCq").value;


$.ajax({

   data: {
      passwordOld: Vieja, //document.getElementById("passwordOld").value,
      passwordNew: Nueva,//document.getElementById("passwordNew").value,
      passwordNewC: NuevaC//document.getElementById("passwordNewC").value
    },
    
    url: 'proceso1/cambiarClaveAdmin',
    
    type: 'get', 
                
    beforeSend: function () {

        $("#mensajeClave").html("Generando Cambio de clave, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeClave").html(response); 

    
    }
    
  });
}

function cambioClave(){
  $("#menu").hide();
  $("#cambiarClave").show();
}

function cambioClaveAtras(){

  $("#menu").show();
  $("#cambiarClave").hide();

 
 $("#PasswordOld").reset();
 $("#PasswordNew").reset();
 $("#PasswordNewC").reset();
}

function crearProgramacion(){

  $("#menu1").hide();
  $("#crearProgramacion").show();

  $('#SelectId_asignaturaDepeCH').load('listarAsignaturas');

  $('#SelectId_usuarioCH').load('listarUsuarios');


}

function crearHorario(){


  $.ajax({

   data: {
      asig_Dependencia: document.getElementById("SelectId_asignaturaDepeCH").value,
      horaInicial: document.getElementById("horaInicial").value,
      cantidadHoras: document.getElementById("cantidadHoras").value,
      id_usuarioH: document.getElementById("SelectId_usuarioCH").value,
      dia: document.getElementById("dia").value

    },
    
    url: 'proceso/crearHorario',
    
    type: 'get', 
                
    beforeSend: function () {

        $("#mensajeCH").html("Creando Horario, Espere por favor...");
      },
      
    success:  function (response) {

      $("#mensajeCH").html(response); 
     
    }
    
  });
}

function crearProgramacionAtras(){

  $("#menu1").show();
  $("#crearProgramacion").hide();
}

function cambiarClaveUsuario(){

  $("#menu1").hide();

$("#cambiarClaveUsuario").show();

$('#selectClaveUsuarios').load('listarUsuarios');
}

function cambiarClaveUsuarioAtras(){

 $("#menu1").show();

$("#cambiarClaveUsuario").hide();
}

function cambiarClaveUsuarioGuardar(){

   $.ajax({

   data: {
      id_usuario: document.getElementById("selectClaveUsuarios").value,
      passwordNew: document.getElementById("passwordNewCUsus").value,
      passwordNewC: document.getElementById("passwordNewCCUsus").value
     
    },
    
    url: 'proceso/cambiarClaveUsuarios',
    
    type: 'get', 
                
    beforeSend: function () {

        $("#mensajeCUsus").html("Cambiando clave, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeCUsus").html(response); 
    }
    
  });
}

function asistenciaHoyProfesores(){

  $('#panelBlancoInterno').load('listarProfesoresHoy');
}



function SinRegistroHoyProfesores(){

  $('#panelBlancoInterno').load('listarProfesoresHoysinAsistir');
}


function asistenciaHoyMonitores(){
   $('#panelBlancoInterno2').empty();
  $('#panelBlancoInterno2').load('listarMonitoresHoy');
}



function SinRegistroHoyMonitores(){
     $('#panelBlancoInterno2').empty();

  $('#panelBlancoInterno2').load('listarMonitoresHoySinAsistir');
}


