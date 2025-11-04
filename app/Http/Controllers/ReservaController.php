<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Funcion;
use App\Models\Reserva;
use App\Models\Asiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        // Obtener todas las películas disponibles
        $peliculas = Pelicula::all();

        // Pasar las películas a la vista
        return view('cartelera', compact('peliculas'));
    }

    public function show(Request $request)
    {
        // Obtener la película y sus funciones (horarios) por el ID
        $pelicula = Pelicula::with('funciones')->findOrFail($request->pelicula);

        // Retornar vista con los detalles de la película y horarios
        return view('reservas.reserva', compact('pelicula'));
    }

   public function store(Request $request)
{
    // Crear la reserva
    $reserva = new Reserva();
    $reserva->usuario_id = Auth::id(); // Obtener el ID del usuario logueado
    $reserva->funcion_id = $request->funcion_id;
    $reserva->total = $request->total; // Puedes calcular el total basándote en la cantidad de asientos
    $reserva->save();

    // Asignar los asientos seleccionados a la reserva
    foreach (explode(',', $request->asientos_seleccionados) as $asiento_id) {
        $asiento = Asiento::find($asiento_id);
        $asiento->estado = 'reservado';
        $asiento->reserva_id = $reserva->id;
        $asiento->save();
    }

    // Redirigir a una página de confirmación
    return redirect()->route('reserva.confirmacion', ['reserva' => $reserva->id]);
}

    public function selectSeat(Request $request)
{
    // Obtener la función con sus detalles
    $funcion = Funcion::findOrFail($request->funcion);

    // Obtener los asientos disponibles para esta función
    $asientos = Asiento::where('funcion_id', $funcion->id)
                       ->where('estado', 'disponible')
                       ->get();

    return view('reservas.seleccionar-asiento', compact('funcion', 'asientos'));
}

public function showFunciones($peliculaId)
{
    // Obtener la película y sus funciones
    $pelicula = Pelicula::findOrFail($peliculaId);

    // Obtener las funciones para esa película
    $funciones = $pelicula->funciones;

    return view('seleccionar-funcion', compact('pelicula', 'funciones'));
}
}