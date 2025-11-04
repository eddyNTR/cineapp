<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;

class Asiento extends Model
{
    use HasFactory;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo',   // Ejemplo de código del asiento
        'estado',   // Estado (disponible, reservado, etc.)
        'reserva_id', // Relacionado con la reserva
        'funcion_id', // Relacionado con la función (horarios)
    ];

    // Relación inversa con Reserva (un asiento pertenece a una reserva)
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
    public function store(Request $request)
{
    // Crear la reserva
    $reserva = new Reserva();
    $reserva->usuario_id = Auth::id();
    $reserva->funcion_id = $request->funcion_id;
    $reserva->total = $request->total;
    $reserva->save();

    // Asignar los asientos seleccionados a la reserva
    foreach (explode(',', $request->asientos) as $asiento_id) {
        $asiento = Asiento::find($asiento_id);  // Obtener el asiento por ID
        $asiento->estado = 'reservado';  // Cambiar el estado a reservado
        $asiento->reserva_id = $reserva->id;  // Asociar el asiento con la reserva
        $asiento->save();
    }

    return redirect()->route('reserva.confirmacion', ['reserva' => $reserva->id]);
}

}
