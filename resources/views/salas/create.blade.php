<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Agregar Nueva Sala</h1>

        <form action="{{ route('salas.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="nombre" placeholder="Nombre de la sala" class="w-full border p-2 rounded" required>
            <input type="number" name="capacidad" placeholder="Capacidad" class="w-full border p-2 rounded" required>
            <input type="text" name="tipo" placeholder="Tipo de sala" class="w-full border p-2 rounded" required>
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
