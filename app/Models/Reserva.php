<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public function asientos()
    {
    return $this->hasMany(Asiento::class);
    }

}
