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
        <!-- Menú Principal -->
        <header class="bg-purple-900 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <a href="{{ route('cartelera') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-200" />
                </a>

                <nav class="space-x-4">
                    <a href="{{ route('cartelera') }}" class="text-lg">Cartelera</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-lg text-white bg-red-600 p-2 rounded-md">Cerrar sesión</button>
                    </form>
                </nav>
            </div>
        </header>

        <!-- Contenido de la Selección de Asientos -->
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl text-white font-semibold mb-6">Selecciona tu asiento</h2>

                <!-- Información de la película -->
                <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $funcion->pelicula->titulo }}</h3>
                    <p class="text-sm text-gray-600">{{ $funcion->pelicula->genero }} • {{ $funcion->pelicula->duracion }} min</p>
                    <p class="text-gray-500 mt-2">{{ $funcion->pelicula->sinopsis }}</p>

                    <!-- Mostrar la imagen de la película -->
                    @if($funcion->pelicula->imagen)
                        <img src="{{ asset('storage/'.$funcion->pelicula->imagen) }}" alt="{{ $funcion->pelicula->titulo }}" class="w-32 h-48 object-cover rounded-lg mt-4">
                    @else
                        <div class="w-32 h-48 bg-gray-300 rounded-lg mt-4 flex items-center justify-center text-white">Sin Imagen</div>
                    @endif
                </div>

                <!-- Selección de Asientos -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Selecciona un asiento</h3>

                    <!-- Formulario de selección de asiento -->
                    <form method="POST" action="{{ route('reservar.store') }}">
                        @csrf
                        <input type="hidden" name="funcion_id" value="{{ $funcion->id }}">
                        <input type="hidden" name="total" id="total" value="">

                        <!-- Aquí mostramos los asientos disponibles -->
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($funcion->asientos as $asiento)
                                <button 
                                    type="button"
                                    class="w-12 h-12 rounded-md {{ $asiento->estado == 'disponible' ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-300 cursor-not-allowed' }} text-white"
                                    {{ $asiento->estado == 'disponible' ? 'onclick="selectAsiento('.$asiento->id.');"' : '' }}
                                    disabled="{{ $asiento->estado != 'disponible' }}"
                                >
                                    {{ $asiento->codigo }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Confirmar selección de asiento -->
                        <div class="mt-6">
                            <button id="confirmar-btn" class="w-full bg-purple-700 text-white py-2 px-4 rounded-md hover:bg-purple-800 transition" disabled>
                                Confirmar Selección
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
