<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Trayectos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Botón para mostrar/ocultar inactivos -->
                    <button id="toggleInactivos" class="btn btn-secondary"><i class="bi bi-eye"></i> Mostrar Inactivos</button>
                    <!-- Botón para crear una nueva aula -->
                    <a href="{{ route('trayectos.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Crear Nueva</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trayectos as $trayecto)
                            @if ($trayecto->estatus) <!-- Mostrar solo aulas y tipos de aula activos -->
                                    <tr class="registro-activo">
                                        <td>{{ $trayecto->nombre }}</td>
                                        <td>{{ $trayecto->descripcion }}</td>
                                        <td>{{ $trayecto->estatus ? 'Activo' : 'Inactivo' }}</td>
                                        <td>
                                            <a href="{{ route('trayectos.show', $trayecto->id) }}" class="btn btn-success"><i class="bi bi-eye"></i> ver</a>
                                            <!-- Botón para editar -->
                                            <a href="{{ route('trayectos.edit', $trayecto->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                            <!-- Formulario para desactivar -->
                                            <form action="{{ route('trayectos.destroy', $trayecto->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>Desactivar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @else <!-- Registros inactivos (ocultos por defecto) -->
                                    <tr class="registro-inactivo" style="display: none;">
                                        <td>{{ $trayecto->nombre }}</td>
                                        <td>{{ $trayecto->descripcion }}</td>
                                        <td>{{ $trayecto->estatus ? 'Activo' : 'Inactivo' }}</td>
                                        <td>
                                            <!-- Formulario para activar -->
                                            <form action="{{ route('trayectos.activate', $trayecto->id) }}" method="POST" style="display: inline;">
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


    <!-- Script para alternar la visibilidad de los registros inactivos -->
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
