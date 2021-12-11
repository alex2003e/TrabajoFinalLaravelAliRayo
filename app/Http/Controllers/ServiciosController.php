<?php

namespace App\Http\Controllers;

use App\models\Servicio;
use App\models\Cita;

use DataTables;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class ServiciosController extends Controller
{
    public function index(){

        return view("Servicios.indexServicio");
    }  
    public function listar(Request $request){
        $servicio = Servicio::all();
        return DataTables::of($servicio)
        ->editColumn('estado',function ($servicio){
            return $servicio->estado == 1 ? "Activo":"Desactivo";
        })
        ->addColumn('editar',function ($servicio){
            return '<a class="btn  btn-warning btn-ms" href="/Servicios/Editar/'.$servicio->id.'" ><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })
        ->addColumn('detalle',function ($servicio){
            return '<a class="btn  btn-success btn-ms" href="/Servicios/Detalle/'.$servicio->id.'" >Detalle</a>';
        })
        ->addColumn('cambiar',function ($servicio){
            if($servicio->estado == 1){
            return '<a class="btn  btn-primary btn-ms" href="/Servicios/CambioEstado/'.$servicio->id.'/0" >Activado</a>';
            }else{
            return '<a class="btn  btn-danger btn-ms" href="/Servicios/CambioEstado/'.$servicio->id.'/1" >Desactivado</a>';
            }
        })
        ->rawColumns(['editar','cambiar','detalle'])
        ->make(true);

    }
    public function crear(){
        
        return view('Servicios.CrearServicio');
    }
    public function save(Request $request){
        $input=$request->all();
        $servis=Servicio::all();
        $request->validate([        
        'nombre_Servicio'=>'required|unique:servicios,nombre_Servicio|min:3|string',
        'descripcion'=>'string|min:5',
        'precio'=>'required|min:0|max:100',
        ]);
      
        try{
            Servicio::create([
                "nombre_Servicio"=>$input["nombre_Servicio"],
                "descripcion"=>$input["descripcion"],
                "precio"=>$input["precio"],
                "estado"=>$input=1,
            ]);
            session()->flash('echoC',' El servicio se Agrego');
            return redirect("/Servicios");
        }catch(\Exception $e){
            Flash::error($e->getMessage());
            return redirect("/Servicios/Crear");
        }


    }
    public function editar($id){
        $servicios=Servicio::find($id);
        
        if ($servicios==null) {
            session()->flash('errorE','Servicio no encontrado');;
            return redirect("/Servicios");
        }
        return view("Servicios.editarServicio",compact("servicios"));
    }
    public function detalle($id){
        $servicios=Servicio::find($id);
        
        if ($servicios==null) {
            session()->flash('errorE','servicio no encontrado');
            return redirect("/Servicios");
        }
        return view("Servicios.detalleServicio",compact("servicios"));
    }
    public function update(Request $request){
        $input=$request->all();
        $servis=Servicio::all();
        $request->validate([ 
        'nombre_Servicio'=>'required|unique:servicios,nombre_Servicio|min:3|string',
        'descripcion'=>'nullable|string|max:300|min:5',
        'precio'=>'required|min:0|max:100000',
        'estado'=>'in:1,0']);
      
        try{
            $servicio=Servicio::find($input["id"]);

            if ($servicio==null) {
                session()->flash('errorE','Servicio no encontrado');
                return redirect("/Servicios");
            }

            $servicio->update([
                "nombre_Servicio"=>$input["nombre_Servicio"],
                "descripcion"=>$input["descripcion"],
                "precio"=>$input["precio"],
                
            ]);
            session()->flash('echoEd','El servicio fue Editado');
            
            return redirect("Servicios");
        }catch(\Exception$e){
            Flash::error($e->getMessage());
            return redirect("/Servicios/Crear");
        }   

        
    }
    public function updateEstado($id,$estado){
       
        $servicio=Servicio::find($id);
        $servis=Servicio::all();
        $cita=Cita::all();
        
        foreach ($servis as  $value) {
            foreach($cita as $item){
               
                    if ($item->servicio_id == $id) {
                    
                        if ($item->estado==0 ) {
                            // if($item->estado==1 && $value->estado==0){
                                if ($servicio==null) {
                                    Flash::error("");
                                    session()->flash('errorE','Servicio no encontrado');
                                    return redirect("/Servicios");
                                }
                                
                                try {
                                    $servicio->update(["estado"=>$estado]);
                                    session()->flash('echoE','El estado a sido cambiado');
                                    return redirect("/Servicios");
                                } catch (\Exception $e) {
                                    Flash::error($e->getMessage());
                                    
                                    return redirect("/Servicios/Crear");  
                                }      
                            // }
                        }else{
                            session()->flash('errorE','No se le puede cambiar el estado');
                            
                            return redirect("/Servicios");
                        }
                           
                    }
                
                
            }
        }
        
    }
}
