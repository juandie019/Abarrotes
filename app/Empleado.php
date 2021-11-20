<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function direccion(){
        return $this->hasOne(Direccion::class);
    }
}
