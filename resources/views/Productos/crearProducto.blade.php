@extends('layouts.app')
@section('title')
    Crear Producto
@endsection

@section('content')
<div class="card" style="margin-left:50px; height:580;width: 600px; margin-top:20px;margin-bottom:20px;">
    <div class="card-heard">
            
            <h4><strong style="margin-bottom:-20px;">CREAR PRODUCTO</strong></h4>
    </div>
    <div class="card-body">
        
        <div >
            @include('flash::message')
            <form action="/Productos/Guardar" method="POST" class="formulario-Crear row g-3">
                @csrf
                
                <div class="col-md-6">
                    
                        <label >Nombre del Producto</label>
                        <input type="text"  class="form-control  @error('nombre_Producto') is-invalid @enderror" name="nombre_Producto">
                        @error('nombre_Producto')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror

                    
                </div>
                
                <div class="col-md-6">
                    
                    <label >Cantidad</label>
                    <input type="number"   class="form-control @error('cantidad') is-invalid @enderror" name="cantidad">
                    @error('cantidad')
                    <div class="invalid-feedback">{{$message}}</div>                         
                    @enderror
                
                </div>

                <div class="col-md-6">
                    
                    <label >Precio</label>
                    <input type="text"   class="form-control @error('precios') is-invalid @enderror" name="precios">
                    @error('precios')
                    <div class="invalid-feedback">{{$message}}</div>                         
                    @enderror
                
                </div>

                <div class="col-12" >
                    <button type="submit" class="btn btn-success float-right ">Crear</button>
                    <a class="btn  btn-danger btn-ms " href="/Producto" ><i class=""glyphicon glyphicon-edit></i>Cancelar</a>
                </div> 
            </form>
                
        </div>
    </div>
</div>
    
@endsection
@section('js-alert')
<script>

$('.formulario-Crear').submit(function(e){

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
        text: "El servico se Agregara",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, seguro',
        cancelButtonText: 'No, cancele',
        reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'El servico se ha Agregado',
            'Ya puede ver la en la tabla Producto',
            'success'
            )
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'El servico  no fue Agregado',
            'Revice que decea cambiar o regrese a la tabla Producto',
            'error'
            )
        }
    })

});

</script>
    
@endsection