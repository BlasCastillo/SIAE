<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Trayecto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Formulario para editar un Trayecto -->
                    <form action="{{ route('trayectos.update', $trayectos->id) }}" method="POST">
                        @csrf <!-- Token de seguridad -->
                        @method('PUT') <!-- Método HTTP para actualizar -->

                        <!-- Campo: Nombre -->
                        <div class="form-group mb-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $trayectos->nombre) }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo: Descripción -->
                        <div class="form-group mb-4">
                            <label for="capacidad">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control">{{ $trayectos->descripcion }}</textarea>
                            @error('capacidad')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo: Estatus -->
                        <div class="form-group mb-4">
                            <label for="estatus">Estatus</label>
                            <select name="estatus" id="estatus" class="form-control" required>
                                <option value="1" {{ (old('estatus', $trayectos->estatus) == 1) ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ (old('estatus', $trayectos->estatus) == 0) ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estatus')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón para enviar el formulario -->
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <!-- Botón para cancelar y volver a la lista -->
                        <a href="{{ route('trayectos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

