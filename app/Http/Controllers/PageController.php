<?php

namespace App\Http\Controllers;

use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    // Landinpage
    public function index(Request $request)
    {
        try {
            $productos = Producto::orderBy('created_at', 'desc')
                ->where('estatus', 'ACTIVO')
                ->get();
            $respuesta = DataDev::$respuesta;
            return view('page.home.index', compact('respuesta', 'productos', 'request'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /** muestra la vista de Crear pedido */
    public function createPedido(Request $request, $id)
    {
        try {
            $servicio = Producto::findOrFail($id);
            $respuesta = DataDev::$respuesta;
            return view('page.pedidos.index', compact('respuesta', 'servicio', 'request'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de crear pedido');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
