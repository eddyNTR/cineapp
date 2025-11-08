<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CineApp') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" font-sans antialiased" style="background-image: url('{{ asset('storage/ciene-app.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <div class="flex flex-col min-h-screen">
        <!-- Menú Principal -->
        <header class="bg-custom-purple text-white p-4">
            <div class="max-w-7xl mx-auto flex justify-between">
                <div class="flex items-center">
                <a href="{{ route('landing') }}">
                    <img src="{{ asset('storage/palomitas-de-maiz.png') }}" alt="CineApp Icono" class="w-8 h-8 mr-2">
                </a>
                <h1 class="text-[24px] font-bold">CineApp</h1>
                </div>

                <nav class="space-x-4">
                    <a href="{{ route('cartelera') }}" class="text-lg">Cartelera</a>
                    <a class="font-semibold">Bienvenido, {{ Auth::user()->name }}</a> <!-- Nombre del usuario -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-lg text-white bg-red-600 p-2 rounded-md">Cerrar sesión</button>
                    </form>
                </nav>
            </div>
        </header>

        <!-- Contenido de la Selección de Asientos -->
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-[36px] text-white text-center font-semibold mb-6 bg-custom-purple p-2">Selecciona tu asiento</h2>

                <!-- Información de la película -->
                <div class="bg-custom-purple/70 backdrop-blur-sm p-6 rounded-lg shadow-lg mb-6">
                    <h3 class="text-[36px] font-bold text-gray-200">{{ $funcion->pelicula->titulo }}</h3>
                    <p class="text-[24px] text-gray-200">{{ $funcion->pelicula->genero }} • {{ $funcion->pelicula->duracion }} min</p>
                    <p class="text-gray-200 mt-2 text-[24px]">{{ $funcion->pelicula->sinopsis }}</p>
                    <p class="text-lg font-semibold text-purple-200 mt-2">Precio por boleto: ${{ number_format($funcion->precio, 2) }}</p>

                    <!-- Mostrar la imagen de la película -->
                    @if($funcion->pelicula->imagen)
                        <img src="{{ asset('storage/'.$funcion->pelicula->imagen) }}" alt="{{ $funcion->pelicula->titulo }}" class="w-32 h-48 object-cover rounded-lg mt-4">
                    @else
                        <div class="w-32 h-48 bg-gray-300 rounded-lg mt-4 flex items-center justify-center text-white">Sin Imagen</div>
                    @endif
                </div>

                <!-- Selección de Asientos -->
                <div class="bg-custom-purple/30 backdrop-blur-sm p-6 rounded-lg shadow-lg">
                    <h3 class="text-[24px] font-bold text-gray-200 mb-4">Selecciona tus asientos</h3>

                    <div class="mb-6 text-center">
                        <div class="w-3/4 h-12 bg-gray-800 text-white text-center py-3 mx-auto mb-8 rounded">PANTALLA</div>
                    </div>

                    <!-- Leyenda de asientos -->
                    <div class="flex justify-center gap-6 mb-4">
                        <div class="flex items-center">
                            <div class="asiento w-6 h-6 mr-2 border-2 border-gray-500"></div>
                            <span class="text-sm">Disponible</span>
                        </div>
                        <div class="flex items-center">
                            <div class="asiento w-6 h-6 mr-2 ocupado"></div>
                            <span class="text-sm">Vendido</span>
                        </div>
                        <div class="flex items-center">
                            <div class="asiento w-6 h-6 mr-2 seleccionado"></div>
                            <span class="text-sm">Seleccionado</span>
                        </div>
                    </div>

                    <div id="sala-asientos" class="mb-8">
                        <!-- Los asientos se generarán aquí por JavaScript -->
                    </div>

                    <div class="bg-gray-300 p-4 rounded-lg mb-8">
                        <h4 class="font-semibold mb-2">Asientos Seleccionados</h4>
                        <div id="asientos-seleccionados" class="text-lg mb-2">Ninguno</div>
                        <div class="flex gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cantidad de boletos</label>
                                <div id="cantidad-boletos" class="text-lg">0</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Total a pagar</label>
                                <div id="total-pagar" class="text-lg">$0.00</div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de venta -->
                    <form method="POST" action="{{ route('reservar.store') }}" id="form-venta">
                        @csrf
                        <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="funcion_id" value="{{ $funcion->id }}">
                        <input type="hidden" name="asientos" id="asientos-input">
                        <input type="hidden" name="cantidad_boletos" id="cantidad-input">
                        <input type="hidden" name="total" id="total-input">
                        <div class="mb-4">
                            <label for="pago" class="block text-sm font-medium text-gray-200 mb-2">Método de pago</label>
                            <select name="pago" id="pago" class="w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500" required>
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                            </select>
                        </div>

                        <button type="submit" 
                                class="w-full bg-purple-700 text-white py-2 px-4 rounded-md hover:bg-purple-800 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                id="btn-confirmar"
                                disabled>
                            Confirmar Compra
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <style>
        .asiento {
            width: 40px;
            height: 40px;
            margin: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #084191;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .asiento:hover:not(.ocupado) {
            border-color: #7C3AED;
            background-color: #EDE9FE;
        }
        .asiento.seleccionado {
            background-color: #7C3AED;
            border-color: #6D28D9;
            color: white;
        }
        .asiento.ocupado {
            background-color: #FEE2E2;
            border-color: #EF4444;
            cursor: not-allowed;
            color: #B91C1C;
        }
        .fila {
            display: flex;
            justify-content: center;
            margin-bottom: 4px;
        }
        .fila-letra {
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            margin-right: 8px;
        }
    </style>

    <script>
        const FILAS = 5;
        const ASIENTOS_POR_FILA = 10;
        const LETRAS = ['A', 'B', 'C', 'D', 'E'];
        const PRECIO_BOLETO = {{ $funcion->precio }};

        // Estado
        let asientosSeleccionados = new Set();
        let asientosOcupados = new Set([
            // Asientos vendidos
            @foreach($asientosVendidos ?? [] as $asiento)
                "{{ $asiento }}",
            @endforeach
        ]);

        function generarAsientos() {
            const contenedor = document.getElementById('sala-asientos');
            
            for (let i = 0; i < FILAS; i++) {
                const fila = document.createElement('div');
                fila.className = 'fila';
                
                // Letra de la fila
                const letraFila = document.createElement('div');
                letraFila.className = 'fila-letra';
                letraFila.textContent = LETRAS[i];
                fila.appendChild(letraFila);

                // Asientos de la fila
                for (let j = 1; j <= ASIENTOS_POR_FILA; j++) {
                    const asiento = document.createElement('div');
                    const idAsiento = `${LETRAS[i]}${j}`;
                    
                    asiento.className = 'asiento';
                    asiento.textContent = idAsiento;
                    asiento.dataset.asiento = idAsiento;
                    
                    if (asientosOcupados.has(idAsiento)) {
                        asiento.classList.add('ocupado');
                    } else {
                        asiento.addEventListener('click', () => toggleAsiento(idAsiento, asiento));
                    }
                    
                    fila.appendChild(asiento);
                }
                
                contenedor.appendChild(fila);
            }
        }

        function toggleAsiento(idAsiento, elemento) {
            if (asientosOcupados.has(idAsiento)) return;

            if (asientosSeleccionados.has(idAsiento)) {
                asientosSeleccionados.delete(idAsiento);
                elemento.classList.remove('seleccionado');
            } else {
                asientosSeleccionados.add(idAsiento);
                elemento.classList.add('seleccionado');
            }

            actualizarResumen();
        }

        function actualizarResumen() {
            const asientosArray = Array.from(asientosSeleccionados).sort();
            const cantidad = asientosSeleccionados.size;
            const total = cantidad * PRECIO_BOLETO;

            // Actualizar display
            document.getElementById('asientos-seleccionados').textContent = 
                asientosArray.length > 0 ? asientosArray.join(', ') : 'Ninguno';
            document.getElementById('cantidad-boletos').textContent = cantidad;
            document.getElementById('total-pagar').textContent = `$${total.toFixed(2)}`;

            // Actualizar inputs ocultos
            document.getElementById('asientos-input').value = asientosArray.join(',');
            document.getElementById('cantidad-input').value = cantidad;
            document.getElementById('total-input').value = total;

            // Habilitar/deshabilitar botón de confirmar
            document.getElementById('btn-confirmar').disabled = cantidad === 0;
        }

        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            generarAsientos();
            actualizarResumen();
        });
    </script>
</body>
</html>
