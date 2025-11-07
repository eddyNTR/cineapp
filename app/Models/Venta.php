<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'usuario_id',
        'funcion_id',
        'reserva_id',
        'cantidad_boletos',
        'asientos',
        'total',
        'pago',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function funcion()
    {
        return $this->belongsTo(Funcion::class, 'funcion_id');
    }
}
