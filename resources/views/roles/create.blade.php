

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Rol
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <div>
                            <label for="name">Nombre del Rol:</label>
                            <input type="text" name="name" id="name" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <ul class="nav flex-column">
                                    @foreach($categories as $category => $permissions)
                                        <li class="nav-item">
                                            <a class="nav-link custom-category-link {{ $loop->first ? 'active' : '' }}" href="#" data-category="{{ str_replace(' ', '-', strtolower((string)$category)) }}">{{ $category }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-9">
                                @foreach($categories as $category => $permissions)
                                    <div id="{{ str_replace(' ', '-', strtolower((string)$category)) }}" class="permissions-container {{ $loop->first ? 'show' : 'hide' }}">
                                        <h3>{{ $category }}</h3>
                                        @foreach($permissions as $permission)
                                            <div>
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                                {{ $permission->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit">Crear Rol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
