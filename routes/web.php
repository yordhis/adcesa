<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AlmacenController,
    CategoriaController,
    ClienteController,
    CuentaController,
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
    TasaController,
    VarianteController
};
use App\Models\DataDev;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Rutas de la tienda online
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::post('/tienda/crear/cuenta', [ClienteController::class, 'store'])->name('page.clientes.crear.cuenta');
Route::get('/tienda/registro', [PageController::class, 'crearSesion'])->name('page.clientes.crear.sesion');
Route::get('/tienda/pedidos/{servicio_id}', [PageController::class, 'createPedido'])->name('page.crear.pedido');
Route::post('/tienda/finalizar/pedido', [PageController::class, 'agregarAlCarrito'])->name('page.finalizar.pedido');
Route::post('/tienda/agregar/carrito', [PageController::class, 'agregarAlCarrito'])->name('page.agregar.carrito');
Route::post('/tienda/remover/carrito', [PageController::class, 'removerDelCarrito'])->name('page.remover.producto.carrito');
Route::get('/tienda/finalizar/pedido', [PageController::class, 'vistaFinalizarPedido'])->name('page.finalizar.pedido.vista');
Route::post('/tienda/registrar/pedido', [PageController::class, 'storePedido'])->name('page.pedidos.store');

/** Rutas de usuario cliente logeado */
Route::middleware(['perfil'])->group(function () {
    Route::get('/home', [PageController::class, 'index'])->name('page.home');
    Route::get('/perfil/{idCliente}', [PageController::class, 'mostraPerfil'])->name('page.cliente.perfil');
    Route::put('/perfil/{idCliente}', [ClienteController::class, 'update'])->name('page.clientes.update');
    Route::put('/perfil/edit/password/{idCliente}', [ClienteController::class, 'editPassword'])->name('page.clientes.update.password');
})->prefix('tienda');

/*
|--------------------------------------------------------------------------
| Restaurar contraseña
|--------------------------------------------------------------------------
*/

Route::get('/recuperar-calve', function () {
    $respuesta = DataDev::$respuesta;
    return view('recuperarcalve', compact('respuesta'));
})->middleware('guest')->name('recuperar.clave');




Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');




Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


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

    /** Rutas de Cuentas */
    Route::resource('/cuentas', CuentaController::class)->names('admin.cuentas');

    /** Rutas de Tasa */
    Route::resource('/tasas', TasaController::class)->names('admin.tasas');

    /** Rutas de Pedidos */
    Route::post('/pedidos/configurar/fechas', [PedidoController::class, 'configurarFechas'])->name('admin.pedidos.configurar.fechas');
    Route::post('/pedidos/marcar/como/entregado', [PedidoController::class, 'marcarComoEntregado'])->name('admin.pedidos.marcar.como.entregado');
    Route::resource('/pedidos', PedidoController::class)->names('admin.pedidos');
});
