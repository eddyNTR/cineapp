<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'genero',
        'duracion',
        'sinopsis',
        'imagen',
    ];

    // Relación con el modelo Funcion
    public function funciones()
    {
        return $this->hasMany(Funcion::class);
    }
}
