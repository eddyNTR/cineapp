<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Agregar Nuevo Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="name" placeholder="Nombre" class="w-full border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" required>
            <input type="password" name="password" placeholder="Contraseña" class="w-full border p-2 rounded" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="w-full border p-2 rounded" required>
            
            <select name="role" class="w-full border p-2 rounded" required>
                <option value="admin">Admin</option>
                <option value="cajero">Cajero</option>
                <option value="cliente">Cliente</option>
            </select>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
