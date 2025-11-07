<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4 text-purple-800">Ventas</h1>

        <a href="{{ route('ventas.create') }}" class="bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Nueva Venta</a>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-200 text-purple-900">
                    <th class="p-2">ID</th>
                    <th>Usuario</th>
                    <th>Película / Función</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr class="border-b border-purple-300 text-center">
                        <td class="p-2">{{ $venta->id }}</td>
                        <td>{{ $venta->usuario->name ?? '—' }}</td>
                        <td>{{ $venta->funcion->pelicula->titulo ?? '—' }} — {{ $venta->funcion->fecha ?? '' }} {{ $venta->funcion->hora ?? '' }}</td>
                        <td>{{ $venta->cantidad_boletos }}</td>
                        <td>{{ number_format($venta->total, 2) }}</td>
                        <td>{{ ucfirst($venta->pago) }}</td>
                        <td>
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="text-blue-600 hover:underline">Editar</a> |
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta venta?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if(!empty($reservas) && $reservas->count())
                    <tr class="bg-gray-100 text-left">
                        <td colspan="7" class="p-2 text-sm text-gray-700">Reservas pendientes / confirmadas</td>
                    </tr>
                    @foreach($reservas as $reserva)
                        <tr class="border-b border-yellow-300 text-center bg-yellow-50">
                            <td class="p-2">R-{{ $reserva->id }}</td>
                            <td>{{ $reserva->usuario->name ?? '—' }}</td>
                            <td>{{ $reserva->funcion->pelicula->titulo ?? '—' }} — {{ $reserva->funcion->fecha ?? '' }} {{ $reserva->funcion->hora ?? '' }}</td>
                            <td>{{ $reserva->asiento ?? '—' }}</td>
                            <td>{{ number_format($reserva->total ?? 0, 2) }}</td>
                            <td>{{ ucfirst($reserva->estado) }}</td>
                            <td>
                                <a href="{{ route('ventas.create', ['reserva_id' => $reserva->id]) }}" class="bg-green-600 text-white px-2 py-1 rounded">Registrar venta</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
