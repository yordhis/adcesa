<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\{
    User,
    DataDev,
    Helpers,
    Permiso,
    Role
};

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        try {
            $respuesta = DataDev::$respuesta;
            $usuarios = Helpers::getUsuarios();
            return view('admin.usuarios.lista', compact('respuesta', 'usuarios'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos de usuarios en el metodo index,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function create()
    {
        try {
            $respuesta = DataDev::$respuesta;
            $roles = Role::where('estatus', 1)->get();
            return view('admin.usuarios.crear', compact('respuesta', 'roles'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos de usuarios en el metodo create,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $estatusCreate = 0;

            // Seteamos la foto
            if (isset($request->file)) {
                $request['foto'] = Helpers::setFile($request);
            }
            // Encriptamos la contraseña
            $request['password'] = Hash::make($request['password']);

            // Creamos el usuario
            $estatusCreate = User::create($request->all());

            $mensaje = $estatusCreate ? "El Usuario se Registró correctamente."
                : "El nombre de Usuario ¡Ya existe!, Cambie el nombre.";
            $estatus = $estatusCreate ? Response::HTTP_CREATED
                : Response::HTTP_CONFLICT;

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Registrar los datos de usuarios en el metodo store,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function show(User $user)
    {
        $mensaje = "Esta ruta no existe.";
        $estatus = Response::HTTP_NOT_FOUND;
        return back()->with(compact('mensaje', 'estatus'));
    }

    public function edit(User $user)
    {

        try {
            $respuesta = DataDev::$respuesta;
            $roles = Role::where('estatus', 1)->get();
            return view('admin.usuarios.editar', compact('user', 'roles', 'respuesta'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de consula,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        try {
            
            // Validamos si se envio una foto
            if (isset($request->file)) {
                // Eliminamos la imagen anterior
                $fotoActual = explode('/', $user->foto);
                if ($fotoActual[count($fotoActual) - 1] != 'default.jpg') {
                    Helpers::removeFile($user->foto);
                }
                // Insertamos la nueva imagen o archivo
                $request['foto'] = Helpers::setFile($request);
            } else {
                $request['foto'] = $user->foto;
            }

            // Encriptamos la contraseña
            if (isset($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            } else {
                $request['password'] = $user['password'];
            }

            // Actualizamos el usuario
                $user->update($request->all());
                $mensaje = "El Usuario se Actualizó correctamente.";
                $estatus = Response::HTTP_OK;
                return back()->with( compact('mensaje', 'estatus') );
            
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de al intentar Actualizar un usuario,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function destroy(User $user)
    {
        try {
            $estatus = $user->delete() ? Response::HTTP_OK : Response::HTTP_CONFLICT;
            $mensaje = "El usuario fue eliminó correctamente.";

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de al intentar Eliminar un usuario,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }
}
