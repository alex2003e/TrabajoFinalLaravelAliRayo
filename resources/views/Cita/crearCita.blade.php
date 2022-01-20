@extends('layouts.app')
@section('title')
    Crear Cita
@endsection

@section('content')
<div class="">
    <div class="card-heard">
         <h4><strong style="margin-left:200px;margin-bottom:-20px;">CREAR CITA </strong></h4>
    </div>
    <div class="card-body">
        
        <div class="">
            @include('flash::message')
            <form action="/Cita/Guardar" method="POST" class="formulario-Crear">
                @csrf
                <div class="card text-dark bg-light mb-3" style="width: 380px;">
                    <div class="card-header"><strong> CLIENTE</strong></div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label >Nombre del cliente </label>
                            <input type="text"  class="form-control  @error('nombre_Cliente') is-invalid @enderror" name="nombre_Cliente">
                            @error('nombre_Cliente')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        </div>
                
                        <div class="col-md-6">
                            <label >Fecha </label>
                            <input type="date"  class="form-control @error('fecha') is-invalid @enderror" name="fecha">
                            @error('fecha')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        </div>
                
                        <div class="col-md-6">
                            <label >Hora </label>
                            <input type="time"  class="form-control @error('hora') is-invalid @enderror" name="hora">
                            @error('hora')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        </div>
                
                        <div class="col-md-6">
                            <label >Direccion </label>
                            <input type="text"  class="form-control @error('direccion') is-invalid @enderror" name="direccion">
                            @error('direccion')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        </div>
                        <div class="col-md-13">
                            <label >Descripcion</label>
                            <textarea name="descripcion"  class="form-control @error('descripcion') is-invalid @enderror "></textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        
                        </div> 
                        <DIV class="col-md- 12" >
                            <a class="btn  btn-danger btn-ms" href="/Cita" ><i class="glyphicon glyphicon-edit "></i>Cancelar</a>
                            <button type="submit"  class="btn btn-success float-rigth ">crear</button>
                        </DIV>                  
                    </div>
                </div>
                <div class="card text-dark bg-light mb-3" style="width: 380px; left:660px; top:55px; position:absolute;">
                    <div class="card-header"><strong> Servicios</strong></div>
                    <div class="card-body row g-3">
                        <div class="col-6">
                                        
                            <label >Servicio</label>
                            <select name="servicio_id"  id="servicio" class=" form-control @error('servicio') is-invalid @enderror" onchange="precio_total()">
                                    <option value="" >seleccione uno </option>
                                @foreach ($servicios as $value)
                                    <option precio="{{$value->precio}}" value="{{ $value->id }}">{{ $value->nombre_Servicio }}</option>
                    
                                @endforeach
                            </select>

                            @error('servicio')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                    
                        </div>
                    
                        <div class="col-6">
                            
                                <label >Precio</label>
                                
                                <input type="text"  id="precio" class="form-control @error('precio') is-invalid @enderror" name="precio"
                                value="0" readonly>
                                    
                                @error('precio')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            
                        </div>
                        <div class="col-6">
                            
                            <label >Precio total</label>
                            
                            <input type="text"  id="preciototal" class="form-control @error('precio') is-invalid @enderror" name="precio"
                            value="0" readonly>
                                
                            @error('precio')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        
                        </div>
                            
                        <div style="margin-top: 10px;">
                            <table id="TadaBaseCitas" class="table  table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Servicio</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbalaServicio">

                                </tbody>
                            </table>
                        </div>
                        <button  type="button" onclick="agregar_Servicio()" class="btn btn-success float-right ">agregar</button> 
                            
                    </div>
                </div>
                <div class="card text-dark bg-light mb-3" style="width: 450px; left:1050px; top:55px;position:absolute;">
                    <div class="card-header"><strong> Productos</strong></div>
                    <div class="card-body row g-3">
                        <div class="col-6">
                                        
                            <label >Producto</label>
                            <select name="producto_id"  id="producto" class=" form-control @error('producto') is-invalid @enderror" onchange="precio_totalp()">
                                    <option value="" >seleccione uno </option>
                                @foreach ($producto as $value)
                                    <option precioP="{{$value->precios}}" value="{{ $value->id }}">{{ $value->nombre_Producto }}</option>
                    
                                @endforeach
                            </select>

                            @error('producto')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                    
                        </div>
                    
                        <div class="col-6">
                            
                                <label >Precio</label>
                                
                                <input type="text"  id="precioP" class="form-control @error('precioP') is-invalid @enderror" name="precioP"
                                value="0" readonly>
                                    
                                @error('precioP')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            
                        </div>
                        <div class="col-6">
                            
                            <label >Precio total</label>
                            
                            <input type="text"  id="preciototalP" class="form-control @error('precioP') is-invalid @enderror" name="precioP"
                            value="0" readonly>
                                
                            @error('precioP')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        
                        </div>
                        <div class="col-6">
                            
                            <label >Cantidad</label>
                            
                            <input type="number"  id="Cantidad" class="form-control @error('precioP') is-invalid @enderror" name="Cantidad"
                            value="" >
                                
                            @error('Cantidad')
                            <div class="invalid-feedback">{{$message}}</div>                         
                            @enderror
                        
                        </div>
                            
                        <div style="margin-top: 10px;">
                            <table id="TadaBaseCitas" class="table  table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">SubTotal</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbalaProducto">

                                </tbody>
                            </table>
                        </div>
                        <button  type="button" onclick="agregar_Producto()" class="btn btn-success float-right ">agregar </button> 
                            
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>         
@endsection
@section('js-alert')
<script>
function precio_total(){

    let precio = $("#servicio option:selected").attr("precio");     
    console.log(precio);
 $("#precio").val(precio);

}
function agregar_Servicio() {

    let servicio = $("#servicio option:selected").text();
    console.log(servicio);
    let precio = $("#servicio option:selected").attr("precio");
    console.log(precio);
    let id = $("#servicio option:selected").val()
    console.log(id);
    if (precio>0) {
        $('#tbalaServicio').append(`
            <tr id="tr-${id}">
                <td>
                <input type="hidden" name="servicios_id[]" value="${id}"/>
                ${id}</td>
                <td>${servicio}</td>
                <td>${precio}</td>
                <td><button type="button" class="btn btn-danger float-right " onclick="Eliminar(${id},${precio})">Eliminar</button>
                </td>
            </tr>
        
        `);

            let precioTotal = $("#preciototal").val() ||0;
            $("#preciototal").val(parseInt(precioTotal)+parseInt(precio));
    } else {
        alert("ingresa un servicio");
        
    }
}
function Eliminar($id,$precio) {
    $("#tr-"+$id).remove();
    let precioTotal = $("#preciototal").val() ||0;
   $("#preciototal").val(parseInt(precioTotal)-parseInt($precio));
}
function precio_totalp(){

    let precioP = $("#producto option:selected").attr("preciop");     
    console.log(precioP);
 $("#precioP").val(precioP);

}
function agregar_Producto() {

    let producto = $("#producto option:selected").text();
    console.log(producto);
    let precioP = $("#producto option:selected").attr("preciop");
    console.log(precioP);
    let idP = $("#producto option:selected").val();
    let Cantidad = $("#Cantidad").val()
    console.log(idP);
    console.log(Cantidad);
    if (precioP>0) {
        if (Cantidad>0) {
            $('#tbalaProducto').append(`
            <tr id="tr-${idP}">
                <td>
                <input type="hidden" name="productos_id[]" value="${idP}"/>
                <input type="hidden" name="Cantidad_id[]" value="${Cantidad}"/>
                ${idP}</td>
                <td>${producto}</td>
                <td>${Cantidad}</td>
                <td>${parseInt(Cantidad) * parseInt(precioP)}</td>
                <td><button type="button" class="btn btn-danger float-right " onclick="Eliminar(${idP},${precioP})">Eliminar</button>
                </td>
            </tr>
        
        `);

            let precioTotalP = $("#preciototalP").val() ||0;
            $("#preciototalP").val(parseInt(precioTotalP)+(parseInt(Cantidad)*parseInt(precioP)));
        }else{
            alert("ingresa un servicio");
        }
        
    } else {
        alert("ingresa un servicio");
        
    }
}
function EliminarP($idP,$precioP) {
    $("#tr-"+$idP).remove();
    let precioTotalP = $("#preciototalP").val() ||0;
   $("#preciototalP").val(parseInt(precioTotalP)-parseInt($precioP));
}
$('.formulario-Crear').submit(function(e){

    e.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })

    swalWithBootstrapButtons.fire({
        title: '¿Estas seguro?',
        text: "La cita se Agregara",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, seguro',
        cancelButtonText: 'No, cancele',
        reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            'La cita se ha Agregado',
            'Ya puede ver la en la tabla citas',
            'success'
            )
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'La cita no fue Agregada',
            'Revice que decea cambiar o regrese a la tabla citas',
            'error'
            )
        }
    })

});




</script>
    
@endsection