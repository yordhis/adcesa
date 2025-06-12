<?php

namespace App\Http\Controllers;

use App\Models\RolPermiso;
use App\Http\Requests\StoreRolPermisoRequest;
use App\Http\Requests\UpdateRolPermisoRequest;
use Illuminate\Http\Response;

class RolPermisoController extends Controller
{

    public function index()
    {
        //
    }

    public function store(StoreRolPermisoRequest $request)
    {
        //
    }

    public function update(UpdateRolPermisoRequest $request, RolPermiso $rolPermiso)
    {
        //
    }

    public function destroy(RolPermiso $rolPermiso)
    {
        //
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
