<?php

namespace App\Http\Controllers;

use App\Models\InsumoToProducto;
use App\Http\Requests\StoreInsumoToProductoRequest;
use App\Http\Requests\UpdateInsumoToProductoRequest;
use App\Models\Helpers;
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
            InsumoToProducto::create($request->all());
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
    public function destroy(InsumoToProducto $insumoToProducto)
    {
        try {

            /** Eliminamos */
            $insumoToProducto->delete();
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
