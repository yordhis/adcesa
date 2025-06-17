<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use App\Http\Requests\StoreMedidaRequest;
use App\Http\Requests\UpdateMedidaRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class MedidaController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de medidas
     */
    public function index(Request $request)
    {
        try {
            if ($request->filtro || $request->order) {
                $medidas = Medida::where('nombre', 'like',  "%$request->filtro%")
                    ->orderBy('nombre', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            } else {
                $medidas = Medida::orderBy('nombre', 'ASC')
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }
            return view('admin.medidas.index', compact('medidas', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de medida');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las medidas
     */
    public function store(StoreMedidaRequest $request)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            $request['simbolo'] = Strings::upper($request->simbolo);

            Medida::create($request->all());
            $mensaje = "Medida creada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear medida');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la medida
     */
    public function update(UpdateMedidaRequest $request, Medida $medida)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            $request['simbolo'] = Strings::upper($request->simbolo);
            $medida->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar medida');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la medida
     * si no esta relacionada
     */
    public function destroy(Medida $medida)
    {
        try {

            /** Eliminamos */
            $medida->delete();
            $mensaje = "medida eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar medida');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.medidaes.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.medidaes.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.medidaes.index')->with(compact('mensaje', 'estatus'));
    }
}
