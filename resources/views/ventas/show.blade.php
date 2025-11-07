<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Detalle de Venta #{{ $venta->id }}</h1>

        <div class="bg-white shadow rounded p-6">
            <p><strong>Usuario:</strong> {{ $venta->usuario->name ?? '—' }} ({{ $venta->usuario->email ?? '' }})</p>
            <p><strong>Función:</strong> {{ $venta->funcion->pelicula->titulo ?? '—' }} — {{ $venta->funcion->fecha ?? '' }} {{ $venta->funcion->hora ?? '' }}</p>
            <p><strong>Cantidad:</strong> {{ $venta->cantidad_boletos }}</p>
            <p><strong>Total:</strong> {{ number_format($venta->total, 2) }}</p>
            <p><strong>Pago:</strong> {{ ucfirst($venta->pago) }}</p>
            <p><strong>Fecha:</strong> {{ $venta->created_at }}</p>
        </div>

        <a href="{{ route('ventas.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Volver a Ventas</a>
    </div>
</x-app-layout>
