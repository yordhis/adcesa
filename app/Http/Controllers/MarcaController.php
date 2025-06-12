<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class MarcaController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de marcas
     */
    public function index(Request $request)
    {
        try {
            if ($request->filtro || $request->order) {
                $marcas = Marca::where('nombre', 'like',  "%$request->filtro%")
                    ->orderBy('nombre', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            } else {
                $marcas = Marca::orderBy('nombre', 'ASC')
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }
            return view('admin.marcas.index', compact('marcas', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la viata de marca');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las marcas
     */
    public function store(StoreMarcaRequest $request)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            Marca::create($request->all());
            $mensaje = "Marca creada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear marca');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la marca
     */
    public function update(UpdateMarcaRequest $request, Marca $marca)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            $marca->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar marca');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la marca
     * si no esta relacionada
     */
    public function destroy(Marca $marca)
    {
        try {
            // return $marca;
            /** Validamos que esta marca no este siendo usada */
            // code

            /** Eliminamos */
            $marca->delete();
            $mensaje = "Marca eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar marca');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.marcas.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.marcas.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.marcas.index')->with(compact('mensaje', 'estatus'));
    }
}
