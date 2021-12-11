@extends('layouts.app')
@section('title')
 Servicios
@endsection

@section('content')
@if (Session::get('echoE'))
<div class="alert alert-success d-flex align-items-center" role="alert" style="margin-top:10px; width:40%;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        <strong>Logrado!: </strong>{{Session::get('echoE')}}
    </div>
  <button type="button" class="btn-close"style="margin-left:8%;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@elseif(Session::get('errorEd'))
<div class="alert alert-success d-flex align-items-center" role="alert" style="margin-top:10px; width:40%;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        <strong>Logrado!: </strong>{{Session::get('echoEd')}}
    </div>
  <button type="button" class="btn-close"style="margin-left:8%;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@elseif(Session::get('errorC'))   
<div class="alert alert-success d-flex align-items-center" role="alert" style="margin-top:10px; width:40%;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
        <strong>Logrado!: </strong>{{Session::get('echoC')}}
    </div>
  <button type="button" class="btn-close"style="margin-left:8%;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> 
@elseif(Session::get('errorE'))
<div class="alert alert-danger d-flex align-items-center" role="alert" style="margin-top:10px; width:40%;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      <strong>Error: </strong>{{Session::get('errorE')}}
    </div>
  <button type="button" class="btn-close" style="margin-left:8%;"    data-bs-dismiss="alert" aria-label="Close"></button>
</div>   
@endif

<a href="/Servicios/Crear">
<button class="btn botonTi" style="Background-color:#0F6A68;color:#ffff;margin-bottom:20px;margin-top:20px;" >Crear servicios</button>
</a>
{{-- 
@include('flash::message') --}}
<table id="TadaBaseServicios" class="table table-striped table-bordered">
    <thead>
        <tr>

            <th scope="col">Id</th>
            <th scope="col">Nombre Servicio</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
          
    <tbody> 
   
</tbody>
</table>

@section('js')
<script>
$(document).ready(function() {
$('#TadaBaseServicios').DataTable({


        processing: true,
        serverSide: true,
        ajax:'/Servicios/Listar',
        columns:[{
            data: 'id',
            name: 'id'
        },
        {
            data: 'nombre_Servicio',
            name: 'nombre_Servicio'
        },
        {
            data: 'descripcion',
            name: 'descripcion'
        },
        {
            data: 'precio',
            name: 'precio'
        },
        {
            data: 'cambiar',
            name: 'cambiar',
            orderable: false,
            searchable: false
        },
        {
            data:'editar',
            name:'editar',
            orderable: false,
            searchable: false
        },
        {
            data:'detalle',
            name:'detalle',
            orderable: false,
            searchable: false
        },],

        "language": {
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "zeroRecords": "Sin resultados encontrados",
            "info":  "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty":" Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente ",
            "previous": " Anterior"
            }
        }
    });

});
</script>
@endsection
@endsection