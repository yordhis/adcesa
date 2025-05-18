<?php

namespace App\Http\Controllers;

use App\Models\RepresentanteEstudiante;
use App\Http\Requests\StoreRepresentanteEstudianteRequest;
use App\Http\Requests\UpdateRepresentanteEstudianteRequest;
use App\Models\Helpers;
use Illuminate\Http\Response;

class RepresentanteEstudianteController extends Controller
{

    public function store(StoreRepresentanteEstudianteRequest $request)
    {

        try {
            RepresentanteEstudiante::create([
                "cedula_estudiante" => $request->rep_cedula_estudiante,
                "cedula_representante" => $request->rep_cedula
            ]);

            $estatus = Response::HTTP_OK;
            $mensaje = "El representante fue asignado correctamente.";
            return back()->with(compact('mensaje', 'estatus'));

        } catch (\Throwable $th) {
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            $mensaje = Helpers::getMensajeError($th, "¡Error interno al intentar asignar el representante al estudiante.!");
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function destroy($representanteEstudiante)
    {
        try {
            RepresentanteEstudiante::where('id', $representanteEstudiante)->delete();
            $estatus = Response::HTTP_OK;
            $mensaje = "El representante fue desasignado correctamente.";
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            $mensaje = Helpers::getMensajeError($th, ', ¡Error interno al intentar desasignar el representante!.');
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
