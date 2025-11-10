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
            <input type="text" name="trailer" value="{{ $pelicula->trailer }}" placeholder="ID del video de YouTube (ej: dQw4w9WgXcQ)" class="w-full border p-2 rounded">
            <small class="text-gray-600">Para obtener el ID: abre el video en YouTube, el ID está en la URL después de "v=" o "embed/"</small>
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
