<?php
// database/seeders/RolesAndPermissionsSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear roles
        $this->createRole('USUARIO');
        $this->createRole('DOCENTE');
        $this->createRole('COORDINADOR');
        $this->createRole('DIRECTOR');
        $this->createRole('ADMINISTRADOR');

        // Crear permisos
        $this->createPermissions();

        // Asignar permisos a roles
        $this->assignPermissionsToRoles();

        // Actualizar caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    private function createRole($name)
    {
        if (!Role::where('name', $name)->exists()) {
            Role::create(['name' => $name]);
        }
    }

    private function createPermissions()
    {
            // Permisos para AULAS
            $this->createPermission('aulas.index');
            $this->createPermission('aulas.create');
            $this->createPermission('aulas.edit');
            $this->createPermission('aulas.show');
            $this->createPermission('aulas.delete');

            // Permisos para TIPO-AULAS
            $this->createPermission('tipo-aulas.index');
            $this->createPermission('tipo-aulas.create');
            $this->createPermission('tipo-aulas.edit');
            $this->createPermission('tipo-aulas.show');
            $this->createPermission('tipo-aulas.delete');

            // Permisos para PNFS
            $this->createPermission('pnfs.index');
            $this->createPermission('pnfs.create');
            $this->createPermission('pnfs.edit');
            $this->createPermission('pnfs.show');
            $this->createPermission('pnfs.delete');

            // Permisos para TRAYECTOS
            $this->createPermission('trayectos.index');
            $this->createPermission('trayectos.create');
            $this->createPermission('trayectos.edit');
            $this->createPermission('trayectos.show');
            $this->createPermission('trayectos.delete');

            // Permisos para ROLES
            $this->createPermission('roles.index');
            $this->createPermission('roles.create');
            $this->createPermission('roles.edit');
            $this->createPermission('roles.editName');
            $this->createPermission('roles.show');
            $this->createPermission('roles.delete');

            // Permisos para inicio de sesión
            $this->createPermission('login');

            // Permisos para Dashboard
            $this->createPermission('dashboard');
        }

    private function assignPermissionsToRoles()
    {
        // Asignar permisos al rol USUARIO
        $userRole = Role::where('name', 'USUARIO')->first();
        $userRole->givePermissionTo([
            'dashboard',
        ]);

        // Asignar permisos al rol DOCENTE
        $docenteRole = Role::where('name', 'DOCENTE')->first();
        $docenteRole->givePermissionTo([
            'login',
            'aulas.index',
            'aulas.show',
            'pnfs.index',
            'pnfs.show',
        ]);

        // Asignar permisos al rol COORDINADOR
        $coordinadorRole = Role::where('name', 'COORDINADOR')->first();
        $coordinadorRole->givePermissionTo([
            'login',
            'dashboard',
            'aulas.index',
            'aulas.create',
            'aulas.edit',
            'aulas.show',
            'aulas.delete',
            'pnfs.index',
            'pnfs.create',
            'pnfs.edit',
            'pnfs.show',
            'pnfs.delete',
            'trayectos.index',
            'trayectos.create',
            'trayectos.edit',
            'trayectos.show',
            'trayectos.delete',
        ]);

        // Asignar permisos al rol DIRECTOR
        $directorRole = Role::where('name', 'DIRECTOR')->first();
        $directorRole->givePermissionTo([
            'login',
            'dashboard',
            'aulas.index',
            'aulas.create',
            'aulas.edit',
            'aulas.show',
            'aulas.delete',
            'pnfs.index',
            'pnfs.create',
            'pnfs.edit',
            'pnfs.show',
            'pnfs.delete',
            'trayectos.index',
            'trayectos.create',
            'trayectos.edit',
            'trayectos.show',
            'trayectos.delete',
        ]);

        // Asignar permisos al rol ADMINISTRADOR
        $adminRole = Role::where('name', 'ADMINISTRADOR')->first();
        $adminRole->givePermissionTo([
            'login',
            'dashboard',
            'roles.index',
            'roles.create',
            'roles.edit',
            'roles.show',
            'roles.delete',
            'aulas.index',
            'aulas.create',
            'aulas.edit',
            'aulas.show',
            'aulas.delete',
            'tipo-aulas.index',
            'tipo-aulas.create',
            'tipo-aulas.edit',
            'tipo-aulas.show',
            'tipo-aulas.delete',
            'pnfs.index',
            'pnfs.create',
            'pnfs.edit',
            'pnfs.show',
            'pnfs.delete',
            'trayectos.index',
            'trayectos.create',
            'trayectos.edit',
            'trayectos.show',
            'trayectos.delete',
        ]);

    }

    private function createPermission($name)
    {
        if (!Permission::where('name', $name)->exists()) {
            Permission::create(['name' => $name]);
        }
    }
}
