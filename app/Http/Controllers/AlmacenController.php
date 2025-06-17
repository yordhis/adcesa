<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class AlmacenController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de almacens
     */
    public function index(Request $request)
    {
        try {
            if ($request->filtro || $request->order) {
                $almacenes = Almacen::where('nombre', 'like',  "%$request->filtro%")
                    ->orderBy('nombre', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            } else {
                $almacenes = Almacen::orderBy('nombre', 'ASC')
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }
            return view('admin.almacenes.index', compact('almacenes', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la viata de almacen');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las almacenes
     */
    public function store(StoreAlmacenRequest $request)
    {
        try {
             
            $request['nombre'] = Strings::upper($request->nombre);
            Almacen::create($request->all());
            $mensaje = "Almacen creado correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear almacen');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la almacen
     */
    public function update(UpdateAlmacenRequest $request, Almacen $almacen)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            $almacen->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar almacen');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la almacen
     * si no esta relacionada
     */
    public function destroy(Almacen $almacen)
    {
        try {

            /** Eliminamos */
            $almacen->delete();
            $mensaje = "Almacen eliminado correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar almacen');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.almacenes.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.almacenes.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.almacenes.index')->with(compact('mensaje', 'estatus'));
    }
}
