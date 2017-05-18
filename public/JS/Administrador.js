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
      estado: gestado;
      id_perfil: gid_perfil///document.getElementById("id_perfil").value               
    },
    
    url: 'registrarUsuario',
    
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

    alert('Guardar datos y limpiar');

  $.ajax({

   data: {
      id_usuario: document.getElementById("selectReport").value,
      asunto: document.getElementById("asuntoReport").value,
      descripcion: document.getElementById("descripcionReport").value
    },
    
    url: 'generarReporte',
    
    type: 'get', 
                
    beforeSend: function () {
        $("#mensajeReport").html("Generando Reporte, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeReport").html("Reporte creado Sactifatoriamente!!");      
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

$.ajax({

   data: {
      passwordOld: document.getElementById("passwordOld").value,
      passwordNew: document.getElementById("passwordNew").value,
      passwordNewC: document.getElementById("passwordNewC").value
    },
    
    url: 'cambiarClaveAdmin',
    
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

  $('#SelectId_asignaturaDepe').load('listarAsignaturas');

  $('#SelectId_usuario').load('listarUsuarios');


}

function crearHorario(){

  alert('Guardar datos y limpiar');

  $.ajax({

   data: {
      asig_Dependencia: document.getElementById("SelectId_asignaturaDepeCH").value,
      horaInicial: document.getElementById("horaInicial").value,
      cantidadHoras: document.getElementById("cantidadHoras").value,
      id_usuario: document.getElementById("SelectId_usuarioCH").value,
      dia: document.getElementById("dia").value,

    },
    
    url: 'crearHorario',
    
    type: 'get', 
                
    beforeSend: function () {

        $("#mensajeCH").html("Creando Horario, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeCH").load('crearHorario'); 

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
    
    url: 'cambiarClaveUsuarios',
    
    type: 'get', 
                
    beforeSend: function () {

        $("#mensajeCUsus").html("Creando Horario, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeCUsus").load('crearHorario'); 
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


