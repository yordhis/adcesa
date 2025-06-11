<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWebRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Strings;

class ClienteController extends Controller
{
 
    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            if ($request->filtro) {
                $clientes = User::where('rol', '=', 3)
                ->orWhere('nombres', 'like',  "%$request->filtro%")
                ->paginate(12);
            }else{
                 $clientes = User::where('rol', '=', 3)->paginate(12);
            }
            return view('admin.clientes.index', compact('clientes', 'request', 'respuesta'));
            
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar cliente.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

     /**
     * Método que crea las insumos
     */
    public function store(StoreUserWebRequest $request)
    {
        try {
         
            /** Completar datos */
            $request['nombres'] = Strings::upper($request->nombres);
            $request['apellidos'] = Strings::upper($request->apellidos);
            $request['direccion'] = Strings::upper($request->direccion);
            $request['pais'] = Strings::upper($request->pais ?? '');
            $request['estado'] = Strings::upper($request->estado ?? '');
            $request['ciudad'] = Strings::upper($request->ciudad ?? '');
            $request['password'] = Hash::make(12345678);


            /** Insertamos la imagen y obtenermos la url para guardar en la DB */
            if ($request->file) {
                $request['foto'] = Helpers::setFile($request);
            }

            /** Ejecutamos el guardado del insumo */
            User::create($request->all());

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "Cuenta de usuario creada correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** Mensaje de error en la misma vista */
            $mensaje = Helpers::getMensajeError($th, 'Error al crear cuenta de usuario.');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cliente = User::findOrFail($id);
            $cliente->delete();
    
            $mensaje = 'Cliente eliminado correctamente.';
            $estatus = Response::HTTP_OK;
    
            // Redireccionar a la lista de clientes con un mensaje de éxito
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al eliminar cliente.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
