<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar Usuario</h1>

        <form action="{{ route('usuarios.update', $user) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2 rounded" required>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Contraseña (opcional)" class="w-full border p-2 rounded">
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña (opcional)" class="w-full border p-2 rounded">
            
            <select name="role" class="w-full border p-2 rounded" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="cajero" {{ $user->role == 'cajero' ? 'selected' : '' }}>Cajero</option>
                <option value="cliente" {{ $user->role == 'cliente' ? 'selected' : '' }}>Cliente</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
