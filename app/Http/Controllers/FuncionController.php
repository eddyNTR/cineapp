<?php

namespace App\Http\Controllers;

use App\Models\Funcion;
use App\Models\Sala;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class FuncionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las funciones
        $funciones = Funcion::with(['pelicula', 'sala'])->get();
        
        // Retornar la vista con las funciones
        return view('funciones.index', compact('funciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las películas y salas disponibles para la creación
        $peliculas = Pelicula::all();
        $salas = Sala::all();
        
        return view('funciones.create', compact('peliculas', 'salas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar la entrada
    $request->validate([
        'pelicula_id' => 'required|exists:peliculas,id',
        'sala_id' => 'required|exists:salas,id',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i',
        'precio' => 'required|numeric',
    ]);

    // Crear una nueva función
    Funcion::create([
        'pelicula_id' => $request->pelicula_id,
        'sala_id' => $request->sala_id,
        'fecha' => $request->fecha,
        'hora' => $request->hora,
        'precio' => $request->precio,
    ]);

    return redirect()->route('funciones.index')->with('success', 'Función creada con éxito.');
}


    /**
     * Display the specified resource.
     */
    public function show(Funcion $funcion)
    {
        return view('funciones.show', compact('funcion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcion $funcion)
    {
        // Obtener las películas y salas disponibles para la edición
        $peliculas = Pelicula::all();
        $salas = Sala::all();
        
        return view('funciones.edit', compact('funcion', 'peliculas', 'salas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcion $funcion)
    {
        $request->validate([
            'pelicula_id' => 'required|exists:peliculas,id',
            'sala_id' => 'required|exists:salas,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric',
        ]);

        // Actualizar la función con los nuevos datos
        $funcion->update($request->all());

        return redirect()->route('funciones.index')->with('success', 'Función actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcion $funcion)
{
    // Verificar si la función tiene asientos o reservas asociadas
    if ($funcion->asientos()->exists()) {
        return redirect()->route('funciones.index')->with('error', 'No se puede eliminar la función, ya que tiene asientos reservados.');
    }

    $funcion->delete();

    return redirect()->route('funciones.index')->with('success', 'Función eliminada con éxito.');
}

}
