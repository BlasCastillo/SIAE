<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Pnf´s') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="container">
                        <form action="{{ route('pnfs.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="estatus">Estatus:</label>
                                <select name="estatus" id="estatus" class="form-control" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>

                                <!-- Botón para cancelar y volver a la lista -->
                                <a href="{{ route('pnfs.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

