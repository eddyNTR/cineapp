<x-app-layout>
    <x-alert-scripts />
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4 text-purple-800">Gestión de Salas</h1>

        <a href="{{ route('salas.create') }}" class="bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Nueva Sala</a>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-200 text-purple-900">
                    <th class="p-2">Nombre</th>
                    <th>Capacidad</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salas as $sala)
                    <tr class="border-b border-purple-300 text-center">
                        <td class="p-2">{{ $sala->nombre }}</td>
                        <td>{{ $sala->capacidad }}</td>
                        <td>{{ $sala->tipo }}</td>
                        <td>
                            <a href="{{ route('salas.edit', $sala) }}" class="text-blue-600 hover:underline">Editar</a> |
                            <form action="{{ route('salas.destroy', $sala) }}" method="POST" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:underline" 
                                    onclick="confirmarEliminacion(this.closest('form'), {{ $sala->funciones()->count() > 0 ? 'true' : 'false' }})">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
