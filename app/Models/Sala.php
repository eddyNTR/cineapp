<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'capacidad', 'tipo'
    ];

    // Relación: una sala tiene muchas funciones
    public function funciones()
    {
        return $this->hasMany(Funcion::class);
    }
}
