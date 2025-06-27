<?php

namespace App\Http\Controllers;

use App\Models\Tasa;
use App\Http\Requests\StoreTasaRequest;
use App\Http\Requests\UpdateTasaRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TasaController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de Tasas
     */
    public function index(Request $request)
    {
        try {
            $tasas = Tasa::all();
            $respuesta = DataDev::$respuesta;
            return view('admin.tasas.index', compact('tasas', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de Tasa');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las Tasas
     */
    public function store(StoreTasaRequest $request)
    {
        try {
            $tasas = Tasa::all();
            if (count($tasas)) {
                $mensaje = "Ya se creo una tasa";
                $estatus = Response::HTTP_UNAUTHORIZED;
                return back()->with(compact('mensaje', 'estatus'));
            }

            Tasa::create($request->all());
            $mensaje = "Tasa creada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear Tasa');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la Tasa
     */
    public function update(UpdateTasaRequest $request, Tasa $tasa)
    {
        try {
            $tasa->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar Tasa');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la Tasa
     * si no esta relacionada
     */
    public function destroy(Tasa $tasa)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Tasaes.index')->with(compact('mensaje', 'estatus'));
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Tasaes.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Tasaes.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Tasaes.index')->with(compact('mensaje', 'estatus'));
    }
}
