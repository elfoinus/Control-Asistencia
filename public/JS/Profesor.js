


/*---------REGISTRO ASISTENCIA---------------------------*/
function toggleCheckbox(item){
   var  enviar = item.value;

   $.ajax({
                data: {
                      //token: csrf_token,
                      envio: enviar                
                      },
                url:   'ProfesorControllerI', //archivo que recibe la peticion
                type:  'get', //método de envio
                beforeSend: function () {
                        $("#respuesta").html("Procesando, espere por favor...");
                        
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#respuesta").html(response);
                      
                        item.disabled = true;
                }
        });

}


/*---------MOSTRAR PANEL REGISTRO ASISTENCIA---------------------------*/

function registroDeAsistencia(){

  $("#contenedor").load('ProfesorControllerC');
  $("#semana").load('ProfesorControllerS');

  $("#registrarHorario").show();

  $("#menu").hide();


}

function pAsisAtras(){
  $("#registrarHorario").hide();

  $("#menu").show();
}


function generarReporte(){

  $("#generarReporte").show();
  $("#selectReporProfesor").load('listarAsigParaReporte');

  $("#menu").hide();


}

function clasesPorRecuperar(){

  $('#clasesPorRecuperar').show();
  $('#tablaRecuperar').load('ProfesorControllerD');
  $("#menu").hide();

}

function recuperarAtras(){
$('#menu').show();

$('#clasesPorRecuperar').hide();

}



function guardarReporte(){

  $.ajax({

   data: {
      id_registro: document.getElementById("selectReporProfesor").value,
      tipo: document.getElementById("selectTipoReporProfesor").value,
      nEstudiantes: document.getElementById("nEstudiantes").value,
      descripcionRP: document.getElementById("descripcionRP").value
    },
    
    url: 'proceso/registrarReporte',
    
    type: 'get', 
                
    beforeSend: function () {
        $("#mensajeRP").html("Generando Reporte, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeRP").html(response);      
    }
    
  });

}


/*---------MOSTRAR PANEL GENERAR REPORTES---------------------------*/


function pReporAtras(){
  $("#generarReporte").hide();

  $("#menu").show();
}


/*---------GENERAR TEMAS---------------------------*/

function registrarTemas(){

  $("#regisTemas1").show();

  $("#menu").hide();

  $("#selectAsigTemas").load('listarAsignaturasUsuario');


}

function pTemasAtras(){
  $("#regisTemas1").hide();

  $("#menu").show();
}

function pRegistrandoTemasAtras(){

  $("#regisTemas2").hide();

  $("#regisTemas1").show();
}

function pRegistrarTemas(){

   $("#regisTemas1").hide();

   $("#regisTemas2").show();

 
}

function pRegistrandoTemasGuardar(){
 

  $.ajax({

   data: {
      codigoAsig: document.getElementById("selectAsigTemas").value,
      NombreTema: document.getElementById("NombreTema").value,
      DescripcionTema: document.getElementById("DescripcionTema").value
    },
    
    url: 'proceso/crearTema',
    
    type: 'get', 
                
    beforeSend: function () {
        $("#mensajeTema").html("Generando Tema, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeTema").html(response);      
    }
    
  });



}
/*------------------MOSTRAR PANEL Mis Asignaturas-------------------------------*/

function misAsignaturas(){



  $("#contenedorMisAsignaturas").load('ProfesorControllerM');
  
  $("#MisAsignaturas").show();

  $("#menu").hide();


}

function pMisAsigAtras(){
  $("#MisAsignaturas").hide();

  $("#menu").show();
}

function cambiarClavep(){

  $.ajax({

   data: {
      PasswordOldp: document.getElementById("PasswordOldp").value,
      PasswordNewp: document.getElementById("PasswordNewp").value,
      PasswordNewCp: document.getElementById("PasswordNewCp").value
    },
    
    url: 'proceso/cambiarClaveProfesor',
    
    type: 'get', 
                
    beforeSend: function () {
        $("#mensajeClave").html("Cambiando Clave, Espere por favor...");
      },
      
    success:  function (response) {

       $("#mensajeClave").html(response);      
    }
    
  });
}
