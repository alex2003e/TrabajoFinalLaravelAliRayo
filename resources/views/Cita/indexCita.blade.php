@extends('layouts.app')

@section('title')
 Cita
@endsection

@section('content')

      
  <!-- calendario -->
    <div class="container">
        <div id="calendar">

        </div>
    </div>
   

  
  <!-- Modal Crear -->
  <div class="modal fade" id="Crear" tabindex="-1" aria-labelledby="CrearLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable" style="max-width:1400px;">
      <div class="modal-content" >
            <div class="modal-header">
            <h5 class="modal-title" id="CrearLabel">Crear Cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('flash::message')
                <form action="" id="formulario-Crear">
                    @csrf
                    {{-- CLIENTE FORM --}}
                    <div class="card text-dark bg-light mb-3" style="width: 380px;">
                        <div class="card-header"><strong> CLIENTE</strong></div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label >Nombre del cliente </label>
                                <input type="text"  class="form-control @error('nombre_Cliente') is-invalid @enderror" name="nombre_Cliente">
                                @error('nombre_Cliente')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            </div>
                    
                            <div class="col-md-6">
                                <label >Fecha </label>
                                <input type="date" id="fechaC" class="form-control @error('fecha') is-invalid @enderror" name="fecha">
                                @error('fecha')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            </div>
                    
                            <div class="col-md-6">
                                <label >Hora </label>
                                <input type="time" id="horaC" class="form-control @error('hora') is-invalid @enderror" name="horaI" value="">
                                @error('hora')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label >Tiempo (minutos) </label>
                                <input type="number" id="tiempo" class="form-control "  value="">
                            
                            </div>
                            <div class="col-md-6">
                                <label >Direccion </label>
                                <input type="text"   id="direc" class="form-control @error('direccion') is-invalid @enderror" name="direccion">
                                @error('direccion')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            </div>
                            <div class="col-md-13">
                                <label >Descripcion</label>
                                <textarea name="descripcion"   id="descri" class="form-control @error('descripcion') is-invalid @enderror "></textarea>
                                @error('descripcion')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            
                            </div> 
                                         
                        </div>
                    </div>
                    {{-- SERVICIO FORM --}}
                    <div class="card text-dark bg-light mb-3" style="width: 380px; left:460px; top:15px; position:absolute;">
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
                   {{-- PRODUCTO FORM --}}
                    <div class="card text-dark bg-light mb-3" style="width: 450px; left:860px; top:15px;position:absolute;">
                        <div class="card-header"><strong> Productos</strong></div>
                        <div class="card-body row g-3">
                            <div class="col-6">
                                            
                                <label >Producto</label>
                                <select name="producto_id"  id="producto" class=" form-control @error('producto') is-invalid @enderror" onchange="precio_totalp()">
                                        <option value="" >seleccione uno </option>
                                    @foreach ($producto as $value)
                                    @if ($value->cantidad != 0)
                                    <option precioP="{{$value->precios}}" value="{{ $value->id }}">{{ $value->nombre_Producto }}</option>                        
                                        
                                    @endif
                                        
                        
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
                                value="1" >
                                    
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
                    
               
            </div>
            <div class="modal-footer">
                {{-- <button type="submit"  class="btn btn-success">crear</button> --}}
                <button type="button"  onclick="CrearCita()"class="btn btn-success" id="btnCrear">Crear</button>

                <button type="button"  onclick="limpiar()"class="btn btn-secondary" data-bs-dismiss="modal">salir</button>
        
            </div>
            </form>
      </div>
    </div>
  </div>
  {{-- MODAL OPCIONES --}}
  <div class="modal"  id="Opciones"tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Opciones de la cita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="op">
            <button type="button"  onclick="limpiar()"class="btn btn-secondary" data-bs-dismiss="modal">salir</button>
        
            
            
            {{-- <a class="btn  btn-warning btn-ms"id="opcionesEditar" href="" ><i class="glyphicon glyphicon-edit"></i>Editar</a> --}}
            <a class="btn  btn-primary btn-ms"id="opcionesDetalle" href="" ><i class="glyphicon glyphicon-edit"></i>Detalle</a>
           
        </div>

      </div>
    </div>
  </div>

@endsection
@section('js-alert')
<script>
    // SERVICIO FORM
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
            <tr id="tr-${id}" class="sr">
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
    console.log($id);
    $("#tr-"+$id).remove();
    let precioTotal = $("#preciototal").val() ||0;
   $("#preciototal").val(parseInt(precioTotal)-parseInt($precio));
}
    // PRODUCTO FORM
function precio_totalp(){

    let precioP = $("#producto option:selected").attr("preciop");     
    // console.log(precioP);
 $("#precioP").val(precioP);

}
let id = 0;
let can = 0;
function agregar_Producto() {
    
    let producto = $("#producto option:selected").text();
    // console.log(producto);
    let precioP = $("#producto option:selected").attr("preciop");
    // console.log(precioP);
    let idP = $("#producto option:selected").val();
    let Cantidad = $("#Cantidad").val();
    let precioTotalP = $("#preciototalP").val();
    console.log(parseInt(Cantidad) + parseInt(can),can);
    // console.log(idP);
    // console.log(Cantidad);
    if (precioP>0 &&Cantidad>0) {
        console.log(id); 
        if (idP  == id) {
            
            $("#trp-"+idP).remove();
            $("#preciototalP").val(parseInt(precioTotalP)-precioP);
            $("#Cantidad").val(1);
           
            can = parseInt(can)+parseInt(Cantidad);
            
            console.log("cas",id,Cantidad);
             $('#tbalaProducto').append(`
            <tr id="trp-${idP}" class="pr">
                <td>
                <input type="hidden" name="productos_id[]" value="${idP}"/>
                <input type="hidden" name="Cantidad_id[]" value="${can}"/>
                ${idP}</td>
                <td>${producto}</td>
                <td  id="td-${idP}" value="">${parseInt(can)}</td>
                <td>${parseInt(can)* parseInt(precioP)}</td>
                <td><button type="button" class="btn btn-danger float-right " onclick="EliminarP(${idP},${parseInt(can) * parseInt(precioP)})">Eliminar</button>
                </td>
            </tr>
        
            `);
            
            
            
            $("#preciototalP").val(parseInt(precioTotalP)+(parseInt(Cantidad)* parseInt(precioP))); 
            console.log(can);
            console.log($("#preciototalP").val());
        }else{
            
            $('#tbalaProducto').append(`
            <tr id="trp-${idP}" class="pr">
                <td>
                <input type="hidden" name="productos_id[]" value="${idP}"/>
                <input type="hidden" name="Cantidad_id[]" value="${Cantidad}"/>
                ${idP}</td>
                <td>${producto}</td>
                <td  id="td-${idP}" value="">${Cantidad}</td>
                <td>${parseInt(Cantidad) * parseInt(precioP)}</td>
                <td><button type="button" class="btn btn-danger float-right " onclick="EliminarP(${idP},${parseInt(Cantidad) * parseInt(precioP)})">Eliminar</button>
                </td>
            </tr>
        
        `);
            id = idP;
            can = Cantidad;
             console.log("pes",id,can);
        
             
            
            $("#preciototalP").val(parseInt(precioTotalP)+(parseInt(Cantidad)*parseInt(precioP)));
            
            
        }
        
    } else {
        alert("ingresa un producto");
        
    }
}

function reordenar() {
}   
function EliminarP($idP,$precioP) {
    $("#trp-"+$idP).remove();
    
    let precioTotalP = $("#preciototalP").val() ||0;
   $("#preciototalP").val(parseInt(precioTotalP)-$precioP);
   $("#Cantidad").val(1);
}
    // ALERT CREAT CITA
$('#formulario-Crear').submit(function(e){

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