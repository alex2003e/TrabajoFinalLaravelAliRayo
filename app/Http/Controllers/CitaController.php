<?php

namespace App\Http\Controllers;

use App\models\Cita;
use App\models\Servicio;
use DataTables;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class CitaController extends Controller
{
    public function index(){
       
       
        return view("Cita.indexCita");
    }
    public function listar(Request $request){
        $citas = Cita::select("citas.*","servicios.nombre_Servicio")
        ->join("servicios","citas.servicio_id","=","servicios.id")
        ->get();
        return DataTables::of($citas)
        ->editColumn('estado',function ($cita){
            return $cita->estado == 1 ? "Activo":"Desactivo";
        })
        ->addColumn('editar',function ($cita){
            return '<a class="btn  btn-warning btn-ms" href="/Cita/Editar/'.$cita->id.'" ><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })
        ->addColumn('detalle',function ($cita){
            return '<a class="btn  btn-success btn-ms" href="/Cita/Detalle/'.$cita->id.'" >Detalle</a>';
        })
        ->addColumn('cambiar',function ($cita){
            if($cita->estado == 1){
            return '<a class="btn  btn-primary btn-ms cambio-Estado" href="/Cita/CambioEstado/'.$cita->id.'/0" >Activado</a>';
            }else{
            return '<a class="btn  btn-danger btn-ms cambio-Estado" href="/Cita/CambioEstado/'.$cita->id.'/1" >Desactivado</a>';
            }
        })
        ->rawColumns(['editar','cambiar','detalle'])
        ->make(true);

    }
    public function crear(){
        $servicios=Servicio::all();
        return view('Cita.CrearCita',compact('servicios'));
    }
    public function guardar(Request $request){
        $input=$request->all();
        $servi= Servicio::all();
        $request->validate([
        'nombre_Cliente'=>'required|min:3|max:100|string',
        'servicio_id'=>'required|exists:servicios,id',
        'fecha'=>'nullable|date',
        'direccion'=>'nullable|string|max:300|min:5',
        'descripcion'=>'nullable|string|max:300|min:5',
        'precio'=>'required|min:0|max:100000',
        'estado'=>'in:1,0',
        ]);
        foreach ($servi as $value) {
            if ($input["servicio_id"]==$value->id) {
                if ($value->estado==1) {
                            
                    try{
                        Cita::create([
                            "nombre_Cliente"=>$input["nombre_Cliente"],
                            "servicio_id"=>$input["servicio_id"],
                            "fecha"=>$input["fecha"],
                            "direccion"=>$input["direccion"],
                            "descripcion"=>$input["descripcion"],
                            "precio"=>$input["precio"],
                            "estado"=>$input=1,
                        ]);
                        session()->flash('echoC','La cita fue Agregada');
                        return redirect("/Cita");
                    }catch(\Exception $e){
                        Flash::error($e->getMessage());
                        return redirect("/Cita/Crear");
                    }
                }else{
                    session()->flash('errorC','La cita  no fue Agregada');
                        return redirect("Cita");
                }
            }
        }


    }
    public function editar($id){
        $cita=Cita::find($id);
        $servicios=Servicio::all();
        if ($cita==null) {
            session()->flash('errorE','Cita no encontrada');
            return redirect("/Cita");
        }
        return view("Cita.editarCita",compact("cita","servicios"));
    }
    public function detalle($id){
        $citas=Cita::find($id);
        $servicios=Servicio::all();
        if ($citas==null) {
            session()->flash('errorE','Cita no encontrada');
            return redirect("/Cita");
        }
        return view("Cita.detalleCita",compact("citas","servicios"));
    }
    public function update(Request $request){
        $input=$request->all();
        $servi= Servicio::all();
        $request->validate([ 
        'nombre_Cliente'=>'required|min:3|max:100|string',
        'servicio_id'=>'required|exists:servicios,id',
        'fecha'=>'required|date',
        'direccion'=>'nullable|string|max:300|min:5',
        'descripcion'=>'nullable|string|max:300|min:5',
        'precio'=>'required|min:0|max:100000',
        'estado'=>'in:1,0',
        ]);
        foreach ($servi as $value) {
            if ($input["servicio_id"]==$value->id) {
                if ($value->estado==1) {
                    try{
                        $cita=Cita::find($input["id"]);

                        if ($cita==null) {
                            session()->flash('errorE','Cita no encontrada');
                            return redirect("/Cita");
                        }

                        $cita->update([
                            "nombre_Cliente"=>$input["nombre_Cliente"],
                            "servicio_id"=>$input["servicio_id"],
                            "fecha"=>$input["fecha"],
                            "direccion"=>$input["direccion"],
                            "descripcion"=>$input["descripcion"],
                            "precio"=>$input["precio"],
                            
                        ]);
                        session()->flash('echoEd','La cita fue Editada');
                        return redirect("Cita");
                    }catch(\Exception$e){
                        Flash::error($e->getMessage());
                        return redirect("/Cita/Crear");
                    }
                }else{
                    session()->flash('errorEd','La cita  no fue Editada');
                        return redirect("Cita");
                }
            }
        }
    }
    public function updateEstado($id,$estado){
       
        $cita=Cita::find($id);

        if ($cita==null) {
            session()->flash('errorE','Cita no encontrada');
            return redirect("/Cita");
        }
        try {
            $cita->update(["estado"=>$estado]);
            session()->flash('echoE','El estado fue cambiado');
            return redirect("/Cita");
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect("/Cita/Crear");  
        }
    }
}
