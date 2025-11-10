<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva de Entradas - {{ $pelicula->titulo }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-purple-900 font-sans antialiased" style="background-image: url('{{ asset('storage/ciene-app.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <div class="flex flex-col min-h-screen">
        <!-- Menú Principal para el Cliente -->
        <header class="bg-custom-purple text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <div class="flex items-center">
                <a href="{{ route('landing') }}">
                    <img src="{{ asset('storage/palomitas-de-maiz.png') }}" alt="CineApp Icono" class="w-8 h-8 mr-2">
                </a>
                <h1 class="text-[24px] font-bold">CineApp</h1>
                </div>
                <nav class="space-x-4">
                    <a href="{{ route('cartelera') }}" class="text-lg">Cartelera</a>
                    <a class="font-semibold">Bienvenido, {{ Auth::user()->name }}</a> <!-- Nombre del usuario -->
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
                <div class="bg-custom-purple/70 backdrop-blur-sm rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex mb-6">
                        <!-- Imagen de la película -->
                        <img src="{{ asset('storage/'.$pelicula->imagen) }}" alt="{{ $pelicula->titulo }}" class="w-48 h-72 object-cover rounded-lg mr-6">
                        <div class="flex-1">
                            <h2 class="text-[36px] font-bold text-white">{{ $pelicula->titulo }}</h2>
                            <p class="text-[24px] text-gray-300">{{ $pelicula->genero }} • {{ $pelicula->duracion }} min</p>
                            <p class="text-gray-200 mt-2 text-[24px]">{{ $pelicula->sinopsis }}</p>
                            <p class="text-green-400 mt-2">Para todo público</p>
                        </div>
                    </div>

                    <!-- Trailer de YouTube -->
                    @if($pelicula->trailer)
                    <div class="mb-6 flex justify-center">
                        <iframe width="800" height="500" src="https://www.youtube.com/embed/{{ $pelicula->trailer }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    @endif

                    <!-- Mostrar horarios de funciones -->
                    <h3 class="text-2xl text-gray-200 font-semibold mb-4">Horarios disponibles</h3>
                    <div class="space-y-4">
                        @foreach($pelicula->funciones as $funcion)
                            <div class="bg-purple-100 p-4 rounded-md">
                                <p class="text-purple-800 font-semibold text-[17px]">Horario: {{ $funcion->fecha }} - {{ $funcion->hora }} - {{ $funcion->sala->nombre }} - {{ $funcion->sala->tipo }}</p>
                                <p class="text-gray-500 mb-4 text-[17px]">{{ $funcion->precio }} Bs</p>
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
