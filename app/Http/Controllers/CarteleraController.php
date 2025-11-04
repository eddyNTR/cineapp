<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;

class CarteleraController extends Controller
{
    // Método para mostrar las películas en la cartelera
    public function index()
    {
        // Obtener las películas con sus respectivas funciones
        $peliculas = Pelicula::with('funciones')->get();

        // Pasar las películas a la vista cartelera
        return view('cartelera', compact('peliculas'));
    }
}
