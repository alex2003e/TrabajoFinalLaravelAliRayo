@extends('layouts.app')
@section('title')
    Editar Cita
@endsection

@section('content')
<div class="card" style="margin-left:50px; height:500;width: 600px; margin-top:20px;margin-bottom:20px;">
    <div class="card-heard">
         <h4><strong style="margin-left:200px;margin-bottom:-20px;">EDITAR CITA </strong></h4>
    </div>
    <div class="card-body">
        
        <div class="">
            @include('flash::message')
            <form action="/Cita/Actualizar" method="POST" class="formulario-Editar row g-3">
                @csrf
                <input type="hidden" name="id" value="{{$cita->id}}"/>
                <div class="col-md-6">
                    
                        <label >Nombre del cliente</label>
                        <input type="text" value="{{$cita->nombre_Cliente}}" class="form-control  @error('nombre_Cliente') is-invalid @enderror" name="nombre_Cliente">
                        @error('nombre_Cliente')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror

                    
                </div>
                
                <div class="col-md-6">
                    
                        <label >Servicio</label>
                        <select name="servicio_id"  class=" form-control @error('servicio') is-invalid @enderror">
                                <option >seleccione uno </option>
                            @foreach ($servicios as $item => $key)
                                <option {{$key->id == $cita->servicio_id ? 'selected' : ''}} value="{{$key->id }}"> {{$key->nombre_Servicio}}</option>
                            @endforeach
                        </select>
                        @error('servicio')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div>
                
                <div class="col-md-6">
                    
                        <label >Precio</label>
                        <input type="text" value="{{$cita->precio}}"  class="form-control @error('precio') is-invalid @enderror" name="precio">
                        @error('precio')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div>
                
                <div class="col-md-6">
                    
                        <label >Fecha</label>
                        <input type="date" value="{{$cita->fecha}}" class="form-control @error('fecha') is-invalid @enderror" name="fecha">
                        @error('fecha')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div>
                <div class="col-md-8">
                   
                        <label >Direccion</label>
                        <input type="text" value="{{$cita->direccion}}"  class="form-control @error('direccion') is-invalid @enderror" name="direccion">
                        @error('direccion')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div>
                
                <div class="col-md-12">
                    
                        <label >Descripcion</label>
                        <textarea name="descripcion"  class="form-control @error('descripcion') is-invalid @enderror ">{{$cita->descripcion}}</textarea>
                        @error('descripcion')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    
                </div> 
                <DIV class="col-12" ><a class="btn  btn-danger btn-ms" href="/Cita" ><i class="glyphicon glyphicon-edit "></i>Cancelar</a>
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
        text: "La cita se Editara",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No, cancele',
        reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'La cita se ha Editado',
            'Ya puede ver la en la tabla citas',
            'success'
            )
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'La cita no fue Editada',
            'Revice que decea cambiar o regrese a la tabla citas',
            'error'
            )
        }
    })

});

</script>
    
@endsection