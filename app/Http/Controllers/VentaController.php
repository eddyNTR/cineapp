<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\User;
use App\Models\Funcion;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['usuario', 'funcion.pelicula'])->orderBy('created_at', 'desc')->get();
        // Mostrar reservas pendientes/confirmadas en la tabla de ventas
        $reservas = Reserva::whereIn('estado', ['pendiente', 'confirmada'])
            ->with(['usuario', 'funcion.pelicula'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ventas.index', compact('ventas', 'reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $funciones = Funcion::with('pelicula')->get();
        // Obtener reservas pendientes para que puedan convertirse en ventas
        $reservas = Reserva::where('estado', 'pendiente')->with(['usuario', 'funcion.pelicula'])->get();
        return view('ventas.create', compact('usuarios', 'funciones', 'reservas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos requeridos
            $data = $request->validate([
                'usuario_id' => 'required|exists:users,id',
                'funcion_id' => 'required|exists:funcions,id',
                'cantidad_boletos' => 'required|integer|min:1',
                'asientos' => 'required|string',
                'total' => 'required|numeric|min:0',
                'pago' => 'required|in:efectivo,tarjeta',
            ]);

            // Crear la venta
            $venta = Venta::create($data);
            Log::info('Venta creada', ['id' => $venta->id, 'data' => $data]);

            return redirect()
                ->route('ventas.show', $venta->id)
                ->with('success', 'Venta registrada exitosamente');

        } catch (\Exception $e) {
            Log::error('Error al crear venta', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Error al procesar la venta. Por favor, intente nuevamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load(['usuario', 'funcion.pelicula']);
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        $usuarios = User::all();
        $funciones = Funcion::with('pelicula')->get();
        return view('ventas.edit', compact('venta', 'usuarios', 'funciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'funcion_id' => 'required|exists:funcions,id',
            'cantidad_boletos' => 'required|integer|min:1',
            'asientos' => 'required|string',
            'total' => 'required|numeric|min:0',
            'pago' => 'required|in:efectivo,tarjeta',
        ]);

        $updated = $venta->update($data);
        Log::info('Venta actualizada', ['id' => $venta->id, 'updated' => $updated, 'data' => $data]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}

