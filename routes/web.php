<?php

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoAulasController;
use App\Http\Controllers\TipoUnidadCurricularController;
use App\Http\Controllers\AulasController;
use App\Http\Controllers\PnfsController;
use App\Http\Controllers\TrayectosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DuracionController;
use App\Http\Controllers\UnidadCurricularController;
use App\Http\Controllers\DiaController;
use App\Http\Controllers\HoraController;
use App\Http\Controllers\DocentePorPNFController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SedesController;


Route::middleware([
    'auth:web',
    config('jetstream.auth_session'),
    'verified',
    CheckPermission::class,
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

    // Sedes
Route::resource('sedes', SedesController::class);
Route::put('sedes/{id}/activate', [SedesController::class, 'activate'])->name('sedes.activate');
Route::get('/sedes', [SedesController::class, 'index'])->name('sedes.index');


    // TRAYECTOS
    Route::resource('trayectos', TrayectosController::class);
    Route::put('trayectos/{id}/activate', [TrayectosController::class, 'activate'])->name('trayectos.activate');
    Route::get('/trayectos', [TrayectosController::class, 'index'])->name('trayectos.index');

    // ROLES
    Route::resource('roles', RoleController::class);


    // USUARIOS
    Route::middleware(['auth:web', config('jetstream.auth_session'), 'verified'])
        ->prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

    /* TIPO_UNIDAD_CURRICULAR */
    Route::middleware(['auth'])->group(function () {
        Route::get('/tipo_unidad_curricular', [TipoUnidadCurricularController::class, 'index'])->name('tipo_unidad_curricular.index');
        Route::get('/tipo_unidad_curricular/create', [TipoUnidadCurricularController::class, 'create'])->name('tipo_unidad_curricular.create');
        Route::post('/tipo_unidad_curricular', [TipoUnidadCurricularController::class, 'store'])->name('tipo_unidad_curricular.store');
        Route::get('/tipo_unidad_curricular/{tipoUnidadCurricular}/edit', [TipoUnidadCurricularController::class, 'edit'])->name('tipo_unidad_curricular.edit');
        Route::put('/tipo_unidad_curricular/{tipoUnidadCurricular}', [TipoUnidadCurricularController::class, 'update'])->name('tipo_unidad_curricular.update');
        Route::delete('/tipo_unidad_curricular/{tipoUnidadCurricular}', [TipoUnidadCurricularController::class, 'destroy'])->name('tipo_unidad_curricular.destroy');
    });

    /* DURACION */
    Route::middleware(['auth'])->group(function () {
        Route::get('/duraciones', [DuracionController::class, 'index'])->name('duraciones.index');
        Route::get('/duraciones/create', [DuracionController::class, 'create'])->name('duraciones.create');
        Route::post('/duraciones', [DuracionController::class, 'store'])->name('duraciones.store');
        Route::get('/duraciones/{duracion}/edit', [DuracionController::class, 'edit'])->name('duraciones.edit');
        Route::put('/duraciones/{duracion}', [DuracionController::class, 'update'])->name('duraciones.update');
        Route::delete('/duraciones/{duracion}', [DuracionController::class, 'destroy'])->name('duraciones.destroy');
    });

    /* UNIDAD CURRICULAR */
    Route::middleware(['auth'])->group(function () {
        Route::get('/unidad_curricular', [UnidadCurricularController::class, 'index'])->name('unidad_curricular.index');
        Route::get('/unidad_curricular/create', [UnidadCurricularController::class, 'create'])->name('unidad_curricular.create');
        Route::post('/unidad_curricular', [UnidadCurricularController::class, 'store'])->name('unidad_curricular.store');
        Route::get('/unidad_curricular/{unidadCurricular}/edit', [UnidadCurricularController::class, 'edit'])->name('unidad_curricular.edit');
        Route::put('/unidad_curricular/{unidadCurricular}', [UnidadCurricularController::class, 'update'])->name('unidad_curricular.update');
        Route::delete('/unidad_curricular/{unidadCurricular}', [UnidadCurricularController::class, 'destroy'])->name('unidad_curricular.destroy');


        // Rutas para el controlador DiaController
        Route::get('/dias', [DiaController::class, 'index'])->name('dias.index');
        Route::get('/dias/create', [DiaController::class, 'create'])->name('dias.create');
        Route::post('/dias', [DiaController::class, 'store'])->name('dias.store');
        Route::get('/dias/{dia}/edit', [DiaController::class, 'edit'])->name('dias.edit');
        Route::put('/dias/{dia}', [DiaController::class, 'update'])->name('dias.update');
        Route::delete('/dias/{dia}', [DiaController::class, 'destroy'])->name('dias.destroy');

        // Rutas para el controlador HoraController
        Route::get('/horas', [HoraController::class, 'index'])->name('horas.index');
        Route::get('/horas/create', [HoraController::class, 'create'])->name('horas.create');
        Route::post('/horas', [HoraController::class, 'store'])->name('horas.store');
        Route::get('/horas/{hora}/edit', [HoraController::class, 'edit'])->name('horas.edit');
        Route::put('/horas/{hora}', [HoraController::class, 'update'])->name('horas.update');
        Route::delete('/horas/{hora}', [HoraController::class, 'destroy'])->name('horas.destroy');
    });

    /// Rutas para el controlador DocentePorPNFController
Route::get('/docentesporpnf', [DocentePorPNFController::class, 'index'])->name('docentesporpnf.index')->middleware('can:docentesporpnf.index');
Route::get('/docentesporpnf/create', [DocentePorPNFController::class, 'create'])->name('docentesporpnf.create')->middleware('can:docentesporpnf.create');
Route::post('/docentesporpnf', [DocentePorPNFController::class, 'store'])->name('docentesporpnf.store')->middleware('can:docentesporpnf.store');
Route::get('/docentesporpnf/{docentePorPNF}/edit', [DocentePorPNFController::class, 'edit'])->name('docentesporpnf.edit')->middleware('can:docentesporpnf.edit');
Route::put('/docentesporpnf/{docentePorPNF}', [DocentePorPNFController::class, 'update'])->name('docentesporpnf.update')->middleware('can:docentesporpnf.update');
Route::delete('/docentesporpnf/{docentePorPNF}', [DocentePorPNFController::class, 'destroy'])->name('docentesporpnf.destroy')->middleware('can:docentesporpnf.destroy');

/// Rutas para el controlador SeccionController
Route::get('/secciones', [SeccionController::class, 'index'])->name('secciones.index')->middleware('can:secciones.index');
Route::get('/secciones/create', [SeccionController::class, 'create'])->name('secciones.create')->middleware('can:secciones.create');
Route::post('/secciones', [SeccionController::class, 'store'])->name('secciones.store')->middleware('can:secciones.store');
Route::get('/secciones/{seccion}/edit', [SeccionController::class, 'edit'])->name('secciones.edit')->middleware('can:secciones.edit');
Route::put('/secciones/{seccion}', [SeccionController::class, 'update'])->name('secciones.update')->middleware('can:secciones.update');
Route::delete('/secciones/{seccion}', [SeccionController::class, 'destroy'])->name('secciones.destroy')->middleware('can:secciones.destroy');


    Route::get('/unidad_curricular/trayectos/{pnfId}', [UnidadCurricularController::class, 'getTrayectosPorPnf'])->name('unidad_curricular.getTrayectosPorPnf');
    Route::get('/unidad_curricular/unidades/{pnf}/{trayecto}', [UnidadCurricularController::class, 'getUnidadesPorTrayecto'])->name('unidad_curricular.getUnidadesPorTrayecto');

    // Dashboard protegido
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});
