@extends('layouts.app')
@section('title')
    Crear Servicio
@endsection

@section('content')
<div class="card" style="margin-left:50px; height:500;width: 600px; margin-top:20px;margin-bottom:20px;">
    <div class="card-heard">
            
            <h4><strong style="margin-bottom:-20px;">CREAR SERVICIO</strong></h4>
    </div>
    <div class="card-body">
        
        <div >
            @include('flash::message')
            <form action="/Servicios/Guardar" method="POST" class="formulario-Crear row g-3">
                @csrf
                
                <div class="col-md-6">
                    
                        <label >Nombre del Servicio</label>
                        <input type="text"  class="form-control  @error('nombre_Servicio') is-invalid @enderror" name="nombre_Servicio">
                        @error('nombre_Servicio')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror

                    
                </div>
                
                <div class="col-md-6">
                    
                    <label >Precio</label>
                    <input type="text"   class="form-control @error('precio') is-invalid @enderror" name="precio">
                    @error('precio')
                    <div class="invalid-feedback">{{$message}}</div>                         
                    @enderror
                
            </div>
                <div class="col-md-13">
                    
                        <label >Descripcion</label>
                        <textarea name="descripcion"   class="form-control @error('descripcion') is-invalid @enderror "></textarea>
                        @error('descripcion')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div>


            

                
                
                <div class="col-12" >
                    <button type="submit" class="btn btn-success float-right ">Crear</button>
                    <a class="btn  btn-danger btn-ms " href="/Cita" ><i class=""glyphicon glyphicon-edit></i>Cancelar</a>
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
            'Ya puede ver la en la tabla servicios',
            'success'
            )
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'El servico  no fue Agregado',
            'Revice que decea cambiar o regrese a la tabla servicios',
            'error'
            )
        }
    })

});

</script>
    
@endsection