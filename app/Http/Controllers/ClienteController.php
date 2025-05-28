<?php

namespace App\Http\Controllers;

use App\Models\DataDev;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
 
    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $clientes = User::where('rol', 3)->paginate(12);
            if ($request->filtro) {
                return $request->filtro;
                $clientes = User::where('rol', 3)
                ->orWhere('nombres')
                ->paginate(12);
            }
            return view('admin.clientes.index', compact('clientes', 'request', 'respuesta'));
            
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar cliente.';
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
