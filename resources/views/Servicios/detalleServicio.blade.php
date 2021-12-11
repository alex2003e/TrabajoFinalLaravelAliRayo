@extends('layouts.app')
@section('title')
    Detalle Servicio
@endsection

@section('content')
<div class="card" style="margin-left:250px;  height:450px;width: 400px; margin-top:20px;margin-bottom:20px;">
    
    <div class="card-heard">
        <h4><strong style="margin-left:100px;margin-bottom:-20px;">DETALLE SERVICIO</strong></h4>
    </div>
    <div class="card-body">    
          <h5 class="card-title">Nombre del Servicio: </h5><p class="card-text">{{$servicios->nombre_Servicio}}</p>
          <h5 class="card-title ">Precio: </h5><p class="card-text">{{$servicios->precio}}</p>
          <h5 class="card-title ">Descripcion: </h5><p class="card-text">{{$servicios->descripcion}}</p>
          <h5 class="card-title ">Estado: </h5><p class="card-text">
            @if ($servicios->estado ==1)
                <i><p class="alert alert-info">EL SERVICIO SE PUEDE REALIZAR</p></i>           
            @else
                <i><p class="alert alert-danger">EL SERVICIO SE CANCELO.</p></i>  
            @endif 
         
          </p>
          <a class="btn  btn-danger btn-ms" href="/Servicios" ><i class="glyphicon glyphicon-edit"></i>Cancelar</a>
    </div>
    
</div>
    
@endsection