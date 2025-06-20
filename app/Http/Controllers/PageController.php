<?php

namespace App\Http\Controllers;

use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Insumo;
use App\Models\InsumoToProducto;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Variante;
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
             $medidas = Medida::orderBy('nombre', 'ASC')->get();
            $producto = Producto::findOrFail($id);
            $producto['variantes'] = Variante::where('id_producto', '=', $producto->id)->get();
            $producto['insumos'] = InsumoToProducto::where('id_producto', '=', $producto->id)->get();

            foreach ($producto['insumos'] as $key => $insumo) {
                $insumo['nombre'] = Insumo::find($insumo->id_insumo)->nombre;
            }

            foreach ($producto['variantes'] as $key => $variante) {
                $variante['area'] = $variante->alto * $variante->ancho;
                $variante['medida'] = $medidas->find($variante->id_medida)->nombre;
                $variante['simbolo'] = $medidas->find($variante->id_medida)->simbolo;
            }

            $respuesta = DataDev::$respuesta;
            return view('page.pedidos.index', compact('respuesta', 'producto', 'request'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de crear pedido');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
