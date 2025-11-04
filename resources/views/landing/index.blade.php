<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineApp - Cartelera</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-900 to-purple-700 text-white min-h-screen">

    <nav class="bg-purple-800 py-4 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">🎬 CineApp</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="hover:text-yellow-300">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="hover:text-yellow-300">Registrarse</a>
            </div>
        </div>
    </nav>

    <header class="text-center py-10">
        <h2 class="text-4xl font-bold mb-4">Cartelera de Películas</h2>
        <p class="text-lg text-purple-200">Consulta las películas disponibles y compra tus entradas fácilmente.</p>
    </header>

    <main class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-6 pb-10">
        @forelse ($peliculas as $pelicula)
            <div class="bg-purple-800 rounded-2xl shadow-lg overflow-hidden transition transform hover:scale-105">
                @if($pelicula->imagen)
                    <img src="{{ asset('storage/'.$pelicula->imagen) }}" alt="{{ $pelicula->titulo }}" class="w-full h-64 object-cover">
                @else
                    <div class="bg-purple-900 w-full h-64 flex items-center justify-center text-gray-400">
                        Sin imagen
                    </div>
                @endif
                <div class="p-5">
                    <h3 class="text-2xl font-semibold mb-2">{{ $pelicula->titulo }}</h3>
                    <p class="text-sm text-purple-300 mb-2">{{ $pelicula->genero }} • {{ $pelicula->duracion }} min</p>
                    <p class="text-sm mb-3 text-gray-200">{{ Str::limit($pelicula->sinopsis, 120) }}</p>
                    <a href="#" class="bg-yellow-400 text-purple-900 px-4 py-2 rounded-md font-semibold hover:bg-yellow-500">
                        Comprar entradas
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-200 col-span-3">No hay películas registradas.</p>
        @endforelse
    </main>

    <footer class="bg-purple-950 py-4 text-center text-sm text-purple-300">
        © {{ date('Y') }} CineApp — Proyecto académico.
    </footer>

</body>
</html>

