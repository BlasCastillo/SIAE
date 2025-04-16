<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Permisos del Rol: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-3">
                                <ul class="nav flex-column">
                                    @foreach($categories as $category => $permissions)
                                        @php
                                            $hasPermissions = false;
                                            foreach ($permissions as $permission) {
                                                if ($role->hasPermissionTo($permission->name)) {
                                                    $hasPermissions = true;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        <li class="nav-item">
                                            <a
                                                class="nav-link custom-category-link edit-category-link {{ $hasPermissions ? 'active-permission-category' : 'inactive-permission-category' }} {{ $loop->first ? 'active' : '' }}"
                                                href="#"
                                                data-category="{{ str_replace(' ', '-', strtolower((string)$category)) }}"
                                            >
                                                {{ $category }}
                                                @if($hasPermissions)
                                                    <i class="bi bi-check-circle-fill"></i>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-9">
                                @foreach($categories as $category => $permissions)
                                    <div
                                        id="{{ str_replace(' ', '-', strtolower((string)$category)) }}"
                                        class="permissions-container {{ $loop->first ? 'show' : 'hide' }}"
                                    >
                                        <h3>{{ $category }}</h3>
                                        <i class="bi bi-exclamation-circle-fill warning-icon"></i>
                                        @foreach($permissions as $permission)
                                            <div>
                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                >
                                                {{ $permission->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Actualizar Permisos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
