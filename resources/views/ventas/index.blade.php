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
                    <th>Asientos</th>
                    <th>Total / Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr class="border-b border-purple-300 text-center">
                        <td class="p-2">{{ $venta->id }}</td>
                        <td>{{ $venta->usuario->name ?? '—' }}</td>
                        <td>{{ $venta->funcion->pelicula->titulo ?? '—' }} — {{ $venta->funcion->fecha ?? '' }} {{ $venta->funcion->hora ?? '' }}</td>
                        <td>
                            <div class="flex flex-col items-center">
                                <span class="font-mono text-purple-600">{{ $venta->asientos }}</span>
                                <span class="text-sm text-gray-500">({{ $venta->cantidad_boletos }} boletos)</span>
                            </div>
                        </td>
                        <td>
                            <div class="text-sm">
                                <div class="font-bold text-gray-900">${{ number_format($venta->total, 2) }}</div>
                                <div class="text-gray-500">{{ ucfirst($venta->pago) }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Pagada
                            </span>
                        </td>
                        <td>
                            <div class="flex space-x-2 justify-center">
                                <a href="{{ route('ventas.show', $venta->id) }}" class="text-blue-600 hover:text-blue-800">Ver</a>
                                <a href="{{ route('ventas.edit', $venta->id) }}" class="text-yellow-600 hover:text-yellow-800">Editar</a>
                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta venta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                                </form>
                            </div>
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
                            <td>
                                <div class="flex flex-col items-center">
                                    <span class="font-mono text-purple-600">{{ $reserva->asientos ?? '—' }}</span>
                                    <span class="text-sm text-gray-500">({{ $reserva->cantidad_boletos ?? '0' }} boletos)</span>
                                </div>
                            </td>
                            <td>
                                <div class="font-bold text-gray-900">${{ number_format($reserva->total ?? 0, 2) }}</div>
                            </td>
                            <td>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $reserva->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $reserva->estado === 'confirmada' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('ventas.create', ['reserva_id' => $reserva->id]) }}" 
                                   class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700">
                                    Registrar Venta
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
