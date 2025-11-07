<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Registrar Venta</h1>

        <form action="{{ route('ventas.store') }}" method="POST" class="space-y-3">
            @csrf

            <label for="reserva_id">Usar Reserva (opcional)</label>
            <select name="reserva_id" id="reserva_id" class="w-full border p-2 rounded">
                <option value="">-- Seleccionar reserva --</option>
                @foreach($reservas as $res)
                    <option value="{{ $res->id }}" data-usuario="{{ $res->usuario_id }}" data-funcion="{{ $res->funcion_id }}" data-asiento="{{ $res->asiento }}">Reserva #{{ $res->id }} — {{ $res->usuario->name ?? 'Usuario' }} — {{ $res->asiento }} — {{ $res->funcion->pelicula->titulo ?? '' }} {{ $res->funcion->fecha ?? '' }} {{ $res->funcion->hora ?? '' }}</option>
                @endforeach
            </select>

            <p class="text-sm text-gray-600">Si seleccionas una reserva, los campos Usuario y Función se rellenarán automáticamente. También puedes seleccionar manualmente Usuario y Función.</p>

            <label for="usuario_id">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="w-full border p-2 rounded" required>
                <option value="">-- Seleccionar usuario --</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }} ({{ $usuario->email }})</option>
                @endforeach
            </select>

            <label for="funcion_id">Función</label>
            <select name="funcion_id" id="funcion_id" class="w-full border p-2 rounded" required>
                <option value="">-- Seleccionar función --</option>
                @foreach($funciones as $funcion)
                    <option value="{{ $funcion->id }}">{{ $funcion->pelicula->titulo ?? '' }} — {{ $funcion->fecha }} {{ $funcion->hora }} (Sala: {{ $funcion->sala->nombre ?? '' }})</option>
                @endforeach
            </select>

            <div id="reserva-info" class="mt-2 text-sm text-gray-700"></div>

            <label for="cantidad_boletos">Cantidad de boletos</label>
            <input type="number" name="cantidad_boletos" value="1" min="1" class="w-full border p-2 rounded" required>

            <label for="total">Total</label>
            <input type="number" name="total" step="0.01" value="0.00" class="w-full border p-2 rounded" required>

            <label for="pago">Método de pago</label>
            <select name="pago" class="w-full border p-2 rounded" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
    <script>
        const reservaSelect = document.getElementById('reserva_id');
        const usuarioInput = document.getElementById('usuario_id');
        const funcionInput = document.getElementById('funcion_id');
        const reservaInfo = document.getElementById('reserva-info');

        reservaSelect && reservaSelect.addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            if (!opt || !opt.value) {
                usuarioInput.value = '';
                funcionInput.value = '';
                reservaInfo.innerHTML = '';
                return;
            }
            usuarioInput.value = opt.getAttribute('data-usuario') || '';
            funcionInput.value = opt.getAttribute('data-funcion') || '';
            const asiento = opt.getAttribute('data-asiento') || '';
            reservaInfo.innerHTML = '<strong>Asiento:</strong> ' + asiento;
        });
    </script>
</x-app-layout>
