<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function stock(){
        return $this->hasOne(Stock::class);
    }

    public function json(){
        return [
            'id_producto' => $this->id,
            'nombre' => $this->nombre,
            'precio' => $this->precio_venta,
            'observaciones' => $this->observaciones,
            'stock' => $this->stock->existencia,
        ];
    }

    public function reducirStock($cantidad){
        $this->stock->existencia = $this->stock->existencia - $cantidad;
        $this->stock->save();
    }
}
