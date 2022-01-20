@extends('layouts.app')
@section('title')
    Editar Producto
@endsection

@section('content')
<div class="card" style="margin-left:250px; height:350px;width: 400px; margin-top:20px;margin-bottom:20px;">
    <div class="card-heard">
         <h4><strong style="margin-left:60px;margin-bottom:-20px;">EDITAR PRODUCTO </strong></h4>
    </div>
    <div class="card-body">
        
        <div class="">
            @include('flash::message')
            <form action="/Productos/Actualizar/{{$productos->id}}" method="POST" Class="Formulario-Editar row g-3">
                @csrf
                <input type="hidden" name="id" value="{{$productos->id}}"/>
                <div class="col-md-6">
                        
                        <label >Nombre del Producto</label>
                        <input type="text"  class="form-control  @error('nombre_Producto') is-invalid @enderror" name="nombre_Producto" value="{{$productos->nombre_Producto}}">
                        @error('nombre_Producto')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror

                    
                </div>
                
                <div class="col-md-6">
                    
                    <label >Cantidad</label>
                    <input type="number"   class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="{{$productos->cantidad}}">
                    @error('cantidad')
                    <div class="invalid-feedback">{{$message}}</div>                         
                    @enderror
                
                </div>

                <div class="col-md-6">
                    
                    <label >Precio</label>
                    <input type="text"   class="form-control @error('precios') is-invalid @enderror" name="precios" value="{{$productos->precios}}">
                    @error('precios')
                    <div class="invalid-feedback">{{$message}}</div>                         
                    @enderror
                
                </div>
                <DIV class="col-12" >
                    <a class="btn  btn-danger btn-ms" href="/Producto" ><i class="glyphicon glyphicon-edit "></i>Cancelar</a>
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
            'Ya puede ver lo en la tabla productos',
            'success'
            )
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'El servico no fue Editado',
            'Revice que decea cambiar o regrese a la tabla productos',
            'error'
            )
        }
    })

});

</script>
    
@endsection