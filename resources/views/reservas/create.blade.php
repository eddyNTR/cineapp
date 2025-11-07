<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Confirmar Reserva</h1>

        <form action="{{ route('reservas.store') }}" method="POST" class="space-y-3">
            @csrf

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="reserva_id">Usar Reserva (opcional)</label>
            <select name="reserva_id" id="reserva_id" class="w-full border p-2 rounded">
                <option value="">-- Seleccionar reserva --</option>
                @foreach($reservas as $res)
                    <option value="{{ $res->id }}" 
                            data-usuario="{{ $res->usuario_id }}" 
                            data-funcion="{{ $res->funcion_id }}" 
                            data-asiento="{{ $res->asiento }}"
                            {{ request()->get('reserva_id') == $res->id ? 'selected' : '' }}>
                        Reserva #{{ $res->id }} — {{ $res->usuario->name ?? 'Usuario' }} — {{ $res->asiento }} — {{ $res->funcion->pelicula->titulo ?? '' }} {{ $res->funcion->fecha ?? '' }} {{ $res->funcion->hora ?? '' }}
                    </option>
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
                    <option value="{{ $funcion->id }}" 
                            data-precio="{{ $funcion->precio }}">
                        {{ $funcion->pelicula->titulo ?? '' }} — {{ $funcion->fecha }} {{ $funcion->hora }} 
                        (Sala: {{ $funcion->sala->nombre ?? '' }}) - ${{ number_format($funcion->precio, 2) }}
                    </option>
                @endforeach
            </select>

            <div id="reserva-info" class="mt-2 text-sm text-gray-700"></div>
            <p class="text-sm text-gray-600">Precio por boleto: $<span id="precio-unitario">0.00</span></p>

            <label for="cantidad_boletos">Cantidad de boletos</label>
            <input type="number" name="cantidad_boletos" id="cantidad_boletos" value="1" min="1" class="w-full border p-2 rounded" required>

            <label for="asientos">Asientos (ej: A1,B2,C3)</label>
            <input type="text" name="asientos" class="w-full border p-2 rounded" required 
                   placeholder="A1,B2,C3" pattern="^[A-Z][0-9](,[A-Z][0-9])*$"
                   title="Ingresa los asientos separados por coma (ej: A1,B2,C3)">

            <label for="total">Total</label>
            <input type="number" name="total" id="total" step="0.01" value="0.00" class="w-full border p-2 rounded bg-gray-100" required readonly>

            <label for="pago">Método de pago</label>
            <select name="pago" class="w-full border p-2 rounded" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Confirmar Reserva</button>
        </form>
    </div>
    <script>
        const reservaSelect = document.getElementById('reserva_id');
        const usuarioInput = document.getElementById('usuario_id');
        const funcionInput = document.getElementById('funcion_id');
        const reservaInfo = document.getElementById('reserva-info');
        const cantidadInput = document.getElementById('cantidad_boletos');
        const totalInput = document.getElementById('total');
        const precioUnitarioSpan = document.getElementById('precio-unitario');

        function calcularTotal() {
            const funcionOption = funcionInput.options[funcionInput.selectedIndex];
            const precio = funcionOption ? parseFloat(funcionOption.getAttribute('data-precio') || 0) : 0;
            const cantidad = parseInt(cantidadInput.value) || 0;
            const total = precio * cantidad;
            
            precioUnitarioSpan.textContent = precio.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        function updateFieldsFromReserva() {
            const opt = reservaSelect.options[reservaSelect.selectedIndex];
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
            calcularTotal(); // Recalcular total cuando se selecciona una reserva
        }

        reservaSelect && reservaSelect.addEventListener('change', updateFieldsFromReserva);
        funcionInput.addEventListener('change', calcularTotal);
        cantidadInput.addEventListener('change', calcularTotal);
        cantidadInput.addEventListener('input', calcularTotal);

        // Ejecutar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            calcularTotal();
            if (reservaSelect && reservaSelect.value) {
                updateFieldsFromReserva();
            }
        });
    </script>
</x-app-layout>