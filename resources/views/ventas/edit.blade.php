<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar Venta</h1>

        <form action="{{ route('ventas.update', $venta->id) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="w-full border p-2 rounded" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $venta->usuario_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }} ({{ $usuario->email }})</option>
                @endforeach
            </select>

            <label for="funcion_id">Función</label>
            <select name="funcion_id" id="funcion_id" class="w-full border p-2 rounded" required>
                @foreach($funciones as $funcion)
                    <option value="{{ $funcion->id }}" {{ $venta->funcion_id == $funcion->id ? 'selected' : '' }}>{{ $funcion->pelicula->titulo }} — {{ $funcion->fecha }} {{ $funcion->hora }} (Sala: {{ $funcion->sala->nombre ?? '' }})</option>
                @endforeach
            </select>

            <label for="cantidad_boletos">Cantidad de boletos</label>
            <input type="number" name="cantidad_boletos" value="{{ old('cantidad_boletos', $venta->cantidad_boletos) }}" min="1" class="w-full border p-2 rounded" required>

            <label for="total">Total</label>
            <input type="number" name="total" step="0.01" value="{{ old('total', $venta->total) }}" class="w-full border p-2 rounded" required>

            <label for="pago">Método de pago</label>
            <select name="pago" class="w-full border p-2 rounded" required>
                <option value="efectivo" {{ $venta->pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="tarjeta" {{ $venta->pago == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
