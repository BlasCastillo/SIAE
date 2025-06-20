<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del PNF') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Card para mostrar los detalles del PNF -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Campo: Código -->
                            <h5 class="card-title">Código</h5>
                            <p class="card-text">{{ $pnf->codigo }}</p>

                            <!-- Campo: Nombre -->
                            <h5 class="card-title">Nombre</h5>
                            <p class="card-text">{{ $pnf->nombre }}</p>

                            <!-- Campo: Descripción -->
                            <h5 class="card-title">Descripción</h5>
                            <p class="card-text">{{ $pnf->descripcion }}</p>

                            <!-- Campo: Sede -->
                            <h5 class="card-title">Sede</h5>
                            <p class="card-text">{{ $pnf->sede->nombre }}</p>

                            <!-- Campo: Estatus -->
                            <h5 class="card-title">Estatus</h5>
                            <p class="card-text">
                                @if ($pnf->estatus)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </p>

                            <!-- Botón para volver a la lista -->
                            <a href="{{ route('pnfs.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
