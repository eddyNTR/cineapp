<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    
    // Relación: una reserva pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación: una reserva pertenece a una función
    public function funcion()
    {
        return $this->belongsTo(Funcion::class, 'funcion_id');
    }

}
