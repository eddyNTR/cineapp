<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\User;
use App\Models\Sala;
use App\Models\Funcion;
use App\Models\Venta;

class DashboardController extends Controller
{
    public function index()
    {
        // Contadores básicos
        $peliculas = Pelicula::count();
        $usuarios = User::count();
        $salas = Sala::count();
        $funciones = Funcion::count();
        $ventas = Venta::count();

        // Retornar la vista con los datos
        return view('dashboard.index', compact('peliculas', 'usuarios', 'salas', 'funciones', 'ventas'));
    }
}
