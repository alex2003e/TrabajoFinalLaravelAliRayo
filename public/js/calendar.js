var calendar=null;
document.addEventListener('DOMContentLoaded', function() {

    let formulario =document.querySelector("form");

    var calendarEl = document.getElementById('calendar');

     calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale:"es",
      headerToolbar:{
          left:'prev,next today',
          center:'title',
          right:'dayGridMonth,timeGridWeek,listWeek'
      },
      // events:"http://127.0.0.1:8000/Cita/Listar",
      // dateClick:function(info) {
      //     $("#Crear").modal("show");
      // }
    //   CLIENTE FORM CREAT
    // -------------------------------
      navLinks:true,
      selectable:true,
      selectMirror:true,
      select: function (arg) {
        let f = moment(arg.startStr).format("YYYY-MM-DD");
        let h = moment(arg.startStr).format('HH:mm:ss');

        $("#Crear").modal("show");
        $("#fechaC").val(f);
        $("#horaC").val(h);
        $("#tiempo").val(30);
        calendar.render();
        console.log(f,h);
      },
      // --------------------------------
      eventClick: function(info) {
        let id =info.event.extendedProps.idC;
        let estado =info.event.extendedProps.estado;
        $("#Opciones").modal("show");
        $("#opcionesDetalle").prop('href','http://127.0.0.1:8000/Cita/Detalle/'+id);
        $("#opcionesEditar").prop('href','http://127.0.0.1:8000/Cita/Editar/'+id);
        
        
       if (estado == 1) {
        
        $("#op").append(`<a class="btn  btn-danger btn-ms"id="opcionesEstado1" href="http://127.0.0.1:8000/Cita/CambioEstado/${id}/0" ><i class="glyphicon glyphicon-edit"></i>Cancelar</a>`);
        }else{
        
        $("#op").append(`<a class="btn  btn-info btn-ms" id="opcionesEstado0"href="http://127.0.0.1:8000/Cita/CambioEstado/${id}/1" ><i class="glyphicon glyphicon-edit"></i>Activar</a>`);
        
      }
        
        //"/Cita/CambioEstado/{{$citas->id}}/0
       // /Cita/Editar/{{$citas->id}
       // /Cita/Detalle/{{$citas->id}}
      },
      editable:true,
      events:{
          url: '/Cita/Listar',
          method: 'GET',

          failure: function() {
            alert('there was an error while fetching events!');
          },

    
        // any other sources...
      },
      // eventBackgroundColor:'#008000',
     
     
      
    });
    calendar.render();
    
  });

        // CLIENTE CREAT
      // -------------------------
function limpiar() {
  $("#Crear").modal('hide');
  
  $(".form-control").val("");
  $("#Cantidad").val(1);
  $(".sr").remove();
  $(".pr").remove();
}

function CrearCita() {
  var form =  new FormData(document.getElementById("formulario-Crear"));
  let hora = $("#horaC").val();
  let fecha = $("#fechaC").val();
  let tiempo = $("#tiempo").val();
  let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');

  
   
   form.append("horaF",hora_final);
   form.append("minutos",tiempo);
   $.ajax({
    url: '/Cita/Guardar',
    type: 'post',
    data: form,
    processData: false,
    contentType: false,
   }).done(function(respuesta) {
      if (respuesta && respuesta.ok) {
         calendar.refetchEvents();
        Swal.fire({
          position: 'top',
          icon: 'success',
          title: 'La fue cita creada.',
          showConfirmButton: false,
          timer: 1500
        })
        limpiar();
        
      }else{
       
        Swal.fire({
          position: 'top',
          icon: 'error',
          title: 'La cita no se creo.',
          showConfirmButton: false,
          timer: 1500
        })
        
        
      }
   })
}
     // --------------------------