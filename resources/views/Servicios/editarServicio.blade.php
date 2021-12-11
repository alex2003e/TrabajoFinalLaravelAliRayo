@extends('layouts.app')
@section('title')
    Editar Servicio
@endsection

@section('content')
<div class="card" style="margin-left:250px; height:350px;width: 400px; margin-top:20px;margin-bottom:20px;">
    <div class="card-heard">
         <h4><strong style="margin-left:60px;margin-bottom:-20px;">EDITAR SERVICIO </strong></h4>
    </div>
    <div class="card-body">
        
        <div class="">
            @include('flash::message')
            <form action="/Servicios/Actualizar/{{$servicios->id}}" method="POST" Class="Formulario-Editar row g-3">
                @csrf
                <input type="hidden" name="id" value="{{$servicios->id}}"/>
                <div class="col-md-6">
                 
                        <label>Nombre del Servicio</label>
                        <input type="text" value="{{$servicios->nombre_Servicio}}" class="form-control  @error('nombre_Servicio') is-invalid @enderror" name="nombre_Servicio">
                        @error('nombre_Servicio')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror

                    
                </div>
                
                <div class="col-md-6">
                 
                        <label>Precio</label>
                        <input type="text" value="{{$servicios->precio}}"  class="form-control @error('precio') is-invalid @enderror" name="precio">
                        @error('precio')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div>
            
                <div class="col-md-12">
                 
                        <label>Descripcion</label>
                        <textarea name="descripcion"   class="form-control @error('descripcion') is-invalid @enderror ">{{$servicios->descripcion}}</textarea>
                        @error('descripcion')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div> 
                <DIV class="col-12" >
                    <a class="btn  btn-danger btn-ms" href="/Cita" ><i class="glyphicon glyphicon-edit "></i>Cancelar</a>
                    <button type="submit" class="btn btn-success float-right ">Actualizar</button>
                </DIV>
            </form>    
        </div>
    </div>
</div>
    
@endsection

@section('js-alert')
<script>

$('.formulario-Editar').submit(function(e){

    e.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: '¿Estas seguro?',
        text: "El servico se Editara",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No, cancele',
        reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'El servico ha Editado',
            'Ya puede ver lo en la tabla servicios',
            'success'
            )
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'El servico no fue Editado',
            'Revice que decea cambiar o regrese a la tabla servicios',
            'error'
            )
        }
    })

});

</script>
    
@endsection