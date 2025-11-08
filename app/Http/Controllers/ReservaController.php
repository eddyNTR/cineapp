<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Funcion;
use App\Models\Reserva;
use App\Models\Asiento;
use App\Models\Venta;
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
        // Validar los datos
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'funcion_id' => 'required|exists:funcions,id',
            'asientos' => 'required|string',
            'cantidad_boletos' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'pago' => 'required|in:efectivo,tarjeta'
        ]);

        try {
            // Crear la venta directamente
            $venta = Venta::create([
                'usuario_id' => $request->usuario_id,
                'funcion_id' => $request->funcion_id,
                'asientos' => $request->asientos,
                'cantidad_boletos' => $request->cantidad_boletos,
                'total' => $request->total,
                'pago' => $request->pago
            ]);

            return redirect()
                ->route('cartelera')
                ->with('success', '¡Compra realizada exitosamente!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al procesar la compra. Por favor, intente nuevamente.');
        }
    }

    public function selectSeat(Request $request)
{
        // Obtener la función con sus detalles
        $funcion = Funcion::findOrFail($request->funcion);

        // Obtener los asientos vendidos para esta función
        $asientosVendidos = Venta::where('funcion_id', $funcion->id)
            ->pluck('asientos')
            ->flatMap(function ($asientos) {
                return explode(',', $asientos);
            })
            ->map(function ($asiento) {
                return trim($asiento);
            })
            ->unique()
            ->values()
            ->toArray();

        return view('reservas.seleccionar-asiento', compact('funcion', 'asientosVendidos'));
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