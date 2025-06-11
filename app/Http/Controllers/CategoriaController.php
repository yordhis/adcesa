<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class CategoriaController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de categorias
     */
    public function index(Request $request)
    {
        try {
            if ($request->filtro || $request->order) {
                $categorias = Categoria::where('nombre', 'like',  "%$request->filtro%")
                    ->orderBy('nombre', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            } else {
                $categorias = categoria::orderBy('nombre', 'ASC')
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }
            return view('admin.categorias.index', compact('categorias', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la viata de categoria');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las categorias
     */
    public function store(StoreCategoriaRequest $request)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            Categoria::create($request->all());
            $mensaje = "categoria creada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear categoria');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la categoria
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            $categoria->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar categoria');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la categoria
     * si no esta relacionada
     */
    public function destroy(Categoria $categoria)
    {
        try {
            // return $categoria;
            /** Validamos que esta categoria no este siendo usada */
            // code

            /** Eliminamos */
            $categoria->delete();
            $mensaje = "categoria eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar categoria');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
