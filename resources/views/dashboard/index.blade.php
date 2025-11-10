<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6 text-purple-800"> Panel de Administración</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-purple-700 text-white rounded-lg p-6 shadow-lg text-center">
                <h2 class="text-4xl font-bold">{{ $peliculas }}</h2>
                <p class="text-lg">Películas</p>
            </div>
            <div class="bg-purple-700 text-white rounded-lg p-6 shadow-lg text-center">
                <h2 class="text-4xl font-bold">{{ $usuarios }}</h2>
                <p class="text-lg">Usuarios</p>
            </div>
            <div class="bg-purple-700 text-white rounded-lg p-6 shadow-lg text-center">
                <h2 class="text-4xl font-bold">{{ $salas }}</h2>
                <p class="text-lg">Salas</p>
            </div>
            <div class="bg-purple-700 text-white rounded-lg p-6 shadow-lg text-center">
                <h2 class="text-4xl font-bold">{{ $funciones }}</h2>
                <p class="text-lg">Funciones</p>
            </div>
            <div class="bg-purple-700 text-white rounded-lg p-6 shadow-lg text-center">
                <h2 class="text-4xl font-bold">{{ $ventas }}</h2>
                <p class="text-lg">Ventas</p>
            </div>
        </div>

        <h2 class="text-2xl font-semibold mb-4 text-purple-800">Gestión rápida</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('peliculas.index') }}" class="bg-purple-800 text-[24px] text-white p-6 rounded-lg shadow-lg text-center hover:bg-purple-900 transition">
                 Gestionar Películas
            </a>
            <a href="{{ route('usuarios.index') }}" class="bg-purple-800 text-[24px] text-white p-6 rounded-lg shadow-lg text-center hover:bg-purple-900 transition">
                 Gestionar Usuarios
            </a>
            <a href="{{ route('salas.index') }}" class="bg-purple-800 text-[24px] text-white p-6 rounded-lg shadow-lg text-center hover:bg-purple-900 transition">
                 Gestionar Salas
            </a>
            <a href="{{ route('funciones.index') }}" class="bg-purple-800  text-[24px] text-white p-6 rounded-lg shadow-lg text-center hover:bg-purple-900 transition">
                 Gestionar Funciones
            </a>
            <a href="{{ route('ventas.index') }}" class="bg-purple-800 text-[24px] text-white p-6 rounded-lg shadow-lg text-center hover:bg-purple-900 transition">
                 Gestionar Ventas
            </a>
        </div>
    </div>
</x-app-layout>
