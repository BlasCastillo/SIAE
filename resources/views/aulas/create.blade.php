<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Aula') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">

                    <!-- Formulario para crear una nueva aula -->
                    <form action="{{ route('aulas.store') }}" method="POST">
                        @csrf <!-- Token de seguridad -->

                        <!-- Campo: Nombre -->
                        <div class="form-group mb-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="estatus">Estatus:</label>
                            <select name="estatus" id="estatus" class="form-control" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <!-- Campo: Capacidad -->
                        <div class="form-group mb-4">
                            <label for="capacidad">Capacidad</label>
                            <input type="number" name="capacidad" id="capacidad" class="form-control" value="{{ old('capacidad') }}" required min="1">
                            @error('capacidad')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo: Tipo de Aula -->
                        <div class="form-group mb-4">
                            <label for="fk_tipo_aulas">Tipo de Aula</label>
                            <select name="fk_tipo_aulas" id="fk_tipo_aulas" class="form-control" required>
                                <option value="">Seleccione un tipo de aula</option>
                                @foreach ($tipoAulas as $tipoAula)
                                    @if ($tipoAula->estatus) <!-- Solo mostrar tipos de aula activos -->
                                        <option value="{{ $tipoAula->id }}" {{ (old('fk_tipo_aulas', isset($aula) ? $aula->fk_tipo_aulas : '') == $tipoAula->id) ? 'selected' : '' }}>
                                            {{ $tipoAula->nombre }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('fk_tipo_aulas')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <!-- Botón para cancelar y volver a la lista -->
                            <a href="{{ route('aulas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

