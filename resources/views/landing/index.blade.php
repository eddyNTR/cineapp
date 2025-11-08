<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineApp - Cartelera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-white min-h-screen" style="background-image: url('{{ asset('storage/ciene-app.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <nav class="bg-custom-purple py-4 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <!-- Contenedor flex para el logo y el texto -->
            <div class="flex items-center">
                <!-- Icono a la izquierda de CineApp -->
                <img src="{{ asset('storage/palomitas-de-maiz.png') }}" alt="CineApp Icono" class="w-8 h-8 mr-2">
                <h1 class="text-2xl font-bold">CineApp</h1>
            </div>

            <div class="space-x-4 flex justify-end">
                <a href="{{ route('register') }}" class="hover:text-yellow-300">Registrarse</a>
                <a href="{{ route('login') }}" class="hover:text-yellow-300 flex items-center">
                    Iniciar sesión
                    <img src="{{ asset('storage/acceso.png') }}" alt="Ícono de entradas" class="w-6 h-6 ml-2">
                </a>
            </div>
        </div>
    </nav>

    <header class="text-center py-10">
        <h2 class="text-4xl font-bold mb-4">Cartelera de Películas</h2>
        <p class="text-lg text-purple-200">Consulta las películas disponibles y compra tus entradas fácilmente.</p>
    </header>

    <main class="max-w-8xl mx-auto px-6 pb-10">
        @forelse ($peliculas as $pelicula)
            <div class="rounded-2xl shadow-lg overflow-hidden transition transform hover:scale-105 w-[80%] mx-auto flex mb-[56px]">
                @if($pelicula->imagen)
                    <img src="{{ asset('storage/'.$pelicula->imagen) }}" alt="{{ $pelicula->titulo }}" class="w-[300px] h-[450px] object-cover">
                @else
                    <div class="bg-custom-purple w-full h-64 flex items-center justify-center text-gray-400">
                        Sin imagen
                    </div>
                @endif
                <div class="pl-[56px] pb-[24px] flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-[42px] font-semibold mb-2">{{ $pelicula->titulo }}</h3>
                        <p class="text-[24px] text-purple-300 mb-2">{{ $pelicula->genero }} • {{ $pelicula->duracion }} min</p>
                        <p class="text-[24px] mb-3 text-gray-200">{{ Str::limit($pelicula->sinopsis, 120) }}</p>
                    </div>
                    <a href="{{ auth()->check() ? route('cartelera') : route('login') }}"
                        class="bg-custom-purple text-white text-[24px] px-4 py-2 rounded-md font-semibold hover:bg-purple-600 mx-auto mt-4 flex items-center">
                        Comprar entradas
                        <img src="{{ asset('storage/venta.png') }}" alt="Ícono de entradas" class="w-6 h-6 ml-2">
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-200">No hay películas registradas.</p>
        @endforelse
    </main>

    <footer class="bg-purple-950 py-4 text-center text-sm text-purple-300">
        © {{ date('Y') }} CineApp — Proyecto académico.
    </footer>

</body>
</html>



