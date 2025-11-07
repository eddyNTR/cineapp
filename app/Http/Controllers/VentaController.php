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

        return view('reservas.index', compact('ventas', 'reservas'));
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
        return view('reservas.create', compact('usuarios', 'funciones', 'reservas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'reserva_id' => 'nullable|exists:reservas,id',
            'usuario_id' => 'nullable|exists:users,id',
            'funcion_id' => 'nullable|exists:funcions,id',
            'cantidad_boletos' => 'required|integer|min:1',
            'asientos' => 'required|string',
            'total' => 'required|numeric|min:0',
            'pago' => 'required|in:efectivo,tarjeta',
        ]);

        // Si se envió reserva_id, completar usuario_id y funcion_id desde la reserva
        if (! empty($data['reserva_id'])) {
            $reserva = Reserva::find($data['reserva_id']);
            if ($reserva) {
                $data['usuario_id'] = $reserva->usuario_id;
                $data['funcion_id'] = $reserva->funcion_id;
                // Si no se especificaron asientos, usar el de la reserva
                if (empty($data['asientos'])) {
                    $data['asientos'] = $reserva->asiento;
                }
            }
        }

        // usuario_id y funcion_id son obligatorios ahora que fueron rellenados o enviados
        if (empty($data['usuario_id']) || empty($data['funcion_id'])) {
            return redirect()->back()->withInput()->with('error', 'Debe seleccionar una reserva válida o indicar usuario y función.');
        }

        $venta = Venta::create($data);
        Log::info('Venta creada', ['id' => $venta->id, 'data' => $data]);

        // Si se creó desde una reserva, marcarla como pagada
        if (! empty($data['reserva_id'])) {
            $reserva->estado = 'pagada';
            $reserva->save();
        }

        return redirect()->route('reservas.index')->with('success', 'Reserva confirmada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $reserva)
    {
        $reserva->load(['usuario', 'funcion.pelicula']);
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $reserva)
    {
        $usuarios = User::all();
        $funciones = Funcion::with('pelicula')->get();
        return view('reservas.edit', compact('reserva', 'usuarios', 'funciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $reserva)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'funcion_id' => 'required|exists:funcions,id',
            'cantidad_boletos' => 'required|integer|min:1',
            'asientos' => 'required|string',
            'total' => 'required|numeric|min:0',
            'pago' => 'required|in:efectivo,tarjeta',
        ]);

        $updated = $reserva->update($data);
        Log::info('Venta actualizada', ['id' => $reserva->id, 'updated' => $updated, 'data' => $data]);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada con éxito.');
    }
}

