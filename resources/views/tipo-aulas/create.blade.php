<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Tipo de Aula') }}
        </h2>
    </x-slot>
    <div class="container">
        <form action="{{ route('tipo-aulas.store') }}" method="POST">
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
                <label for="valor">Valor:</label>
                <input type="number" name="valor" id="valor" class="form-control" required>
            </div>
            <div class="form-group mb-4">
                <label for="estatus">Estatus:</label>
                <select name="estatus" id="estatus" class="form-control" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>
