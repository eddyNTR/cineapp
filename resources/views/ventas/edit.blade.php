<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar Venta</h1>

        <form action="{{ route('ventas.update', $venta->id) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="w-full border p-2 rounded" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $venta->usuario_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }} ({{ $usuario->email }})</option>
                @endforeach
            </select>

            <label for="funcion_id">Función</label>
            <select name="funcion_id" id="funcion_id" class="w-full border p-2 rounded" required>
                @foreach($funciones as $funcion)
                    <option value="{{ $funcion->id }}" 
                            data-precio="{{ $funcion->precio }}"
                            {{ $venta->funcion_id == $funcion->id ? 'selected' : '' }}>
                        {{ $funcion->pelicula->titulo }} — {{ $funcion->fecha }} {{ $funcion->hora }} 
                        (Sala: {{ $funcion->sala->nombre ?? '' }}) - ${{ number_format($funcion->precio, 2) }}
                    </option>
                @endforeach
            </select>

            <p class="text-sm text-gray-600 mt-2">Precio por boleto: $<span id="precio-unitario">0.00</span></p>

            <label for="cantidad_boletos">Cantidad de boletos</label>
            <input type="number" name="cantidad_boletos" id="cantidad_boletos" value="{{ old('cantidad_boletos', $venta->cantidad_boletos) }}" min="1" class="w-full border p-2 rounded" required>

            <label for="asientos">Asientos (ej: A1,B2,C3)</label>
         <input type="text" name="asientos" value="{{ old('asientos', $venta->asientos) }}" class="w-full border p-2 rounded" required 
                   placeholder="A1,B2,C3" pattern="^[A-Z][0-9](,[A-Z][0-9])*$"
                   title="Ingresa los asientos separados por coma (ej: A1,B2,C3)">

            <label for="total">Total</label>
            <input type="number" name="total" id="total" step="0.01" value="{{ old('total', $venta->total) }}" class="w-full border p-2 rounded bg-gray-100" required readonly>

            <label for="pago">Método de pago</label>
            <select name="pago" class="w-full border p-2 rounded" required>
                <option value="efectivo" {{ $venta->pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="tarjeta" {{ $venta->pago == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar Venta</button>
        </form>
    </div>

    <script>
        const funcionSelect = document.getElementById('funcion_id');
        const cantidadInput = document.getElementById('cantidad_boletos');
        const totalInput = document.getElementById('total');
        const precioUnitarioSpan = document.getElementById('precio-unitario');

        function calcularTotal() {
            const funcionOption = funcionSelect.options[funcionSelect.selectedIndex];
            const precio = funcionOption ? parseFloat(funcionOption.getAttribute('data-precio') || 0) : 0;
            const cantidad = parseInt(cantidadInput.value) || 0;
            const total = precio * cantidad;
            
            precioUnitarioSpan.textContent = precio.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        funcionSelect.addEventListener('change', calcularTotal);
        cantidadInput.addEventListener('change', calcularTotal);
        cantidadInput.addEventListener('input', calcularTotal);

        // Calcular total inicial
        document.addEventListener('DOMContentLoaded', calcularTotal);
    </script>
</x-app-layout>