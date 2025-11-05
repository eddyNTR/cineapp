<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4 text-purple-800">Gestión de Funciones</h1>

        <!-- Mensajes de éxito y error -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('funciones.create') }}" class="bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Nueva Función</a>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-200 text-purple-900">
                    <th class="p-2">Película</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Sala</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($funciones as $funcion)
                    <tr class="border-b border-purple-300 text-center">
                        <td class="p-2">{{ $funcion->pelicula->titulo }}</td>
                        <td>{{ $funcion->fecha }}</td>
                        <td>{{ $funcion->hora }}</td>
                        <td>{{ $funcion->sala->nombre }}</td>
                        <td>{{ $funcion->precio }} Bs</td>
                        <td>
                            <a href="{{ route('funciones.edit', $funcion) }}" class="text-blue-600 hover:underline">Editar</a> |
                            <form action="{{ route('funciones.destroy', $funcion) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
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
        // Función de confirmación antes de eliminar
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar esta función?');
        }
    </script>
</x-app-layout>

