<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    public $tabla="productos";
  
    public $fillable=[
        "nombre_Producto",
        "cantidad",
        "precios",

    ];
    
    public $timestamps = false;
}
