<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ClienteController,
    UserController,
    DashboardController,
    PagoController,
    InsumoController,
    LoginController,
    PageController,
    PermisoController,
    RoleController
};


/*
|--------------------------------------------------------------------------
| Rutas de la tienda online
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'index'])->name('page.index');

Route::controller(PageController::class)->group(function () {
    Route::get('/preinscripcion/{codigo_nivel?}', 'create')->name('page.preinscripcion.index');
    Route::get('/preinscripcion/estudiante/{codigo_nivel?}/{codigo_plan?}', 'createEstudiante')->name('page.preinscripcion.estudiante');
    Route::post('/preinscripcion/registrar/estudiante', 'store')->name('page.preinscripcion.estudiante.store');
    Route::post('/preinscripcion/asignar/estudiante', 'asignarEstudianteExistente')->name('page.preinscripcion.asignar.estudiante');
    Route::post('/preinscripcion/registrar/representante', 'storeRepresentante')->name('page.registrar.representante');
    Route::get('/preinscripcion/asignar/representante', 'asignarRepresentante')->name('page.asignar.representante');
});

/** Rutas de usuario logeado */
Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'index'])->name('page.home');
})->prefix('tienda');

/*
|--------------------------------------------------------------------------
| Rutas para iniciar y cerrar sesión.
|--------------------------------------------------------------------------
*/
Route::get('/entrar', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas del sistema
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {
    /** Panel principal */
    Route::get('/panel', [DashboardController::class, 'index'])->name('admin.panel.index');

    /** Usuarios */
    Route::resource('/users', UserController::class)->names('admin.users');

    /** Roles */
    Route::resource('/roles', RoleController::class)->names('admin.roles');

    /** Permisos */
    Route::resource('/permisos', PermisoController::class)->names('admin.permisos');

    /** Rutas de Clientes */
    Route::resource('/clientes', ClienteController::class)->names('admin.clientes');

    /** Rutas de Niveles de estudio */
    Route::resource('/insumos', InsumoController::class)->names('admin.insumos');

    /** Rutas de Planes de pago */
    Route::resource('/pagos', PagoController::class)->names('admin.pagos');

});
