function toggleCheckbox(item){
   var  enviar = item.value;
   //var  csrf_token = "{{ csrf_token() }}"
   //$("#respuesta").load('ProfesorControllerI',{envio :enviar , _token: $_token } );
  // var data = { enviar , $_token };
  

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
                }
        });
   
  

   
   
    // _token: $_token
}


/*---------REGISTRO ASISTENCIA---------------------------*/

function registroDeAsistencia(){

  $("#contenedor").load('ProfesorControllerC');

  $("#registrarHorario").show();

  $("#menu").hide();


}

function pAsisAtras(){
  $("#registrarHorario").hide();

  $("#menu").show();
}


function generarReporte(){

  $("#generarReporte").show();

  $("#menu").hide();


}


/*---------GENERAR REPORTES---------------------------*/


function pReporAtras(){
  $("#generarReporte").hide();

  $("#menu").show();
}


/*---------GENERAR INFORME---------------------------*/

function generarInforme(){

  $("#generarInforme").show();

  $("#menu").hide();


}

function pInforAtras(){
  $("#generarInforme").hide();

  $("#menu").show();
}

/*------------------Mis Asignaturas-------------------------------*/

function misAsignaturas(){



  $("#contenedorMisAsignaturas").load('ProfesorControllerM');
  
  $("#MisAsignaturas").show();

  $("#menu").hide();


}

function pMisAsigAtras(){
  $("#MisAsignaturas").hide();

  $("#menu").show();
}
