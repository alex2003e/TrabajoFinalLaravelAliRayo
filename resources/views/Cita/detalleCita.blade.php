@extends('layouts.app')
@section('title')
    Detalle Cita
@endsection

@section('content')
<div class="card" style="margin-left:350px; height:70%;width: 500px; margin-top:20px;margin-bottom:20px;">
    
    <div class="card-heard">
        <h4><strong style="margin-left:130px;margin-bottom:-20px;">DETALLE CITA </strong></h4>
    </div>
    <div class="card-body">    
          <h5 class="card-title">Nombre del cliente: </h5><p class="card-text">{{$citas->nombre_Cliente}}</p>
          <h5 class="card-title ">Precio: </h5><p class="card-text">{{$citas->precio}}</p>
          <h5 class="card-title ">Fecha : </h5><p class="card-text">{{$citas->fecha}}  </p>
          <h5 class="card-title ">Hora Inicio : </h5><p class="card-text">{{$horaI}}  </p>
          <h5 class="card-title ">Hora Final : </h5><p class="card-text">{{$horaF}}  </p>
          <h5 class="card-title ">Servicio: </h5><p class="card-text">
            
            @foreach ($servicios as $key)
                @foreach ($detalleS as $ds)
                    @if ($citas->id == $ds->cita_id)
                        @if ($key->estado==1)
                            @if ($key->id ==$ds->servicio_id)
                           
                                 El servicio es {{$key->nombre_Servicio}}. 
                            
                                
                            
                            @endif               
                        @else
                            <i><p class=" alert alert-danger">EL SERVICOP FUE DESACTIVADO.</p></i>   
                        @endif
                    @endif 
                @endforeach 
            @endforeach                
           

            </p>
            <h5 class="card-title ">Producto: </h5><p class="card-text">
            
                @foreach ($producto as $keyp)
                    @foreach ($detalleP as $dp)
                        @if ($citas->id == $dp->citas_id)
                            @if ($keyp->id == $dp->producto_id)
                               
                                    El producto es {{$keyp->nombre_Producto}},  
                                
                                              
                             
                            @endif
                        @endif 
                    @endforeach 
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
          <a class="btn  btn-secondary btn-ms" href="/Cita" ><i class="glyphicon glyphicon-edit"></i>salir</a>
          
        </div>
    
</div>
    
@endsection