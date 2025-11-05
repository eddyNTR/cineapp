<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar Función</h1>

        <form action="{{ route('funciones.update', $funcion) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <label for="pelicula_id" class="block text-lg font-semibold">Película</label>
            <select name="pelicula_id" id="pelicula_id" class="w-full border p-2 rounded" required>
                <option value="{{ $funcion->pelicula_id }}">{{ $funcion->pelicula->titulo }}</option>
                @foreach($peliculas as $pelicula)
                    <option value="{{ $pelicula->id }}">{{ $pelicula->titulo }}</option>
                @endforeach
            </select>

            <label for="sala_id" class="block text-lg font-semibold">Sala</label>
            <select name="sala_id" id="sala_id" class="w-full border p-2 rounded" required>
                <option value="{{ $funcion->sala_id }}">{{ $funcion->sala->nombre }}</option>
                @foreach($salas as $sala)
                    <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                @endforeach
            </select>

            <label for="fecha" class="block text-lg font-semibold">Fecha</label>
            <input type="date" name="fecha" value="{{ $funcion->fecha }}" class="w-full border p-2 rounded" required>

            <label for="hora" class="block text-lg font-semibold">Hora</label>
            <input type="time" name="hora" value="{{ $funcion->hora }}" class="w-full border p-2 rounded" required>

            <label for="precio" class="block text-lg font-semibold">Precio</label>
            <input type="number" name="precio" value="{{ $funcion->precio }}" class="w-full border p-2 rounded" required>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
