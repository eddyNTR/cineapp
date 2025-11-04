<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;

class LandingController extends Controller
{
    public function index()
    {
        // Obtiene todas las películas disponibles
        $peliculas = Pelicula::all();

        // Muestra la vista landing con los datos
        return view('landing.index', compact('peliculas'));
    }
}
