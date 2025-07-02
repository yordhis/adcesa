<?php

namespace App\Http\Controllers;

use App\Models\InsumoToProducto;
use App\Http\Requests\StoreInsumoToProductoRequest;
use App\Http\Requests\UpdateInsumoToProductoRequest;
use App\Models\Helpers;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InsumoToProductoController extends Controller
{

    /**
     * Método que crea las variantes
     */
    public function store(StoreInsumoToProductoRequest $request)
    {
        try {
            /** Validar que no se añada el mismo insumo dos vesces */
            $asignacionExiste = InsumoToProducto::where('id_producto', $request->input('id_producto'))
                ->where('id_insumo', $request->input('id_insumo'))->first();
            if ($asignacionExiste) {
                $mensaje = "El producto ya tiene asignado el insumo, por favor intente con otro.";
                $estatus = Response::HTTP_CONFLICT;
                return back()->with(compact('mensaje', 'estatus'));
            }

            /** Asignar el insumo a la tabla pibote */
            InsumoToProducto::create($request->all());

            /** Actualizar el estatus del producto para publicarlo */
            Producto::where('id', $request->input('id_producto'))->update(["estatus" => "ACTIVO"]);

            /** Respuesta */
            $mensaje = "Insumo asignado correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al asignar insumo al producto');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la variante
     */
    public function update(UpdateInsumoToProductoRequest $request, InsumoToProducto $insumoToProducto)
    {
        try {
            $insumoToProducto->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar asignacion de insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la variante
     * si no esta relacionada
     */
    public function destroy($id)
    {
        try {
            $insumoToProducto = InsumoToProducto::find($id);
            /** Eliminamos */
            $insumoToProducto->delete();

            /** verificamos si el producto tienen almenos un 
             * insumo asignado sino para desactivar el producto */
            $insumosDelProducto = InsumoToProducto::where('id_producto', $insumoToProducto->id_producto)->get();

            if (!count($insumosDelProducto)) {
                Producto::where('id', $insumoToProducto->id_producto)->update(["estatus" => "INACTIVO"]);
            }

            $mensaje = "Insumo desasignado correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar asignacion de insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    public function index(Request $request)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }
    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }
}
