<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CineApp') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-purple-900 font-sans antialiased">

    <div class="flex flex-col min-h-screen">
        <!-- Menú Principal para el Cliente -->
        <header class="bg-purple-900 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <a href="{{ route('landing') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-200" />
                </a>

                <nav class="space-x-4">
                    <a href="{{ route('cartelera') }}" class="text-lg">Cartelera</a>
                    <a href="{{ route('profile.edit') }}" class="text-lg">Mi Perfil</a>
                    <a class="font-semibold">Bienvenido, {{ Auth::user()->name }}</a> <!-- Nombre del usuario -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-lg text-white bg-red-600 p-2 rounded-md">Cerrar sesión</button>
                    </form>
                </nav>
            </div>
        </header>

        <!-- Contenido de la Cartelera -->
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl text-white font-semibold mb-6">Cartelera de Películas</h2>

                @foreach($peliculas as $pelicula)
                    <div class="bg-white rounded-lg shadow-lg p-4 mb-6">
                        <div class="flex">
                            @if($pelicula->imagen)
                                <img src="{{ asset('storage/'.$pelicula->imagen) }}" alt="{{ $pelicula->titulo }}" class="w-32 h-48 object-cover rounded-lg mr-6">
                            @else
                                <div class="w-32 h-48 bg-gray-300 rounded-lg mr-6 flex items-center justify-center text-white">Sin Imagen</div>
                            @endif

                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $pelicula->titulo }}</h3>
                                <p class="text-sm text-gray-600">{{ $pelicula->genero }} • {{ $pelicula->duracion }} min</p>
                                <p class="text-gray-500 mt-2">{{ $pelicula->sinopsis }}</p>

                                <!-- Mostrar las funciones de la película -->
                                @if($pelicula->funciones->isNotEmpty())
                                    <div class="mt-4 space-y-2">
                                        @foreach($pelicula->funciones as $funcion)
                                            <div class="bg-purple-100 p-3 rounded-md">
                                                <p class="text-purple-800 font-semibold">Horario: {{ $funcion->fecha }} - {{ $funcion->hora }}</p>
                                                <p class="text-purple-800 font-semibold">Precio: {{ $funcion->precio }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-red-500 mt-2">No hay funciones disponibles para esta película.</p>
                                @endif

                                <!-- Botón para comprar entradas -->
                                <div class="mt-4">
                                    <a href="{{ route('reservar', ['pelicula' => $pelicula->id]) }}" class="w-full text-center bg-purple-700 text-white py-2 px-4 rounded-md hover:bg-purple-800 transition">
                                        Comprar Entradas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Mensaje cuando no hay películas -->
                @if($peliculas->isEmpty())
                    <p class="text-white text-center w-full">No hay películas disponibles en la cartelera.</p>
                @endif
            </div>
        </main>
    </div>

</body>
</html>
