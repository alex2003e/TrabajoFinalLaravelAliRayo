@extends('layouts.app')
@section('title')
    Editar Cita
@endsection

@section('content')


<div class="modal-dialog modal-dialog-scrollable" style="max-width:1400px;">
    <div class="modal-content" >
          <div class="modal-header">
          <h5 class="modal-title" id="CrearLabel">EDITAR CITA (solo se puede editar los datos personales del cliente)</h5>
          </div>
          <div class="modal-body">
                      
              <form action="" id="formulario-Editar">
                @include('flash::message')
                  @csrf
                  <input type="hidden" name="id" id="i" value="{{$cita->id}}"/>

                  {{-- CLIENTE FORM --}}
                  <div class="card text-dark bg-light mb-3" style="width: 380px;">
                      <div class="card-header"><strong> CLIENTE</strong></div>
                      <div class="card-body row g-3">
                          <div class="col-md-6">
                              <label >Nombre del cliente </label>
                              <input type="text" value="{{$cita->nombre_Cliente}}" class="form-control @error('nombre_Cliente') is-invalid @enderror" name="nombre_Cliente">
                              @error('nombre_Cliente')
                              <div class="invalid-feedback">{{$message}}</div>                         
                              @enderror
                          </div>
                  
                          <div class="col-md-6">
                              <label >Fecha </label>
                              <input type="date" id="fechaC" value="{{$cita->fecha}}" class="form-control @error('fecha') is-invalid @enderror" name="fecha">
                              @error('fecha')
                              <div class="invalid-feedback">{{$message}}</div>                         
                              @enderror
                          </div>
                  
                          <div class="col-md-6">
                              <label >Hora </label>
                              <input type="time" id="horaC"  value="{{$cita->horaI}}" class="form-control @error('hora') is-invalid @enderror" name="horaI" value="">
                              @error('hora')
                              <div class="invalid-feedback">{{$message}}</div>                         
                              @enderror
                          </div>
                          <div class="col-md-6">
                              <label >Tiempo (minutos) </label>
                              <input type="number" value="{{$cita->minutos}}" id="tiempo" class="form-control " name="minutos" value="">
                          
                          </div>
                          <div class="col-md-6">
                              <label >Direccion </label>
                              <input type="text"  value="{{$cita->direccion}}" id="direc" class="form-control @error('direccion') is-invalid @enderror" name="direccion">
                              @error('direccion')
                              <div class="invalid-feedback">{{$message}}</div>                         
                              @enderror
                          </div>
                          <div class="col-md-13">
                              <label >Descripcion</label>
                              <textarea name="descripcion"  value="" id="descri" class="form-control @error('descripcion') is-invalid @enderror ">{{$cita->descripcion}}</textarea>
                              @error('descripcion')
                              <div class="invalid-feedback">{{$message}}</div>                         
                              @enderror
                          
                          </div> 
                                       
                      </div>
                      <button  type="button"class="btn  btn-warning btn-ms" onclick="EditarCliente()" href="" >Editar Cliente</button>
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
                              value="{{$prec}}" readonly>
                                  
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
                                    @foreach ($detalleS as $value)
                                        @foreach ($servicios as $item)
                                        @if ($cita->id == $value->cita_id)
                                            @if ($value->servicio_id==$item->id)
                                            
                                                <tr id="tr-{{$item->id}}">
                                                    <input type="hidden" name="servicios_id[]" value="{{$item->id}}"/>
                                                    
                                                    
                                                    
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->nombre_Servicio}}</td>
                                                    <td>{{$item->precio}}</td>
                                                    <td><button type="button" class="btn btn-danger float-right " onclick="Eliminar({{$item->id}},{{$item->precio}})">Eliminar</button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                            
                                        @endforeach
                                       
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                          <button  type="button" onclick="agregar_Servicio()" class="btn btn-success float-right ">agregar</button> 
                          <button type="button" class="btn  btn-warning btn-ms"onclick="EditarServicio()" >Editar Servicio</button>  
                      </div>
                  </div>
                  
            
                 {{-- PRODUCTO FORM --}}
                  <div class="card text-dark bg-light mb-3" style="width: 450px; left:860px; top:15px;position:absolute;">
                      <div class="card-header"><strong> Productos</strong></div>
                      <div class="card-body row g-3">
                          <div class="col-6">
                                          
                              <label >Producto</label>
                              <select name="producto_id" value="0" id="producto" class=" form-control @error('producto') is-invalid @enderror" onchange="precio_totalp()">
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
                              value="{{$precS}}" readonly>
                                  
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
                                    
                                        @foreach ($detalleP as $value)
                                            @foreach ($producto as $item)
                                                @if ($value->citas_id==$cita->id)
                                                    @if ($value->producto_id==$item->id)
                                                        
                                                        <tr id="trp-{{$item->id}}">
                                                            <input type="hidden" name="productos_id[]" value="{{$item->id}}"/>
                                                            <input type="hidden" name="Cantidad_id[]" value="{{$value->cantidad}}"/>
                                                            <input type="hidden" name="idP" value="{{$value->id}}"/>
                                                            <td>{{$item->id}}</td>
                                                            <td>{{$item->nombre_Producto}}</td>
                                                            <td>{{$value->cantidad}}</td>
                                                            <td>{{$value->cantidad*$item->precios}}</td>
                                                            <td><button type="button" class="btn btn-danger float-right " onclick="EliminarP({{$item->id}},{{$item->precios*$value->cantidad}})">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                            
                                                @endif
                                        
                                            @endforeach
                                    
                                         @endforeach
                                   
                               
                                </tbody>
                            </table>
                        </div>
                          <button  type="button" onclick="agregar_Producto()" class="btn btn-success float-right ">agregar </button> 
                          <button type="button" class="btn  btn-warning btn-ms" onclick="EditarProducto()"  >Editar Producto</button>    
                      </div>
                      
                  </div>
                  
               
             
          </div>
          <div class="modal-footer">
              
              <a class="btn  btn-danger btn-ms" href="/Cita" ><i class=""glyphicon glyphicon-edit></i>Cancelar</a>
      
          </div>
          </form>
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
    console.log(precioP);
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
            
            $("#tr-"+idP).remove();
            $("#preciototalP").val(parseInt(precioTotalP)-precioP);
            $("#Cantidad").val(1);
           
            can = parseInt(can)+parseInt(Cantidad);
            
            console.log("cas",id,Cantidad);
             $('#tbalaProducto').append(`
            <tr id="tr-${idP}" class="pr">
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
            <tr id="tr-${idP}" class="pr">
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
function EliminarP($idP,$precioP) {
    $("#trp-"+$idP).remove();
    
    let precioTotalP = $("#preciototalP").val() ||0;
   $("#preciototalP").val(parseInt(precioTotalP)-$precioP);
   $("#Cantidad").val(1);
}

function EditarCliente() {
  var form =  new FormData(document.getElementById("formulario-Editar"));
  let hora = $("#horaC").val();
  let fecha = $("#fechaC").val();
  let tiempo = $("#tiempo").val();
  let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');
  let id = $("#i").val();
  var ur = "http://127.0.0.1:8000/Cita/Detalle/"+id;
  
   
   form.append("horaF",hora_final);
   form.append("minutos",tiempo);
   $.ajax({
    url: '/Cita/Actualizar/',
    type: 'post',
    data: form,
    processData: false,
    contentType: false,
   }).done(function(respuesta) {
      if (respuesta && respuesta.ok) {
         calendar.refetchEvents();
        Swal.fire({
          position: 'top',
          icon: 'success',
          title: 'los datos fueron actualizados.',
          showConfirmButton: false,
          timer: 1500
        })
        
        
      }else{
      
        Swal.fire({
          position: 'top',
          icon: 'error',
          title: 'los  datos no  fueron actualizados.',
          showConfirmButton: false,
          timer: 1500
        })
        
        
      }
   })
}
function EditarServicio() {
  var form =  new FormData(document.getElementById("formulario-Editar"));
  let hora = $("#horaC").val();
  let fecha = $("#fechaC").val();
  let tiempo = $("#tiempo").val();
  let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');
  let id = $("#i").val();
  var ur = "http://127.0.0.1:8000/Cita/Detalle/"+id;
  
   
   form.append("horaF",hora_final);
   form.append("minutos",tiempo);
   $.ajax({
    url: '/Cita/ActualizarS/',
    type: 'post',
    data: form,
    processData: false,
    contentType: false,
   }).done(function(respuesta) {
      if (respuesta && respuesta.ok) {
         calendar.refetchEvents();
        Swal.fire({
          position: 'top',
          icon: 'success',
          title: 'los datos fueron actualizados.',
          showConfirmButton: false,
          timer: 1500
        })
        
        
      }else{
      
        Swal.fire({
          position: 'top',
          icon: 'error',
          title: 'Los datos  no fueron actualizados.',
          showConfirmButton: false,
          timer: 1500
        })
        
        
      }
   })
}
function EditarProducto() {
  var form =  new FormData(document.getElementById("formulario-Editar"));
  let hora = $("#horaC").val();
  let fecha = $("#fechaC").val();
  let tiempo = $("#tiempo").val();
  let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');
  let id = $("#i").val();
  var ur = "http://127.0.0.1:8000/Cita/Detalle/"+id;
  
   
   form.append("horaF",hora_final);
   form.append("minutos",tiempo);
   $.ajax({
    url: '/Cita/ActualizarP/',
    type: 'post',
    data: form,
    processData: false,
    contentType: false,
   }).done(function(respuesta) {
      if (respuesta && respuesta.ok) {
         calendar.refetchEvents();
        Swal.fire({
          position: 'top',
          icon: 'success',
          title: 'los datos fueron actualizados.',
          showConfirmButton: false,
          timer: 1500
        })
        window.open(ur, '_self');
        
      }else{
      
        Swal.fire({
          position: 'top',
          icon: 'error',
          title: 'los datos no  fueron actualizados.',
          showConfirmButton: false,
          timer: 1500
        })
        
        
      }
   })
}
</script>
    
@endsection