<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWebRequest;
use App\Http\Requests\UpdateUserWebRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Role;
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
            $clientes = [];
            if ($request->filtro || $request->order) {
                $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                    ->select('users.*', 'roles.nombre as rol_nombre')
                    ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                    ->where('nombres', 'like',  "%$request->filtro%")
                    ->orderBy('nombres', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));

                if (!count($clientes)) {
                    $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                        ->select('users.*', 'roles.nombre as rol_nombre')
                        ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                        ->where('apellidos', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($clientes)) {
                    $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                        ->select('users.*', 'roles.nombre as rol_nombre')
                        ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                        ->where('email', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($clientes)) {
                    $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                        ->select('users.*', 'roles.nombre as rol_nombre')
                        ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                        ->where('cedula', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
            } else {
                $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                    ->select('users.*', 'roles.nombre as rol_nombre')
                    ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                    ->orderBy('nombres', 'ASC')
                    ->paginate($request->input('limit', 12));
            }

            return view('admin.clientes.index', compact('clientes', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar cliente.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que crea cuentas de clientes
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
            $request['rol'] = Role::where('nombre', 'CLIENTE')->first()->id;


            /** Insertamos la imagen y obtenermos la url para guardar en la DB */
            if ($request->file) {
                $request['foto'] = Helpers::setFile($request);
            }

            /** Ejecutamos el guardado del cliente */
            User::create($request->all());

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "Cuenta de usuario creada correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            if($request->input('desdeLaWeb', false)){
                
                return back()->with(compact('mensaje', 'estatus'));
            }

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** Mensaje de error en la misma vista */
            $mensaje = Helpers::getMensajeError($th, 'Error al crear cuenta de usuario.');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que actualiza los datos de la insumo
     */
    public function update(UpdateUserWebRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                /** Validar correo si se editó y que no se repita el correo */
                if ($request->email) {
                    if ($request->email != $user->email) {
                        $emailExiste = User::where('email', '=', $request->email)->first();
                        if ($emailExiste) {
                            $mensaje = "E-mail ya registrado en otra cuenta, por favor intente con otro!";
                            $estatus = Response::HTTP_BAD_REQUEST;
                            return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
                        }
                    }
                }

                /** Completar datos */
                $request['nombres'] = Strings::upper($request->nombres);
                $request['apellidos'] = Strings::upper($request->apellidos);
                $request['direccion'] = Strings::upper($request->direccion);
                $request['pais'] = Strings::upper($request->pais ?? '');
                $request['estado'] = Strings::upper($request->estado ?? '');
                $request['ciudad'] = Strings::upper($request->ciudad ?? '');


                /** Verificamos si enviaron una imagen nueva */
                if ($request->file) {
                    Helpers::removeFile($user->foto);
                    $request['foto'] = Helpers::setFile($request);
                }

                /** ejecutar la actualización */
                $user->update($request->all());
                $mensaje = "Datos actualizados correctamente";
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                $mensaje = "Usuario no encontrado";
                $estatus = Response::HTTP_NOT_FOUND;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que eliminas cuentas de usuarios clientes
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

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.clientes.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.clientes.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.clientes.index')->with(compact('mensaje', 'estatus'));
    }
}
