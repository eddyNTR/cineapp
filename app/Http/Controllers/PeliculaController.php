<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return view('peliculas.index', compact('peliculas'));
    }

    public function create()
    {
        return view('peliculas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'genero' => 'required',
            'duracion' => 'required|integer',
            'sinopsis' => 'required',
            'imagen' => 'nullable|image',
        ]);

        Pelicula::create($data);
        return redirect()->route('peliculas.index')->with('success', 'Película registrada correctamente.');
    }

    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', compact('pelicula'));
    }

    public function update(Request $request, Pelicula $pelicula)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'genero' => 'required',
            'duracion' => 'required|integer',
            'sinopsis' => 'required',
        ]);

        $pelicula->update($data);
        return redirect()->route('peliculas.index')->with('success', 'Película actualizada.');
    }

    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return redirect()->route('peliculas.index')->with('success', 'Película eliminada.');
    }
}
