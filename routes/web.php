<?php

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoAulasController;
use App\Http\Controllers\AulasController;
use App\Http\Controllers\PnfsController;
use App\Http\Controllers\TrayectosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    CheckPermission::class, // Agrega el middleware global aquí
])->group(function () {
    // AULAS
    Route::resource('aulas', AulasController::class);
    Route::put('aulas/{id}/activate', [AulasController::class, 'activate'])->name('aulas.activate');
    Route::get('/aulas', [AulasController::class, 'index'])->name('aulas.index');

    // TIPO-AULAS
    Route::resource('tipo-aulas', TipoAulasController::class);
    Route::put('tipo-aulas/{id}/activate', [TipoAulasController::class, 'activate'])->name('tipo-aulas.activate');
    Route::get('/tipo-aulas', [TipoAulasController::class, 'index'])->name('tipo-aulas.index');

    // PNFS
    Route::resource('pnfs', PnfsController::class);
    Route::put('pnfs/{id}/activate', [PnfsController::class, 'activate'])->name('pnfs.activate');
    Route::get('/pnfs', [PnfsController::class, 'index'])->name('pnfs.index');

    // TRAYECTOS
    Route::resource('trayectos', TrayectosController::class);
    Route::put('trayectos/{id}/activate', [TrayectosController::class, 'activate'])->name('trayectos.activate');
    Route::get('/trayectos', [TrayectosController::class, 'index'])->name('trayectos.index');

    // ROLES
    Route::resource('roles', RoleController::class);

    // Dashboard protegido
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});
