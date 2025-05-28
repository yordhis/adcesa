<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\DataDev;
use App\Models\Permiso;
use App\Models\RolPermiso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        //
    }


    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
