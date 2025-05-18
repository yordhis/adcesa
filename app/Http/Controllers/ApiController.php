<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\{
    Estudiante,
    Helpers,
    Grupo,
    Inscripcione,
    Plane
};
use Carbon\Carbon;

class ApiController extends Controller
{

    /** Crear las cuotas */
    public function createCuotas(Request $request)
    {
        try {
            $cuotas = [];
            $montoPorCuota = $request->nivel['precio'] / $request->plan['cantidad_cuotas'];
    
            for ($i = 0; $i < $request->plan['cantidad_cuotas']; $i++) {
                $fecha = Carbon::now("America/Caracas");
                $fecha = $fecha->add($i*$request->plan['plazo'], 'day');
                array_push($cuotas, [
                    "id" => $i+1,
                    "fecha" => $fecha,
                    "monto" => $montoPorCuota
                ]);
            }
            return Helpers::getRespuestaJson('consulta con exito',  $cuotas);
      
        } catch (\Throwable $th) {
            return Helpers::getRespuestaJson('¡Error interno!',  $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    /** Obtenemos un nuevo codigo de inscripcion */
    public function getCodigoInscripcion($incrementar)
    {
        try {
            $codigo = Helpers::getCodigo('inscripciones', intval($incrementar));
            return Helpers::getRespuestaJson("Consulta de nuevo código exitosa", $codigo);
        } catch (\Throwable $th) {
            return Helpers::getRespuestaJson("¡Error interno!: " . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getRepresentante($cedula)
    {
        try {

            $representante = Helpers::getRepresentante($cedula);
            $mensaje = count($representante) ? "Consulta exitosa" : "No hay resultados";
            $estatus = count($representante) ?  Response::HTTP_OK : Response::HTTP_NOT_FOUND;
            if (count($representante)) $representante = $representante[0];
            return Helpers::getRespuestaJson($mensaje, $representante, $estatus);
        } catch (\Throwable $th) {
            return Helpers::getRespuestaJson(
                "¡Error interno!:" . $th->getMessage(),
                [],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getEstudiante($cedula)
    {
        try {
            $estudiante = Helpers::getEstudiante($cedula);

            $mensaje = $estudiante ? "Consulta exitosa" : "No hay resultados";
            $estatus = $estudiante ?  Response::HTTP_OK : Response::HTTP_NOT_FOUND;
            return Helpers::getRespuestaJson($mensaje, $estudiante, $estatus);
        } catch (\Throwable $th) {
            return Helpers::getRespuestaJson("¡Error interno!: " .  $th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getPlan($codigo)
    {
        try {
            $plan = Plane::where('codigo', $codigo)->get();
            $mensaje = count($plan) ? "Consulta exitosa" : "No hay resultados";
            $estatus = count($plan) ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

            if (count($plan)) $plan = $plan[0];

            return Helpers::getRespuestaJson($mensaje, $plan, $estatus);
        } catch (\Throwable $th) {
            return Helpers::getRespuestaJson("¡Error interno!: " .  $th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getGrupo($codigo)
    {
        try {
            $grupo = Helpers::addDatosDeRelacion(Grupo::where('codigo', $codigo)->get(), [
                "niveles" => "codigo_nivel",
                "profesores" => "cedula_profesor"
            ]);
            $mensaje = count($grupo) ? "Consulta exitosa" : "No hay resultados";
            $estatus = count($grupo) ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

            if (count($grupo)) $grupo = Helpers::setMAtricula($grupo)[0];

            return Helpers::getRespuestaJson($mensaje, $grupo, $estatus);
        } catch (\Throwable $th) {
            return Helpers::getRespuestaJson("¡Error interno!: " .  $th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

   
}
