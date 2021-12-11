@extends('layouts.app')
@section('title')
    Detalle Cita
@endsection

@section('content')
<div class="card" style="margin-left:350px; height:700px;width: 400px; margin-top:20px;margin-bottom:20px;">
    
    <div class="card-heard">
        <h4><strong style="margin-left:130px;margin-bottom:-20px;">DETALLE CITA </strong></h4>
    </div>
    <div class="card-body">    
          <h5 class="card-title">Nombre del cliente: </h5><p class="card-text">{{$citas->nombre_Cliente}}</p>
          <h5 class="card-title ">Precio: </h5><p class="card-text">{{$citas->precio}}</p>
          <h5 class="card-title ">Fecha: </h5><p class="card-text">{{$citas->fecha}}</p>
          <h5 class="card-title ">Servicio: </h5><p class="card-text">
            
            @foreach ($servicios as $key)
                @if ($key->id == $citas->servicio_id)
                     @if ($key->estado==1)
                         El servicio es {{$key->nombre_Servicio}}. 
                     @else               
                         <i><p class=" alert alert-danger">EL SERVICOP FUE DESACTIVADO.</p></i>   
                     @endif
                @endif 
            @endforeach                
           

            </p>
          <h5 class="card-title ">Direccion: </h5><p class="card-text">{{$citas->direccion}}</p>
          <h5 class="card-title ">Descripcion: </h5><p class="card-text">{{$citas->descripcion}}</p>
          <h5 class="card-title ">Estado: </h5><p class="card-text">
            @if ($citas->estado ==1)
                <i><p class="alert alert-info">LA CITA SE VA A REALIZARA.</p></i>           
            @else
                <i><p class="alert alert-danger">LA CITA FUE HECHA O SE CANCELO.</p></i>  
            @endif 
         
          </p>
          <a class="btn  btn-danger btn-ms" href="/Cita" ><i class=""glyphicon glyphicon-edit></i>Cancelar</a>
    </div>
    
</div>
    
@endsection