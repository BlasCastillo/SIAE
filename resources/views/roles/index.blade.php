<!-- resources/views/roles/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Roles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        Crear Rol
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
                                <th class="px-4 py-2">Nombre del Rol</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td class="border px-4 py-2">{{ $role->name }}</td>
                                    <td class="border px-4 py-2">
                                        <button class="btn btn-warning"
                                                  onclick="window.location.href='{{ route('roles.edit', $role->id) }}'"><i class="bi bi-pencil"></i>
                                            Editar Rol
                                        </button>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"
                                                      onclick="return confirm('¿Estás seguro de eliminar este rol?')"> <i class="bi bi-trash"></i>
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

