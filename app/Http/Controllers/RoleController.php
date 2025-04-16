<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        $categories = [
            'Acceso y Autenticación' => [],
            'Gestión de Aulas' => [],
            'Gestión de Tipo Aulas' => [],
            'Gestión de PNFs' => [],
            'Gestión de Trayectos' => [],
            'Gestión de Roles' => [],
        ];

        foreach ($permissions as $permission) {
            if ($permission->name === 'login' || $permission->name === 'dashboard') {
                $categories['Acceso y Autenticación'][] = $permission;
            } elseif (strpos($permission->name, 'aulas.') === 0) {
                $categories['Gestión de Aulas'][] = $permission;
            } elseif (strpos($permission->name, 'tipo-aulas.') === 0) {
                $categories['Gestión de Tipo Aulas'][] = $permission;
            } elseif (strpos($permission->name, 'pnfs.') === 0) {
                $categories['Gestión de PNFs'][] = $permission;
            } elseif (strpos($permission->name, 'trayectos.') === 0) {
                $categories['Gestión de Trayectos'][] = $permission;
            } elseif (strpos($permission->name, 'roles.') === 0) {
                $categories['Gestión de Roles'][] = $permission;
            }
        }

        return view('roles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $categories = [
            'Acceso y Autenticación' => [],
            'Gestión de Aulas' => [],
            'Gestión de Tipo Aulas' => [],
            'Gestión de PNFs' => [],
            'Gestión de Trayectos' => [],
            'Gestión de Roles' => [],
        ];

        foreach ($permissions as $permission) {
            if ($permission->name === 'login' || $permission->name === 'dashboard') {
                $categories['Acceso y Autenticación'][] = $permission;
            } elseif (strpos($permission->name, 'aulas.') === 0) {
                $categories['Gestión de Aulas'][] = $permission;
            } elseif (strpos($permission->name, 'tipo-aulas.') === 0) {
                $categories['Gestión de Tipo Aulas'][] = $permission;
            } elseif (strpos($permission->name, 'pnfs.') === 0) {
                $categories['Gestión de PNFs'][] = $permission;
            } elseif (strpos($permission->name, 'trayectos.') === 0) {
                $categories['Gestión de Trayectos'][] = $permission;
            } elseif (strpos($permission->name, 'roles.') === 0) {
                $categories['Gestión de Roles'][] = $permission;
            }
        }

        return view('roles.edit', compact('role', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'permissions' => 'array',
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente.');
    }
}
