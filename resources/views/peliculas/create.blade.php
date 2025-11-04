<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Agregar Nueva Película</h1>

        <form action="{{ route('peliculas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <input type="text" name="titulo" placeholder="Título" class="w-full border p-2 rounded" required>
            <input type="text" name="genero" placeholder="Género" class="w-full border p-2 rounded" required>
            <input type="number" name="duracion" placeholder="Duración (min)" class="w-full border p-2 rounded" required>
            <textarea name="sinopsis" placeholder="Sinopsis" class="w-full border p-2 rounded" required></textarea>
            <input type="file" name="imagen" class="w-full border p-2 rounded">
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
