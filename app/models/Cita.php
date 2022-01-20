<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    public $tabla="citas";
  
    public $fillable=[
        "nombre_Cliente",
        "fecha",
        "horaI",
        "horaF",
        "minutos",
        "direccion",
        "descripcion",
        "precio",
        "estado",
    ];
    public $timestamps = false;
    // public static $rules = [
    //     'nombre_Cliente'=>'required|min:3|max:100|string',
    //     'Servicio_id'=>'required|exists:servicios,id',
    //     'fecha'=>'nullable|date',
    //     'direccion'=>'nullable|string|max:300|min:5',
    //     'descripcion'=>'nullable|string|max:300|min:5',
    //     'precio'=>'required|min:0|max:100000',
    //     'estado'=>'in:1,0',
    // ];
}
