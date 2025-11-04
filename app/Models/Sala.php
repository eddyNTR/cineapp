<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    public function funciones()
{
    return $this->hasMany(Funcion::class);
}
}
