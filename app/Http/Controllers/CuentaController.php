<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Http\Requests\StoreCuentaRequest;
use App\Http\Requests\UpdateCuentaRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class CuentaController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de Cuentas
     */
    public function index(Request $request)
    {
        try {
            if ($request->filtro || $request->order) {
                $cuentas = Cuenta::where('nombre_banco', 'like',  "%$request->filtro%")
                    ->orderBy('nombre_banco', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            } else {
                $cuentas = Cuenta::orderBy('nombre_banco', 'ASC')
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }
            return view('admin.cuentas.index', compact('cuentas', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de Cuenta');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las Cuentas
     */
    public function store(StoreCuentaRequest $request)
    {
        try {
            $request['metodo'] = Strings::upper($request->metodo);
            $request['nombre_banco'] = Strings::upper($request->nombre_banco);
            $request['titular'] = Strings::upper($request->titular);

            Cuenta::create($request->all());
            $mensaje = "Cuenta creada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al crear Cuenta');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la Cuenta
     */
    public function update(UpdateCuentaRequest $request, Cuenta $cuenta)
    {
        try {
            $request['metodo'] = Strings::upper($request->metodo);
            $request['nombre_banco'] = Strings::upper($request->nombre_banco);
            $request['titular'] = Strings::upper($request->titular);
            $cuenta->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar Cuenta');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la Cuenta
     * si no esta relacionada
     */
    public function destroy(Cuenta $cuenta)
    {
        try {

            /** Eliminamos */
            $cuenta->delete();
            $mensaje = "Cuenta eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar Cuenta');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Cuentaes.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Cuentaes.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.Cuentaes.index')->with(compact('mensaje', 'estatus'));
    }
}
