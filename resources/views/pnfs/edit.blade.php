<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pnf') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('tipo-aulas.update', $Pnfs->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $Pnfs->nombre }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control">{{ $Pnfs->descripcion }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="estatus">Estatus:</label>
                            <select name="estatus" id="estatus" class="form-control" required>
                                <option value="1" {{ $Pnfs->estatus ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ !$Pnfs->estatus ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
