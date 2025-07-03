<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\{
    Cuota,
    Dashboard,
    DataDev,
    Estudiante,
    Grupo,
    GrupoEstudiante,
    Insumo,
    Pago,
    Pedido,
    Producto,
    Profesore,
    Role,
    User
};
use Illuminate\Container\Attributes\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        // return session('permisos');
        // return $user = auth()->user();
        $rolCliente = Role::where('nombre', 'CLIENTE')->first()->id;
        $respuesta = DataDev::$respuesta;
        $dataTarjetas = [
            "productos" => Producto::count(),
            "insumos" => Insumo::count(),
            "clientes" => User::where('rol', $rolCliente)->count(),
            "pedidos" => Pedido::where('estatus', 'PENDIENTE')->count(),
            "pedidos_entregado" => Pedido::where('estatus', 'ENTREGADO')->count(),
            "pedidos_enproceso" => Pedido::where('estatus', 'EN PROCESO')->count(),
        ];
        return view('admin.dashboard', compact('dataTarjetas', 'respuesta'));
    }
}
