<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function detalleVentas(){
        return $this->hasMany(DetalleVenta::class);
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    public function subTotal(){
        $detalles = $this->detalleVentas;
        $subTotal =  0;
        foreach($detalles as $detalle){
          $subTotal += $detalle->costo * $detalle->articulos;
        }

        return $subTotal;
    }

    public function total(){
        $subtotal = $this->subTotal();

        return $subtotal + ($subtotal * $this->iva);
    }
}
