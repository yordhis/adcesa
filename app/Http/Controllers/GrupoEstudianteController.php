<?php

namespace App\Http\Controllers;

use App\Models\{
    Grupo,
    GrupoEstudiante,
    Nivele,
    Profesore,
    DataDev,
    Helpers
};
use App\Http\Requests\StoreGrupoEstudianteRequest;
use App\Http\Requests\UpdateGrupoEstudianteRequest;
use Illuminate\Http\Response;

class GrupoEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('admin.grupos.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoEstudiante  $grupoEstudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoEstudiante $grupoEstudiante)
    {
        try {
            $grupoEstudiante->delete();
            $mensaje = "El estudiante fue eliminado del grupo correctamente";
            return back()->with([
                "mensaje" => $mensaje,
                "estatus" => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Eliminar el estudiante del grupo en el método destroy,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
