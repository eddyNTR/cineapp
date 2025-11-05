<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelicula_id',
        'sala_id',
        'fecha',
        'hora',
        'precio',
    ];

    public function sala()
{
    return $this->belongsTo(Sala::class);
}

    // Relación inversa: una funcion pertenece a una pelicula
    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }
    // En el modelo Funcion
public function asientos()
{
    return $this->hasMany(Asiento::class);
}

}
