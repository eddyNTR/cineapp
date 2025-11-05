<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CineApp') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-purple-900 text-white flex flex-col p-4">
            <!-- Logo o ícono -->
            <div class="flex items-center justify-center mb-10">
                <div class="w-16 h-16 bg-gray-300 rounded-full"></div>
            </div>

            <!-- Menú -->
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('dashboard') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-purple-700' : '' }}">Dashboard</a>
                <a href="{{ route('peliculas.index') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('peliculas.*') ? 'bg-purple-700' : '' }}">Películas</a>
                <a href="{{ route('funciones.index') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('funciones.*') ? 'bg-purple-700' : '' }}">Funciones</a>
                <a href="{{ route('ventas.index') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('ventas.*') ? 'bg-purple-700' : '' }}">Ventas</a>
                <a href="{{ route('salas.index') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('salas.*') ? 'bg-purple-700' : '' }}">Salas</a>
                <a href="{{ route('usuarios.index') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('usuarios.*') ? 'bg-purple-700' : '' }}">Usuarios</a>
                <a href="{{ route('profile.edit') }}" class="font-bold hover:bg-purple-700 px-4 py-2 rounded-md {{ request()->routeIs('profile.*') ? 'bg-purple-700' : '' }}">Perfil</a>
            </nav>

            <!-- Rol del usuario -->
            <div class="mb-6 text-white mt-auto p-4 bg-purple-800 rounded-md">
                <p class="font-semibold">Rol: {{ Auth::user()->role }}</p>
            </div>

            <!-- Cerrar sesión -->
            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="w-full text-left font-bold hover:bg-red-700 bg-red-600 px-4 py-2 rounded-md mt-6">
                    Cerrar Sesión
                </button>
            </form>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1 p-8 bg-gray-50 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

</body>
</html>

