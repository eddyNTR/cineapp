<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las salas
        $salas = Sala::all();
        
        // Retornar vista con las salas
        return view('salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornar la vista de creación de salas
        return view('salas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'capacidad' => 'required|integer',
            'tipo' => 'required|string',
        ]);

        // Crear una nueva sala
        Sala::create($request->all());

        return redirect()->route('salas.index')->with('success', 'Sala creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        // Mostrar detalles de una sala
        return view('salas.show', compact('sala'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        // Mostrar formulario de edición de una sala
        return view('salas.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'capacidad' => 'required|integer',
            'tipo' => 'required|string',
        ]);

        // Actualizar la sala con los nuevos datos
        $sala->update($request->all());

        return redirect()->route('salas.index')->with('success', 'Sala actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        // Verificar si la sala tiene funciones asociadas
        if ($sala->funciones()->count() > 0) {
            return redirect()->route('salas.index')
                           ->with('error', 'No se puede eliminar la sala porque tiene funciones asociadas. Elimine primero las funciones.');
        }

        // Si no tiene funciones, proceder con la eliminación
        $sala->delete();

        return redirect()->route('salas.index')->with('success', 'Sala eliminada con éxito.');
    }
}
