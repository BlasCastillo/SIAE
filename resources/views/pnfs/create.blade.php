<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear PNF</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('pnfs.store') }}">
                    @csrf

                    <div>
                        <x-label for="codigo" value="Código" />
                        <x-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" required autofocus />
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <div>
                        <x-label for="nombre" value="Nombre" />
                        <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required />
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <div class="mt-4">
                        <x-label for="descripcion" value="Descripción" />
                        <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" required />
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <div class="mt-4">
                        <x-label for="fk_sede" value="Sede" />
                        <select name="fk_sede" id="fk_sede" class="w-full pl-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                            @endforeach
                        </select>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('pnfs.index') }}" class="btn btn-secondary">Volver</a>
                        <button id="submitButton" class="btn btn-primary ms-4" disabled>
                            <i class="bi bi-check-lg"></i> Agregar PNF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('input[type="text"]').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });

        // 🔥 Validación del código (exactamente dos dígitos numéricos)
        $('#codigo').on('input', function() {
            let valor = $(this).val();
            let regex = /^[0-9]{2}$/;
            if (!regex.test(valor)) {
                mostrarError('codigo', 'El código debe tener exactamente 2 dígitos numéricos.');
            } else {
                ocultarError('codigo');
            }
        });

        function mostrarError(id, mensaje) {
            $('#' + id).addClass('border-red-500');
            $('#' + id).next('.error-message').text(mensaje).removeClass('hidden');
        }

        function ocultarError(id) {
            $('#' + id).removeClass('border-red-500');
            $('#' + id).next('.error-message').text('').addClass('hidden');
        }

        // 🔥 Validación del nombre (solo letras y espacios)
        $('#nombre').on('input', function() {
            let valor = $(this).val();
            let regex = /^[A-Za-zÁÉÍÓÚÑñ\s]+$/;
            if (!regex.test(valor)) {
                mostrarError('nombre', 'El nombre solo puede contener letras y espacios.');
            } else {
                ocultarError('nombre');
            }
        });

        $('#descripcion').on('input', function() {
            let valor = $(this).val();
            if (valor.trim() === '') {
                mostrarError('descripcion', 'La descripción no puede estar vacía.');
            } else {
                ocultarError('descripcion');
            }
        });

        function validarFormulario() {
            let camposValidos = true;

            $('input').each(function() {
                if ($(this).hasClass('border-red-500') || $(this).val().trim() === '') {
                    camposValidos = false;
                }
            });

            $('#submitButton').prop('disabled', !camposValidos);
        }

        $('input, #fk_sede').on('input change', validarFormulario);
    });
    </script>
</x-app-layout>
