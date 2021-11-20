<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    public function producto(){
        return $this->hasOne(Producto::class);
    }

    public function venta(){
        return $this->belongsTo(Venta::class);
    }
}
