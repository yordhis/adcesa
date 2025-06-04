<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Http\Requests\StoreInsumoRequest;
use App\Http\Requests\UpdateInsumoRequest;
use App\Models\Categoria;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InsumoController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de insumos
     */
    public function index(Request $request)
    {
        try {
            $marcas = Marca::orderBy('nombre', 'ASC')->get();
            $categorias = Categoria::orderBy('nombre', 'ASC')->get();
            if ($request->filtro || $request->order) {
                $insumos = Insumo::where('nombre', 'like',  "%$request->filtro%")
                ->orderBy('nombre', $request->input('order', 'ASC'))
                ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }else{
                $insumos = Insumo::orderBy('nombre', 'ASC')
                ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }
            return view('admin.insumos.index', compact('insumos','categorias', 'marcas','request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las insumos
     */
    public function store(StoreInsumoRequest $request)
    {
        try {
            Insumo::create($request->all());
            $mensaje = "insumo creada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la insumo
     */
    public function update(UpdateInsumoRequest $request, Insumo $insumo)
    {
        try {
            $insumo->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la insumo
     * si no esta relacionada
     */
    public function destroy(Insumo $insumo)
    {
        try {
            // return $insumo;
            /** Validamos que esta insumo no este siendo usada */
            // code

            /** Eliminamos */
            $insumo->delete();
            $mensaje = "insumo eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
