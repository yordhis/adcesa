<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoriaController,
    ClienteController,
    UserController,
    DashboardController,
    PagoController,
    InsumoController,
    LoginController,
    MarcaController,
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

/** Rutas de usuario cliente logeado */
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

    /** Rutas de Insumos */
    Route::resource('/insumos', InsumoController::class)->names('admin.insumos');

    /** Rutas de Marcas */
    Route::resource('/marcas', MarcaController::class)->names('admin.marcas');

    /** Rutas de Categorias */
    Route::resource('/categorias', CategoriaController::class)->names('admin.categorias');

    /** Rutas de Planes de pago */
    Route::resource('/pagos', PagoController::class)->names('admin.pagos');

});
