<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar Película</h1>

        <form action="{{ route('peliculas.update', $pelicula) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            @method('PUT')
            <input type="text" name="titulo" value="{{ $pelicula->titulo }}" class="w-full border p-2 rounded" required>
            <input type="text" name="genero" value="{{ $pelicula->genero }}" class="w-full border p-2 rounded" required>
            <input type="number" name="duracion" value="{{ $pelicula->duracion }}" class="w-full border p-2 rounded" required>
            <textarea name="sinopsis" class="w-full border p-2 rounded" required>{{ $pelicula->sinopsis }}</textarea>
            <input type="file" name="imagen" class="w-full border p-2 rounded">
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
