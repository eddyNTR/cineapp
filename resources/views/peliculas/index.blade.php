<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4 text-purple-800">Gestión de Películas</h1>

        <a href="{{ route('peliculas.create') }}" class="bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Nueva Película</a>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-200 text-purple-900">
                    <th class="p-2">Título</th>
                    <th>Género</th>
                    <th>Duración</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peliculas as $pelicula)
                    <tr class="border-b border-purple-300 text-center">
                        <td class="p-2">{{ $pelicula->titulo }}</td>
                        <td>{{ $pelicula->genero }}</td>
                        <td>{{ $pelicula->duracion }} min</td>
                        <td>
                            @if($pelicula->imagen)
                                <img src="{{ asset('storage/'.$pelicula->imagen) }}" class="w-20 mx-auto rounded">
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('peliculas.edit', $pelicula) }}" class="text-blue-600 hover:underline">Editar</a> |
                            <!-- Eliminar con confirmación -->
                            <form action="{{ route('peliculas.destroy', $pelicula) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Confirmación de eliminación
        function confirmDelete() {
            return confirm("¿Estás seguro de que quieres eliminar esta película? Si tiene funciones o ventas asociadas, no podrás eliminarla.");
        }
    </script>
</x-app-layout>
