<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class detalleproducto extends Model
{
    public $tabla="detalleproductos";
  
    public $fillable=[
        "producto_id",
        "citas_id",
        "cantidad",

    ];
    public $timestamps = false;
}
