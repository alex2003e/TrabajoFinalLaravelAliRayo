<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\producto;
use DataTables;
use Laracasts\Flash\Flash;
use PhpParser\Node\Stmt\Foreach_;

class ProductoController extends Controller
{
    public function index(){

        return view("Productos.indexProducto");
    }  
    public function listar(Request $request){
        $producto = producto::all();
        return DataTables::of($producto)
        ->addColumn('editar',function ($producto){
            return '<a class="btn  btn-warning btn-ms" href="/Productos/Editar/'.$producto->id.'" ><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })
        ->addColumn('detalle',function ($producto){
            return '<a class="btn  btn-success btn-ms" href="/Productos/Detalle/'.$producto->id.'" >Detalle</a>';
        })

        ->rawColumns(['editar','detalle'])
        ->make(true);

    }
    public function crear(){
        
        return view('Productos.CrearProducto');
    }
    public function save(Request $request){
        $input=$request->all();
        $servis=producto::all();
        $request->validate([        
        'nombre_Producto'=>'required|unique:productos,nombre_producto|min:3|string',
        'cantidad'=>'nullable|numeric',
        'precios'=>'required|min:0|max:100',
        ]);
      
        try{
            producto::create([
                "nombre_Producto"=>$input["nombre_Producto"],
                "cantidad"=>$input["cantidad"],
                "precios"=>$input["precios"],
                
            ]);
            session()->flash('echoC',' El producto se Agrego');
            return redirect("/Productos");
        }catch(\Exception $e){
            Flash::error($e->getMessage());
            return redirect("/Productos/Crear");
        }


    }
    public function editar($id){
        $productos=producto::find($id);
        
        if ($productos==null) {
            session()->flash('errorE','producto no encontrado');;
            return redirect("/Productos");
        }
        return view("Productos.editarProducto",compact("productos"));
    }
    public function detalle($id){
        $productos=producto::find($id);
        
        if ($productos==null) {
            session()->flash('errorE','producto no encontrado');
            return redirect("/Productos");
        }
        return view("Productos.detalleProducto",compact("productos"));
    }
    public function update(Request $request,$id){
        $input=$request->all();
        $servis=producto::all();
        foreach ($servis as $key => $value) {
            if ($value->id==$id) {
                 if ($input["nombre_Producto"]==$value->nombre_Producto) {
                    $request->validate([ 
                        'nombre_Producto'=>'required|min:3|string',
                        'cantidad'=>'nullable|numeric',
                        'precios'=>'required|min:0|max:10000']);
                        try{
                            $producto=producto::find($input["id"]);
                
                            if ($producto==null) {
                                session()->flash('errorE','producto no encontrado');
                                return redirect("/Productos");
                            }
                
                            $producto->update([
                                "nombre_Producto"=>$input["nombre_Producto"],
                                "cantidad"=>$input["cantidad"],
                                "precios"=>$input["precios"],
                                
                            ]);
                            session()->flash('echoEd','El producto fue Editado');
                            
                            return redirect("Productos");
                        }catch(\Exception$e){
                            Flash::error($e->getMessage());
                            return redirect("/Productos/Crear");
                        }   
                 }
               
            }
        }
        
        $request->validate([ 
        'nombre_Producto'=>'required|unique:productos,nombre_producto|min:3|string',
        'cantidad'=>'nullable|string|max:300|min:5',
        'precios'=>'required|min:0|max:100000']);
      
        try{
            $producto=producto::find($input["id"]);

            if ($producto==null) {
                session()->flash('errorE','producto no encontrado');
                return redirect("/Productos");
            }

            $producto->update([
                "nombre_Producto"=>$input["nombre_Producto"],
                "cantidad"=>$input["cantidad"],
                "precios"=>$input["precios"],
                
            ]);
            session()->flash('echoEd','El producto fue Editado');
            
            return redirect("Productos");
        }catch(\Exception$e){
            Flash::error($e->getMessage());
            return redirect("/Productos/Crear");
        }   

        
    }
}
