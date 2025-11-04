<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva de Entradas - {{ $pelicula->titulo }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-purple-900 font-sans antialiased">

    <div class="flex flex-col min-h-screen">
        <!-- Menú Principal para el Cliente -->
        <header class="bg-purple-900 text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <a href="{{ route('cartelera') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-200" />
                </a>
                <nav class="space-x-4">
                    <a href="{{ route('cartelera') }}" class="text-lg">Cartelera</a>
                    <a href="{{ route('profile.edit') }}" class="text-lg">Mi Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-lg text-white bg-red-600 p-2 rounded-md">Cerrar sesión</button>
                    </form>
                </nav>
            </div>
        </header>

        <!-- Contenido de la Reserva -->
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Mostrar la información de la película -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex mb-6">
                        <!-- Imagen de la película -->
                        <img src="{{ asset('storage/'.$pelicula->imagen) }}" alt="{{ $pelicula->titulo }}" class="w-48 h-72 object-cover rounded-lg mr-6">
                        <div class="flex-1">
                            <h2 class="text-3xl font-bold text-gray-900">{{ $pelicula->titulo }}</h2>
                            <p class="text-sm text-gray-600">{{ $pelicula->genero }} • {{ $pelicula->duracion }} min</p>
                            <p class="text-gray-500 mt-2">{{ $pelicula->sinopsis }}</p>
                            <p class="text-green-500 mt-2">Para todo público</p>
                        </div>
                    </div>

                    <!-- Trailer de YouTube -->
                    <div class="mb-6">
                        <iframe class="w-full h-72" src="https://www.youtube.com/embed/{{ $pelicula->trailer }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                    <!-- Mostrar horarios de funciones -->
                    <h3 class="text-2xl text-gray-800 font-semibold mb-4">Horarios disponibles</h3>
                    <div class="space-y-4">
                        @foreach($pelicula->funciones as $funcion)
                            <div class="bg-purple-100 p-4 rounded-md">
                                <p class="text-purple-800 font-semibold">Horario: {{ $funcion->fecha }} - {{ $funcion->hora }}</p>
                                <p class="text-gray-500 mb-4">{{ $funcion->precio }} Bs</p>
                                <a href="{{ route('asiento', ['funcion' => $funcion->id]) }}" class="w-full text-center bg-purple-700 text-white py-2 px-4 rounded-md hover:bg-purple-800 transition">Continuar</a>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
