<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar Sala</h1>

        <form action="{{ route('salas.update', $sala) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <input type="text" name="nombre" value="{{ $sala->nombre }}" class="w-full border p-2 rounded" required>
            <input type="number" name="capacidad" value="{{ $sala->capacidad }}" class="w-full border p-2 rounded" required>
            <input type="text" name="tipo" value="{{ $sala->tipo }}" class="w-full border p-2 rounded" required>
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
