<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4 text-purple-800">Gestión de Usuarios</h1>

        <a href="{{ route('usuarios.create') }}" class="bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Nuevo Usuario</a>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-200 text-purple-900">
                    <th class="p-2">Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="border-b border-purple-300 text-center">
                        <td class="p-2">{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->role }}</td>
                        <td>
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="text-blue-600 hover:underline">Editar</a> |
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
