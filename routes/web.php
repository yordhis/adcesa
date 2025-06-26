<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AlmacenController,
    CategoriaController,
    ClienteController,
    UserController,
    DashboardController,
    PagoController,
    InsumoController,
    InsumoToProductoController,
    LoginController,
    MarcaController,
    MedidaController,
    PageController,
    PedidoController,
    PermisoController,
    ProductoController,
    RoleController,
    VarianteController
};


/*
|--------------------------------------------------------------------------
| Rutas de la tienda online
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::post('/tienda/crear/cuenta', [ClienteController::class, 'store'])->name('page.clientes.crear.cuenta');
Route::get('/tienda/registro', [PageController::class, 'crearSesion'])->name('page.clientes.crear.sesion');
Route::get('/tienda/pedidos/{servicio_id}', [PageController::class, 'createPedido'])->name('page.crear.pedido');
Route::post('/tienda/pedidos', [PageController::class, 'storePedido'])->name('page.store.pedido');
Route::get('/tienda/agregar/carrito/{producto_id}', [PageController::class, 'agregarCarrito'])->name('page.agregar.carrito');

/** Rutas de usuario cliente logeado */
Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'index'])->name('page.home');
    Route::get('/perfil/{idCliente}', [PageController::class, 'mostraPerfil'])->name('page.cliente.perfil');
    Route::put('/perfil/{idCliente}', [ClienteController::class, 'update'])->name('page.clientes.update');
    Route::put('/perfil/edit/password/{idCliente}', [ClienteController::class, 'editPassword'])->name('page.clientes.update.password');
})->prefix('tienda');

/*
|--------------------------------------------------------------------------
| Rutas para iniciar y cerrar sesión.
|--------------------------------------------------------------------------
*/
Route::get('/entrar', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
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

    /** Rutas de productos */
    Route::resource('/productos', ProductoController::class)->names('admin.productos');

    /** Rutas de Marcas */
    Route::resource('/marcas', MarcaController::class)->names('admin.marcas');

    /** Rutas de Almacenes */
    Route::resource('/almacens', AlmacenController::class)->names('admin.almacenes');

    /** Rutas de Medidas */
    Route::resource('/medidas', MedidaController::class)->names('admin.medidas');

    /** Rutas de variantes */
    Route::resource('/variantes', VarianteController::class)->names('admin.variantes');

    /** Rutas de insumostoproductos */
    Route::resource('/insumotoproductos', InsumoToProductoController::class)->names('admin.insumostoproductos');

    /** Rutas de Categorias */
    Route::resource('/categorias', CategoriaController::class)->names('admin.categorias');

    /** Rutas de Pagos */
    Route::resource('/pagos', PagoController::class)->names('admin.pagos');

    /** Rutas de Pedidos */
    Route::post('/pedidos/buscar-cliente', [PedidoController::class, 'buscarCliente'])->name('admin.pedidos.buscar.cliente');
    Route::post('/pedidos/buscar-producto', [PedidoController::class, 'buscarProducto'])->name('admin.pedidos.buscar.producto');
    Route::resource('/pedidos', PedidoController::class)->names('admin.pedidos');

});
