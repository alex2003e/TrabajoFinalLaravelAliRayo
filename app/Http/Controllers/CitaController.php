<?php

namespace App\Http\Controllers;

use App\models\Cita;
use App\models\Servicio;
use App\models\DetalleServicio;
use App\models\detalleproducto;
use App\models\producto;
use DataTables;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class CitaController extends Controller
{
public function index(){
        $cita=Cita::all();
        $servicios=Servicio::all();
        $producto = Producto::all();
        

       
        return view('Cita.indexCita',compact("cita","servicios","producto"));
}   
public function listar(){
        $citas = Cita::all();

        $citaN = [];

        foreach ($citas as  $value) {
                            
            $citaN[]=[
                "id"=>$value->id,
                "start"=>$value->fecha." ".$value->horaI,
                "hora"=>$value->horaI,
                "end"=>$value->fecha." ".$value->horaF,
                "title"=>$value->nombre_Cliente,
                "backgroundColor"=>$value->estado ==1 ? "#008000":"#FF0000",
                "textColor"=>"#ffffff",
                "borderColor"=>$value->estado ==1 ? "#008000":"#FF0000",
                "extendedProps"=>[
                    "idC"=>$value->id,
                    "estado"=>$value->estado
                ]
            ];
        }
    

        return response()->json($citaN);

}
public function crear(){
        $servicios=Servicio::all();
 
        $producto=Producto::all();
      
        
        return view('Cita.CrearCita',compact('servicios','producto'));
}
public function validFecha($fecha,$horaI,$horaF){
            $cita= DB::table("citas")
            ->select("*")
            ->whereDate('fecha', $fecha)
            ->whereBetween('horaI', [$horaI,$horaF])
            ->whereBetween('horaF', [$horaI,$horaF])
            
            ->first();

            if ($cita == null) {
                return true ;
            }else{
                
                if ($cita->estado != 1) {
                    return true ;
                }else{
                    return false;
                }
                
            }
            
            
}
public function save(Request $request){
       
        $input=$request->all();
        
        $servi= Servicio::all();
        $request->validate([
        'nombre_Cliente'=>'required|min:3|max:100|string',
        'minutos'=>'required|numeric',
        'direccion'=>'nullable|string|max:300',
        'descripcion'=>'nullable|string|max:300',
        'precio'=>'required|min:0|max:100000',
        'estado'=>'in:1,0',
        ]);
        
      if ($this->validFecha($input["fecha"],$input["horaI"],$input["horaF"])) {
        foreach ($servi as $value) {
            if ($input["servicio_id"]==$value->id) {
                if ($value->estado==1) {
                   
                    try{
                         DB::beginTransaction();
                         
                            $cita=Cita::create([
                                "nombre_Cliente"=>$input["nombre_Cliente"],
                                "fecha"=>$input["fecha"],
                                "horaI"=>$input["horaI"],
                                "horaF"=>$input["horaF"],
                                "minutos"=>$input["minutos"],
                                "direccion"=>$input["direccion"],
                                "descripcion"=>$input["descripcion"],
                                "precio"=>$this->precio($input["servicios_id"],$input["productos_id"],$input["Cantidad_id"]),
                                "estado"=>1,
                                
                            ]);
                            
                            $servicios_id=$input["servicios_id"];
                            foreach ($servicios_id as $value) {
                            detalleservicio::create([
                                    "servicio_id"=>$value,
                                    "cita_id"=>$cita->id,
                            ]);
                            }
                            
                            $producto_id=$input["productos_id"];                      
                            foreach ($producto_id as $key => $value) {
                                
                                $productos=Producto::find($value);
                                if ($productos->cantidad>=$input["Cantidad_id"][$key]) {
                                    
                                    detalleproducto::create([
                                        "producto_id"=>$value,
                                        "citas_id"=>$cita->id,
                                        "cantidad"=> $input["Cantidad_id"][$key],
                                ]);
                                
                                    $productos->update(["cantidad"=>$productos->cantidad -$input["Cantidad_id"][$key]]);
                            
                                }else {
                                    DB::rollBack();
                                    session()->flash('errorC','La cita  no fue Agregada');
                                    return redirect("Cita");
                                }
                            }
                            
                                DB::commit();
                               
                                return response()->json(["ok"=>true]);
                        }catch(\Exception $e){

                            DB::rollBack();
                            Flash::error($e->getMessage());
                            return redirect("/Cita/Crear");
                        }
                }else{
                    
                    return response()->json(["ok"=>false]);
                }
            }
        }
      }else{
        dd($this->validFecha($input["fecha"],$input["horaI"],$input["horaF"]));
        return response()->json(["ok"=>false]);
      }
        


}
public function precio($id,$productos,$cantidad){
        $precio=0;
        foreach ($id as  $value) {
            $servis=Servicio::find($value);
            $precio += $servis->precio;
        }
        foreach ($productos as $key=> $item) {
            $producto=Producto::find($item);

            $precio += $producto->precios*$cantidad[$key];
        }
        return $precio;
}
public function editar($id){
        $cita=Cita::find($id);
        $servicios=Servicio::all();
        $producto=Producto::all();
        $detalleS=DetalleServicio::all();
        $detalleP=detalleproducto::all();
        $prec =0;
        $precS=0;
        $idS = 0;
        $id =0;
        if ($cita==null) {
            session()->flash('errorE','Cita no encontrada');
            return redirect("/Cita");
        }
            foreach ($servicios as $key){
                foreach ($detalleS as $ds){
                    if ($cita->id == $ds->cita_id){
                        if ($key->estado==1){
                            if ($key->id ==$ds->servicio_id){
                                
                                $prec = $key->precio + $prec;
                                
                                $idS = $ds->id;
                            
                                          
                            }
                        }
                    }    
                }
            }
            foreach ($producto as $keyp){
                foreach ($detalleP as $dp){
                    if ($cita->id == $dp->citas_id){
                        
                        if ($keyp->id == $dp->producto_id){
                               
                             $precS = ($keyp->precios*$dp->cantidad)+$precS;
                            
                                           
                        }
                        
                    }    
                }
            }
          
        return view("Cita.editarCita",compact("cita","servicios","producto","detalleS","detalleP","idS","prec","precS"));
}
public function detalle($id){
        $citas=Cita::find($id);
        $cita=Cita::all();
        $ids=$id;
        $servicios=Servicio::all();
        $producto=Producto::all();
        $detalleS=DetalleServicio::all();
        $detalleP=detalleproducto::all();
        $horaI =null;
        $horaF = null;
        if ($citas==null) {
            session()->flash('errorE','Cita no encontrada');
            return redirect("/Cita");
        }
        foreach ($cita as $key => $value) {
            $horaI = \Carbon\Carbon::parse($value->horaI)->format('h:i A');
            $horaF = \Carbon\Carbon::parse($value->horaF)->format('h:i A');
        }
        return view("Cita.detalleCita",compact("citas","servicios","producto","detalleS","detalleP","ids","horaF","horaI"));
}
public function update(Request $request){
        $input=$request->all();
        $fechas=Cita::all();
        $servi= Servicio::all();
       
        $servicios= $input["servicios_id"];
        $request->validate([ 
            
        'nombre_Cliente'=>'required|min:3|max:100|string',
        'minutos'=>'required|numeric',
        'direccion'=>'nullable|string|max:300|min:5',
        'descripcion'=>'nullable|string|max:300|min:5',
        'precio'=>'required|min:0|max:100000',
        'estado'=>'in:1,0',
        ]);
        
        // dd($input);
        // if ($input["horaI"] == $fechas->horaI) {
            if ($this->validFecha($input["fecha"],$input["horaI"],$input["horaF"])) {
                foreach ($servi as $value) {
                    foreach ($servicios as $key => $item) {
                        
                        if ($item == $value->id) {
                        
                            if ($value->estado==1) {
                                try{
                                    DB::beginTransaction();
                                    $cita=Cita::find($input["id"]);
                                        
                                    if ($cita==null) {
                                        session()->flash('errorE','Cita no encontrada');
                                        return redirect("/Cita");
                                    }
            
                                    $cita->update([
                                        "nombre_Cliente"=>$input["nombre_Cliente"],
                                        "fecha"=>$input["fecha"],
                                        "horaI"=>$input["horaI"],
                                        "horaF"=>$input["horaF"],
                                        "minutos"=>$input["minutos"],
                                        "direccion"=>$input["direccion"],
                                        "descripcion"=>$input["descripcion"],
                                        "precio"=>$this->precio($input["servicios_id"],$input["productos_id"],$input["Cantidad_id"]),
                                        
                                    ]);
                                    
                                    
                                    
                                    
                                        DB::commit();
                                    
                                        return response()->json(["ok"=>true]);
                                }catch(\Exception $e){
        
                                    DB::rollBack();
                                    Flash::error($e->getMessage());
                                    return redirect("/Cita/Editar/");
                                }
                            }else{
                    
                                return response()->json(["oks"=>false]);
                            }
                        }
                    }
                    
                }
            }else{
                dd($this->validFecha($input["fecha"],$input["horaI"],$input["horaF"]));
                return response()->json(["ok"=>false]);
            }
      
        
}
public function updateS(Request $request){
        $input=$request->all();
        $des = DetalleServicio::all();
       
       
        
        try {
            DB::beginTransaction();
            $cita=Cita::find($input["id"]);
            if ($cita==null) {
                session()->flash('errorE','Cita no encontrada');
                return redirect("/Cita");
            }
           foreach ($des as $value) {
                if ($value->cliente_id == $input["id"]) {
                    $ds = DetalleServicio::find($value->id);
                    if ($ds==null) {
                        session()->flash('errorE','Cita no encontrada');
                        
                        return response()->json(["ok"=>false]);
                    }
                    $servicios_id=$input["servicios_id"];
                    foreach ($servicios_id as $value) {
                        $ds->update([
                            "servicio_id"=>$value,
                            "cita_id"=>$cita->id,
                        ]); 
       
                    }
                    
                }else{
                    return response()->json(["ok"=>false]);
                }
            
           }
            
            
            DB::commit();
                                   
            return response()->json(["ok"=>true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Flash::error($e->getMessage());
            return response()->json(["ok"=>false]);
        }
}
public function updateP(Request $request){
    $input=$request->all();
    $dep = DetalleProducto::all();
   
   
    
    try {
        DB::beginTransaction();
        $cita=Cita::find($input["id"]);
        if ($cita==null) {
            session()->flash('errorE','Cita no encontrada');
            return redirect("/Cita");
        }
       foreach ($dep as $value) {
            if ($value->cliente_id == $input["id"]) {
                $dp = DetalleProducto::find($value->id);
                if ($dp==null) {
                    session()->flash('errorE','Cita no encontrada');
                    
                    return response()->json(["ok"=>false]);
                }
                $producto_id=$input["productos_id"];                      
                foreach ($producto_id as $key => $value) {
                    
                    $productos=Producto::find($value);
                    if ($productos->cantidad>=$input["Cantidad_id"][$key]) {
                        
                        $dp->update([
                            "producto_id"=>$value,
                            "citas_id"=>$cita->id,
                            "cantidad"=> $input["Cantidad_id"][$key],
                    ]);
                    
                        $productos->update(["cantidad"=>$productos->cantidad -$input["Cantidad_id"][$key]]);
                
                    }else {
                        DB::rollBack();
                        session()->flash('errorC','La cita  no fue Agregada');
                        return redirect("Cita");
                    }
                }
                
            }else{
                return response()->json(["ok"=>false]);
            }
        
       }
        
        
        DB::commit();
                               
        return response()->json(["ok"=>true]);
    } catch (\Exception $e) {
        DB::rollBack();
        Flash::error($e->getMessage());
        return response()->json(["ok"=>false]);
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
