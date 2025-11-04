@extends('layouts.cartelera-layout')

@section('content')
    <div class="max-w-7xl mx-auto p-6 sm:px-6 lg:px-8">
        <h2 class="text-3xl text-white font-semibold mb-6">Cartelera de Películas</h2>

        <div class="grid grid-cols-1 gap-6">
    @foreach($peliculas as $pelicula)
        <div class="bg-white rounded-lg shadow-lg p-4 mb-6">
            <div class="flex">
                @if($pelicula->imagen)
                    <img src="{{ asset('storage/'.$pelicula->imagen) }}" alt="{{ $pelicula->titulo }}" class="w-48 h-72 object-cover rounded-lg mr-6">
                @else
                    <div class="w-48 h-72 bg-gray-300 rounded-lg flex items-center justify-center text-white mr-6">Sin Imagen</div>
                @endif

                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $pelicula->titulo }}</h3>
                    <p class="text-sm text-gray-600">{{ $pelicula->genero }} • {{ $pelicula->duracion }} min</p>
                    <p class="text-gray-500 mt-2">{{ $pelicula->sinopsis }}</p>

                    <!-- Botón para comprar entradas -->
                    <div class="mt-4">
                        <a href="{{ route('reservar', ['pelicula' => $pelicula->id]) }}" class="w-full text-center bg-purple-700 text-white py-2 px-4 rounded-md hover:bg-purple-800 transition">
                            Comprar Entradas
                        </a>
                    </div>

                    <!-- Mostrar las funciones de la película -->
                    @if($pelicula->funciones->isNotEmpty())
                        <div class="mt-4 space-y-2">
                            @foreach($pelicula->funciones as $funcion)
                                <div class="bg-purple-100 p-3 rounded-md">
                                    <p class="text-purple-800 font-semibold">Horario: {{ $funcion->hora_inicio }} - {{ $funcion->hora_fin }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-red-500 mt-2">No hay funciones disponibles para esta película.</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <!-- Mensaje cuando no hay películas -->
    @if($peliculas->isEmpty())
        <p class="text-white text-center w-full">No hay películas disponibles en la cartelera.</p>
    @endif
</div>

    </div>
@endsection
