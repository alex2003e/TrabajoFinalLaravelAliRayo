@extends('layouts.app')
@section('title')
 INICIO
@endsection

@section('content')

<div class="card" style="margin-left:20%;; height:20%;width: 40%; margin-top:20px;margin-bottom:20px;">
    
    <div class="card-heard">
        <h4><strong style="margin-left:100px;margin-bottom:-20px;">BIENVENIDO  </strong></h4>
    </div>
    <div class="card-body">    
          <h5 class="card-title">Nombre del Usuario: </h5><p class="card-text">{{Auth::user()->name}}</p>
          <h6 class="card-title ">Correo: </h6><p class="card-text">{{Auth::user()->email}}</p>
         
          
    </div>
    
</div>
@endsection
