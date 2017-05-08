


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

  $("#menu").hide();


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
  alert("tomar los valor del combobox y registrar temas a esa asignatura");

   $("#regisTemas1").hide();

   $("#regisTemas2").show();

 
}

function pRegistrandoTemasGuardar(){
  alert("El tema esta siendo guardado(insert y limpiar campos)");

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
