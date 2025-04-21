<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-4"> <i class="bi bi-plus-lg"></i>
                        Crear Usuario
                    </a>

                    @if(session()->has('success'))
                        <div class="bg-green-500 text-white p-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="bg-red-500 text-white p-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Correo</th>
                                <th class="px-4 py-2">Rol</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->role->name ?? 'Sin rol' }}</td>
                                    <td class="border px-4 py-2">
                                        <button class="btn btn-warning"
                                                  onclick="window.location.href='{{ route('users.edit', $user->id) }}'"> <i class="bi bi-pencil"></i>
                                            Editar Usuario
                                        </button>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"
                                                      onclick="return confirm('¿Estás seguro de eliminar este usuario?')"> <i class="bi bi-trash"></i>
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
