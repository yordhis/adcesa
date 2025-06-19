<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Permiso;
use App\Models\RolPermiso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $roles = Role::orderBy('nombre', 'DESC')
                ->paginate($request->input('limit', 12));

            foreach ($roles as $key => $rol) {
                $rol->permisos = RolPermiso::where('id_rol', $rol->id)
                    ->join('permisos', 'permisos.id', '=', 'rol_permisos.id_permiso')
                    ->select(
                        'rol_permisos.*',
                        'permisos.nombre as permiso'
                    )
                    ->get();
            }
            $roles;
            $permisos = Permiso::where('estatus', 1)->get();

            return view('admin.roles.index', compact('roles', 'permisos', 'respuesta', 'request'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar roles.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    public function store(StoreRoleRequest $request)
    {
        try {
            $request['nombre'] = Strings::upper($request->nombre);
            /** crear el rol */
            $rol = Role::create($request->all());

            /** convertimos los input permisos en array para poder recorrerlos */
            $permisosArray = Helpers::getArrayInputs($request->all(), 'per');
            /** asignamos los permisos al rol */
            if ($permisosArray) {
                foreach ($permisosArray as $permisoId) {
                    RolPermiso::create([
                        'id_rol' => $rol->id,
                        'id_permiso' => $permisoId
                    ]);
                }
            }

            $mensaje = 'Rol creado exitosamente.';
            $estatus = Response::HTTP_CREATED;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al crear un roles.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos del rol
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {

            $request['nombre'] = Strings::upper($request->nombre);
            $role->update($request->all());
            
            /** eliminamos todos los permisos */
            RolPermiso::where('id_rol', '=', $role->id)->delete();
            
            $permisosArray = Helpers::getArrayInputs($request->all(), 'per');
            /** Volvemos a asignar los permisos */
            foreach ($permisosArray as $permisoId) {
                RolPermiso::create([
                    'id_rol' => $role->id,
                    'id_permiso' => $permisoId
                ]);
            }

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
    public function destroy(Role $role)
    {
        try {
            /** Validamos que el rol no este en uso */
            $rolEnUso = User::where('rol', $role->id)->exists();
            if (!$rolEnUso) {
                $mensaje = "No se puede eliminar el rol porque está en uso.";
                $estatus = Response::HTTP_CONFLICT;
                return back()->with(compact('mensaje', 'estatus'));
            }

            // eliminar permisos asignados al rol
            RolPermiso::where('id_rol', '=', $role->id)->delete();

            /** Eliminamos */
            $role->delete();

            $mensaje = "Rol eliminado correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar rol');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.roles.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.roles.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.roles.index')->with(compact('mensaje', 'estatus'));
    }
}
