@extends('layouts.app')
@section('title')
    Detalle Producto
@endsection

@section('content')
<div class="card" style="margin-left:250px;  height:450px;width: 400px; margin-top:20px;margin-bottom:20px;">
    
    <div class="card-heard">
        <h4><strong style="margin-left:100px;margin-bottom:-20px;">DETALLE PRODUCTO</strong></h4>
    </div>
    <div class="card-body">    
          <h5 class="card-title">Nombre del Producto: </h5><p class="card-text">{{$productos->nombre_Producto}}</p>
          <h5 class="card-title ">Precio: </h5><p class="card-text">{{$productos->precios}}</p>
          <h5 class="card-title ">Cantidad: </h5><p class="card-text">{{$productos->cantidad}}</p>
      
          <a class="btn  btn-danger btn-ms" href="/Productos" ><i class="glyphicon glyphicon-edit"></i>Cancelar</a>
    </div>
    
</div>
    
@endsection