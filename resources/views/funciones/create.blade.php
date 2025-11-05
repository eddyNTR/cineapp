<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Agregar Nueva Función</h1>

        <form action="{{ route('funciones.store') }}" method="POST">
    @csrf
    <label for="pelicula_id">Película</label>
    <select name="pelicula_id" id="pelicula_id" class="w-full border p-2 rounded" required>
        @foreach ($peliculas as $pelicula)
            <option value="{{ $pelicula->id }}">{{ $pelicula->titulo }}</option>
        @endforeach
    </select>

    <label for="sala_id">Sala</label>
    <select name="sala_id" id="sala_id" class="w-full border p-2 rounded" required>
        @foreach ($salas as $sala)
            <option value="{{ $sala->id }}">{{ $sala->nombre }} - {{ $sala->capacidad }} asientos</option>
        @endforeach
    </select>

    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" class="w-full border p-2 rounded" required>

    <label for="hora">Hora</label>
    <input type="time" name="hora" class="w-full border p-2 rounded" required>

    <label for="precio">Precio</label>
    <input type="number" name="precio" step="0.01" class="w-full border p-2 rounded" required>

    <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
</form>

    </div>
</x-app-layout>

