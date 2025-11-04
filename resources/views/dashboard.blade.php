<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6 text-purple-800">Panel de Administración</h1>

        <div class="grid grid-cols-3 gap-6">
            <a href="{{ route('peliculas.index') }}" class="bg-purple-700 text-white p-6 rounded-lg shadow hover:bg-purple-800 transition">
                🎬 Gestión de Películas
            </a>
            <a href="{{ route('usuarios.index') }}" class="bg-purple-700 text-white p-6 rounded-lg shadow hover:bg-purple-800 transition">
                👥 Gestión de Usuarios
            </a>
            <a href="{{ route('salas.index') }}" class="bg-purple-700 text-white p-6 rounded-lg shadow hover:bg-purple-800 transition">
                🏛️ Salas
            </a>
        </div>
    </div>
</x-app-layout>

