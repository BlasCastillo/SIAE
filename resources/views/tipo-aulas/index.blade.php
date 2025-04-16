<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Tipos de Aulas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <button id="toggleInactivos" class="btn btn-secondary"><i class="bi bi-eye"></i> Mostrar Inactivos</button>
                    <a href="{{ route('tipo-aulas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Crear Nuevo</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Valor</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipoAulas as $tipoAula)
                                @if ($tipoAula->estatus) <!-- Mostrar solo registros activos por defecto -->
                                    <tr class="registro-activo">
                                        <td>{{ $tipoAula->nombre }}</td>
                                        <td>{{ $tipoAula->descripcion }}</td>
                                        <td>{{ $tipoAula->valor }}</td>
                                        <td>{{ $tipoAula->estatus ? 'Activo' : 'Inactivo' }}</td>
                                        <td>
                                            <a href="{{ route('tipo-aulas.show', $tipoAula->id) }}" class="btn btn-success"><i class="bi bi-eye"></i> Ver</a>
                                            <a href="{{ route('tipo-aulas.edit', $tipoAula->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                            <form action="{{ route('tipo-aulas.destroy', $tipoAula->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Desactivar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @else <!-- Registros inactivos (ocultos por defecto) -->
                                    <tr class="registro-inactivo" style="display: none;">
                                        <td>{{ $tipoAula->nombre }}</td>
                                        <td>{{ $tipoAula->descripcion }}</td>
                                        <td>{{ $tipoAula->valor }}</td>
                                        <td>{{ $tipoAula->estatus ? 'Activo' : 'Inactivo' }}</td>
                                        <td>
                                            <form action="{{ route('tipo-aulas.activate', $tipoAula->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Activar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleInactivos').addEventListener('click', function() {
            const registrosInactivos = document.querySelectorAll('.registro-inactivo');
            const boton = this;

            registrosInactivos.forEach(registro => {
                if (registro.style.display === 'none') {
                    registro.style.display = 'table-row';
                    boton.innerHTML = '<i class="bi bi-eye-slash"></i> Ocultar Inactivos';
                } else {
                    registro.style.display = 'none';
                    boton.innerHTML = '<i class="bi bi-eye"></i> Mostrar Inactivos';
                }
            });
        });
    </script>
</x-app-layout>
