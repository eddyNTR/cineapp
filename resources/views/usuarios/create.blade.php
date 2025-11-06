<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Agregar Nuevo Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-3">
            @csrf
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre" class="w-full border p-2 rounded" required>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Contraseña" class="w-full border p-2 rounded" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="w-full border p-2 rounded" required>
            
            <select name="role" class="w-full border p-2 rounded" required>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="cajero" {{ old('role') == 'cajero' ? 'selected' : '' }}>Cajero</option>
                <option value="cliente" {{ old('role') == 'cliente' ? 'selected' : '' }}>Cliente</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
