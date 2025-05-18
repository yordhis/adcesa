<?php

namespace App\Models;

use App\Models\{
    Cuota,
    Dificultade,
    Estudiante,
    Grupo,
    GrupoEstudiante,
    User,
    RolPermiso,
    Permiso,
    Role,
    Inscripcione,
    Preinscripcione,
    Representante,
    RepresentanteEstudiante
};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Helpers extends Model
{
    use HasFactory;

    public static $estudiantes;
    public static $fechaCuota;

    public static function esMenorDeEdad($fecha_nacimiento)
    {
        return Carbon::parse($fecha_nacimiento)->age < 18;
    }

    /** Respuesta JSON */
    public static function getRespuestaJson($mensaje, $data = [], $estatus = Response::HTTP_OK)
    {
        return response()->json([
            "mensaje" => $mensaje,
            "data" => $data,
            "estatus" => $estatus
        ], $estatus);
    }

    public static function destroyData($cedulaEstudiante, $codigoInscripcion, $codigoGrupo, $autorizado)
    {
        /** Si viene codigo de inscripcion eliminamos todo lo que este relacionado con la inscripcion */
        if ($codigoInscripcion) {
            /** Eliminamos Las cuotas relaciondas con la inscripción */
            if ($autorizado['cuotas']) {
                Cuota::where([
                    "cedula_estudiante" => $cedulaEstudiante,
                    "codigo_inscripcion" => $codigoInscripcion
                ])->delete();
            }

            /** Eliminamos los pagos relacionads a la inscripción */
            if ($autorizado['pagos']) {
                $pagos = Pago::where([
                    "cedula_estudiante" => $cedulaEstudiante,
                    "codigo_inscripcion" => $codigoInscripcion
                ])->get();

                foreach ($pagos  as $key => $pago) {
                    FormaDePago::where('codigo_pago', $pago->codigo)->delete();
                    $pago->delete();
                }
            }

            // Eliminamos al estudiante del grupo
            if ($autorizado['grupoEstudiante']) {
                GrupoEstudiante::where([
                    "cedula_estudiante" => $cedulaEstudiante,
                    "codigo_grupo" => $codigoGrupo
                ])->delete();
            }

            // Eliminamos la inscripcion del estudiante
            if ($autorizado['inscripcione']) {
                Inscripcione::where([
                    "cedula_estudiante" => $cedulaEstudiante,
                    "codigo" => $codigoInscripcion
                ])->delete();
            }
        } else {
            /** estamos eliminando al estudiante del istema es decir que volaremos todo */

            // Eliminamos Las cuotas relacionads al estudiante en ese grupo
            if ($autorizado['cuotas']) {
                Cuota::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->delete();
            }

            // Eliminamos los pagos relacionads al estudiante en ese grupo e inscripcion
            if ($autorizado['pagos']) {
                $pagos = Pago::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->get();

                foreach ($pagos  as $key => $pago) {
                    FormaDePago::where('codigo_pago', $pago->codigo)->delete();
                    $pago->delete();
                }
            }

            // Eliminamos al estudiante del grupo
            if ($autorizado['grupoEstudiante']) {
                GrupoEstudiante::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->delete();
            }

            // Eliminamos la inscripcion del estudiante
            if ($autorizado['inscripcione']) {
                Inscripcione::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->delete();
            }
            // Eliminamos la inscripcion del estudiante
            if ($autorizado['preinscripcione']) {
                Preinscripcione::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->delete();
            }

            // Eliminamos la Representantes del estudiante
            if ($autorizado['representanteEstudiante']) {
                RepresentanteEstudiante::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->delete();
            }

            // Eliminamos la Representantes del estudiante
            if ($autorizado['dificultadEstudiante']) {
                DificultadEstudiante::where([
                    "cedula_estudiante" => $cedulaEstudiante
                ])->delete();
            }
        }
    }

    /** OPbtenemos toda la información de las inscripciones */
    public static function getInscripciones($request, $paginacion = 12)
    {
        $filtro = $request->filtro ? $request->filtro : false;
        $estatus = $request->estatus;
        $inscripciones = [];

        if ($filtro && $estatus) {

            $inscripciones = Inscripcione::join('grupos', 'grupos.codigo', '=', 'inscripciones.codigo_grupo')
                ->join('estudiantes', 'estudiantes.cedula', '=', 'inscripciones.cedula_estudiante')
                ->join('planes', 'planes.codigo', '=', 'inscripciones.codigo_plan')
                ->join('profesores', 'profesores.cedula', '=', 'grupos.cedula_profesor')
                ->join('niveles', 'niveles.codigo', '=', 'grupos.codigo_nivel')
                ->select(
                    'inscripciones.id',
                    'inscripciones.codigo',
                    'inscripciones.cedula_estudiante',
                    'inscripciones.codigo_grupo',
                    'inscripciones.codigo_plan',
                    'inscripciones.nota',
                    'inscripciones.extras',
                    'inscripciones.total',
                    'inscripciones.abono',
                    'inscripciones.fecha',
                    'inscripciones.estatus',
                    'grupos.codigo_nivel',
                    'grupos.cedula_profesor',
                    'grupos.nombre as grupo_nombre',
                    'grupos.dias as grupo_dias',
                    'grupos.hora_inicio as grupo_hora_inicio',
                    'grupos.hora_fin as grupo_hora_fin',
                    'grupos.fecha_inicio as grupo_fecha_inicio',
                    'grupos.fecha_fin as grupo_fecha_fin',
                    'grupos.estatus as grupo_estatus',
                    'profesores.nombre as grupo_profesor_nombre',
                    'profesores.nacionalidad as grupo_profesor_nacionalidad',
                    'profesores.edad as grupo_profesor_edad',
                    'profesores.telefono as grupo_profesor_telefono',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'planes.nombre as plan_nombre',
                    'planes.cantidad_cuotas as plan_cantidad_cuotas',
                    'planes.plazo as plan_plazo',
                    'planes.descripcion as plan_descripcion',
                    'estudiantes.nombre as estudiante_nombre',
                    'estudiantes.nacionalidad as estudiante_nacionalidad',
                    'estudiantes.telefono as estudiante_telefono',
                    'estudiantes.correo as estudiante_correo',
                    'estudiantes.nacimiento as estudiante_nacimiento',
                    'estudiantes.edad as estudiante_edad',
                    'estudiantes.direccion as estudiante_direccion',
                    'estudiantes.grado as estudiante_grado',
                    'estudiantes.ocupacion as estudiante_ocupacion',
                    'estudiantes.foto as estudiante_foto'
                )
                ->where('inscripciones.estatus', '=', $estatus)
                ->where('inscripciones.cedula_estudiante', '=', $filtro)
                ->orderBy('inscripciones.codigo', 'desc')
                ->paginate($paginacion);

            if (!count($inscripciones)) {
                $inscripciones = Inscripcione::join('grupos', 'grupos.codigo', '=', 'inscripciones.codigo_grupo')
                    ->join('estudiantes', 'estudiantes.cedula', '=', 'inscripciones.cedula_estudiante')
                    ->join('planes', 'planes.codigo', '=', 'inscripciones.codigo_plan')
                    ->join('profesores', 'profesores.cedula', '=', 'grupos.cedula_profesor')
                    ->join('niveles', 'niveles.codigo', '=', 'grupos.codigo_nivel')
                    ->select(
                        'inscripciones.id',
                        'inscripciones.codigo',
                        'inscripciones.cedula_estudiante',
                        'inscripciones.codigo_grupo',
                        'inscripciones.codigo_plan',
                        'inscripciones.nota',
                        'inscripciones.extras',
                        'inscripciones.total',
                        'inscripciones.abono',
                        'inscripciones.fecha',
                        'inscripciones.estatus',
                        'grupos.codigo_nivel',
                        'grupos.cedula_profesor',
                        'grupos.nombre as grupo_nombre',
                        'grupos.dias as grupo_dias',
                        'grupos.hora_inicio as grupo_hora_inicio',
                        'grupos.hora_fin as grupo_hora_fin',
                        'grupos.fecha_inicio as grupo_fecha_inicio',
                        'grupos.fecha_fin as grupo_fecha_fin',
                        'grupos.estatus as grupo_estatus',
                        'profesores.nombre as grupo_profesor_nombre',
                        'profesores.nacionalidad as grupo_profesor_nacionalidad',
                        'profesores.edad as grupo_profesor_edad',
                        'profesores.telefono as grupo_profesor_telefono',
                        'niveles.nombre as nivel_nombre',
                        'niveles.precio as nivel_precio',
                        'niveles.libro as nivel_libro',
                        'niveles.duracion as nivel_duracion',
                        'niveles.tipo_duracion as nivel_tipo_duracion',
                        'planes.nombre as plan_nombre',
                        'planes.cantidad_cuotas as plan_cantidad_cuotas',
                        'planes.plazo as plan_plazo',
                        'planes.descripcion as plan_descripcion',
                        'estudiantes.nombre as estudiante_nombre',
                        'estudiantes.nacionalidad as estudiante_nacionalidad',
                        'estudiantes.telefono as estudiante_telefono',
                        'estudiantes.correo as estudiante_correo',
                        'estudiantes.nacimiento as estudiante_nacimiento',
                        'estudiantes.edad as estudiante_edad',
                        'estudiantes.direccion as estudiante_direccion',
                        'estudiantes.grado as estudiante_grado',
                        'estudiantes.ocupacion as estudiante_ocupacion',
                        'estudiantes.foto as estudiante_foto'
                    )
                    ->where('inscripciones.estatus', '=', $estatus)
                    ->where('estudiantes.nombre', 'like', "%{$filtro}%")
                    ->orderBy('inscripciones.codigo', 'desc')
                    ->paginate($paginacion);
            }
        } else if ($estatus) {
            $estatus = $estatus == 3 ? 0 : $estatus;
            $inscripciones = Inscripcione::join('grupos', 'grupos.codigo', '=', 'inscripciones.codigo_grupo')
                ->join('estudiantes', 'estudiantes.cedula', '=', 'inscripciones.cedula_estudiante')
                ->join('planes', 'planes.codigo', '=', 'inscripciones.codigo_plan')
                ->join('profesores', 'profesores.cedula', '=', 'grupos.cedula_profesor')
                ->join('niveles', 'niveles.codigo', '=', 'grupos.codigo_nivel')
                ->select(
                    'inscripciones.id',
                    'inscripciones.codigo',
                    'inscripciones.cedula_estudiante',
                    'inscripciones.codigo_grupo',
                    'inscripciones.codigo_plan',
                    'inscripciones.nota',
                    'inscripciones.extras',
                    'inscripciones.total',
                    'inscripciones.abono',
                    'inscripciones.fecha',
                    'inscripciones.estatus',
                    'grupos.codigo_nivel',
                    'grupos.cedula_profesor',
                    'grupos.nombre as grupo_nombre',
                    'grupos.dias as grupo_dias',
                    'grupos.hora_inicio as grupo_hora_inicio',
                    'grupos.hora_fin as grupo_hora_fin',
                    'grupos.fecha_inicio as grupo_fecha_inicio',
                    'grupos.fecha_fin as grupo_fecha_fin',
                    'grupos.estatus as grupo_estatus',
                    'profesores.nombre as grupo_profesor_nombre',
                    'profesores.nacionalidad as grupo_profesor_nacionalidad',
                    'profesores.edad as grupo_profesor_edad',
                    'profesores.telefono as grupo_profesor_telefono',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'planes.nombre as plan_nombre',
                    'planes.cantidad_cuotas as plan_cantidad_cuotas',
                    'planes.plazo as plan_plazo',
                    'planes.descripcion as plan_descripcion',
                    'estudiantes.nombre as estudiante_nombre',
                    'estudiantes.nacionalidad as estudiante_nacionalidad',
                    'estudiantes.telefono as estudiante_telefono',
                    'estudiantes.correo as estudiante_correo',
                    'estudiantes.nacimiento as estudiante_nacimiento',
                    'estudiantes.edad as estudiante_edad',
                    'estudiantes.direccion as estudiante_direccion',
                    'estudiantes.grado as estudiante_grado',
                    'estudiantes.ocupacion as estudiante_ocupacion',
                    'estudiantes.foto as estudiante_foto'
                )
                ->where('inscripciones.estatus', '=', $estatus) // filtra por estatus
                ->orderBy('inscripciones.codigo', 'desc')
                ->paginate($paginacion);
        } else if ($filtro) {
            $inscripciones = Inscripcione::join('grupos', 'grupos.codigo', '=', 'inscripciones.codigo_grupo')
                ->join('estudiantes', 'estudiantes.cedula', '=', 'inscripciones.cedula_estudiante')
                ->join('planes', 'planes.codigo', '=', 'inscripciones.codigo_plan')
                ->join('profesores', 'profesores.cedula', '=', 'grupos.cedula_profesor')
                ->join('niveles', 'niveles.codigo', '=', 'grupos.codigo_nivel')
                ->select(
                    'inscripciones.id',
                    'inscripciones.codigo',
                    'inscripciones.cedula_estudiante',
                    'inscripciones.codigo_grupo',
                    'inscripciones.codigo_plan',
                    'inscripciones.nota',
                    'inscripciones.extras',
                    'inscripciones.total',
                    'inscripciones.abono',
                    'inscripciones.fecha',
                    'inscripciones.estatus',
                    'grupos.codigo_nivel',
                    'grupos.cedula_profesor',
                    'grupos.nombre as grupo_nombre',
                    'grupos.dias as grupo_dias',
                    'grupos.hora_inicio as grupo_hora_inicio',
                    'grupos.hora_fin as grupo_hora_fin',
                    'grupos.fecha_inicio as grupo_fecha_inicio',
                    'grupos.fecha_fin as grupo_fecha_fin',
                    'grupos.estatus as grupo_estatus',
                    'profesores.nombre as grupo_profesor_nombre',
                    'profesores.nacionalidad as grupo_profesor_nacionalidad',
                    'profesores.edad as grupo_profesor_edad',
                    'profesores.telefono as grupo_profesor_telefono',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'planes.nombre as plan_nombre',
                    'planes.cantidad_cuotas as plan_cantidad_cuotas',
                    'planes.plazo as plan_plazo',
                    'planes.descripcion as plan_descripcion',
                    'estudiantes.nombre as estudiante_nombre',
                    'estudiantes.nacionalidad as estudiante_nacionalidad',
                    'estudiantes.telefono as estudiante_telefono',
                    'estudiantes.correo as estudiante_correo',
                    'estudiantes.nacimiento as estudiante_nacimiento',
                    'estudiantes.edad as estudiante_edad',
                    'estudiantes.direccion as estudiante_direccion',
                    'estudiantes.grado as estudiante_grado',
                    'estudiantes.ocupacion as estudiante_ocupacion',
                    'estudiantes.foto as estudiante_foto'
                )
                ->where('inscripciones.estatus', '=', 1) // activos
                ->where('inscripciones.codigo', $filtro)
                ->orWhere('inscripciones.codigo_plan', 'like', "%{$filtro}%")
                ->orWhere('inscripciones.codigo_grupo', 'like', "%{$filtro}%")
                ->orWhere('inscripciones.cedula_estudiante', 'like', "%{$filtro}%")
                ->orWhere('estudiantes.nombre', 'like', "%{$filtro}%")
                ->orderBy('inscripciones.codigo', 'desc')
                ->paginate($paginacion);
        } else {
            $inscripciones = Inscripcione::join('grupos', 'grupos.codigo', '=', 'inscripciones.codigo_grupo')
                ->join('estudiantes', 'estudiantes.cedula', '=', 'inscripciones.cedula_estudiante')
                ->join('planes', 'planes.codigo', '=', 'inscripciones.codigo_plan')
                ->join('profesores', 'profesores.cedula', '=', 'grupos.cedula_profesor')
                ->join('niveles', 'niveles.codigo', '=', 'grupos.codigo_nivel')
                ->select(
                    'inscripciones.id',
                    'inscripciones.codigo',
                    'inscripciones.cedula_estudiante',
                    'inscripciones.codigo_grupo',
                    'inscripciones.codigo_plan',
                    'inscripciones.nota',
                    'inscripciones.extras',
                    'inscripciones.total',
                    'inscripciones.abono',
                    'inscripciones.fecha',
                    'inscripciones.estatus',
                    'grupos.codigo_nivel',
                    'grupos.cedula_profesor',
                    'grupos.nombre as grupo_nombre',
                    'grupos.dias as grupo_dias',
                    'grupos.hora_inicio as grupo_hora_inicio',
                    'grupos.hora_fin as grupo_hora_fin',
                    'grupos.fecha_inicio as grupo_fecha_inicio',
                    'grupos.fecha_fin as grupo_fecha_fin',
                    'grupos.estatus as grupo_estatus',
                    'profesores.nombre as grupo_profesor_nombre',
                    'profesores.nacionalidad as grupo_profesor_nacionalidad',
                    'profesores.edad as grupo_profesor_edad',
                    'profesores.telefono as grupo_profesor_telefono',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'planes.nombre as plan_nombre',
                    'planes.cantidad_cuotas as plan_cantidad_cuotas',
                    'planes.plazo as plan_plazo',
                    'planes.descripcion as plan_descripcion',
                    'estudiantes.nombre as estudiante_nombre',
                    'estudiantes.nacionalidad as estudiante_nacionalidad',
                    'estudiantes.telefono as estudiante_telefono',
                    'estudiantes.correo as estudiante_correo',
                    'estudiantes.nacimiento as estudiante_nacimiento',
                    'estudiantes.edad as estudiante_edad',
                    'estudiantes.direccion as estudiante_direccion',
                    'estudiantes.grado as estudiante_grado',
                    'estudiantes.ocupacion as estudiante_ocupacion',
                    'estudiantes.foto as estudiante_foto'
                )
                ->where('inscripciones.estatus', '=', 1) // solo activos
                ->orderBy('inscripciones.codigo', 'desc')
                ->paginate($paginacion);
        }

        foreach ($inscripciones as $key => $inscripcion) {

            $inscripcion['cuotas'] = Cuota::where([
                'codigo_inscripcion' => $inscripcion->codigo,
                'cedula_estudiante' => $inscripcion->cedula_estudiante
            ])->get();

            /** obtenemos la proxima fecha de pago */
            $inscripcion['proxima_fecha_pago'] = $inscripcion['cuotas']->where('estatus', 0)->min('fecha') ?? 'PAGADO';

            /** Verificamos si el estudiante no esta en un grupo */
            $estudianteEstaEnGrupo = GrupoEstudiante::where([
                "codigo_grupo" => $inscripcion->codigo_grupo,
                "cedula_estudiante" => $inscripcion->cedula_estudiante,
            ])->get();

            if (count($estudianteEstaEnGrupo)) {
                $inscripcion['estatus_reasignar'] = false;
            } else {
                $inscripcion['estatus_reasignar'] = true;
            }
            $inscripcion['extras'] = explode(',', $inscripcion->extras);
        }

        return $inscripciones;
    }

    public static function getInscripcion($codigo)
    {
        $inscripcion = Inscripcione::join('grupos', 'grupos.codigo', '=', 'inscripciones.codigo_grupo')
            ->join('estudiantes', 'estudiantes.cedula', '=', 'inscripciones.cedula_estudiante')
            ->join('planes', 'planes.codigo', '=', 'inscripciones.codigo_plan')
            ->join('profesores', 'profesores.cedula', '=', 'grupos.cedula_profesor')
            ->join('niveles', 'niveles.codigo', '=', 'grupos.codigo_nivel')
            ->select(
                'inscripciones.id',
                'inscripciones.codigo',
                'inscripciones.cedula_estudiante',
                'inscripciones.codigo_grupo',
                'inscripciones.codigo_plan',
                'inscripciones.nota',
                'inscripciones.extras',
                'inscripciones.total',
                'inscripciones.abono',
                'inscripciones.fecha',
                'inscripciones.estatus',
                'grupos.codigo_nivel',
                'grupos.cedula_profesor',
                'grupos.nombre as grupo_nombre',
                'grupos.dias as grupo_dias',
                'grupos.hora_inicio as grupo_hora_inicio',
                'grupos.hora_fin as grupo_hora_fin',
                'grupos.fecha_inicio as grupo_fecha_inicio',
                'grupos.fecha_fin as grupo_fecha_fin',
                'grupos.estatus as grupo_estatus',
                'profesores.nombre as grupo_profesor_nombre',
                'profesores.nacionalidad as grupo_profesor_nacionalidad',
                'profesores.edad as grupo_profesor_edad',
                'profesores.telefono as grupo_profesor_telefono',
                'niveles.nombre as nivel_nombre',
                'niveles.precio as nivel_precio',
                'niveles.libro as nivel_libro',
                'niveles.duracion as nivel_duracion',
                'niveles.tipo_duracion as nivel_tipo_duracion',
                'planes.nombre as plan_nombre',
                'planes.cantidad_cuotas as plan_cantidad_cuotas',
                'planes.plazo as plan_plazo',
                'planes.descripcion as plan_descripcion',
                'estudiantes.nombre as estudiante_nombre',
                'estudiantes.nacionalidad as estudiante_nacionalidad',
                'estudiantes.telefono as estudiante_telefono',
                'estudiantes.correo as estudiante_correo',
                'estudiantes.nacimiento as estudiante_nacimiento',
                'estudiantes.edad as estudiante_edad',
                'estudiantes.direccion as estudiante_direccion',
                'estudiantes.grado as estudiante_grado',
                'estudiantes.ocupacion as estudiante_ocupacion',
                'estudiantes.foto as estudiante_foto'
            )
            ->where('inscripciones.codigo', $codigo)
            ->first();

        if ($inscripcion) {

            $inscripcion['cuotas'] = Cuota::where([
                'codigo_inscripcion' => $inscripcion->codigo,
                'cedula_estudiante' => $inscripcion->cedula_estudiante
            ])->get();

            /** obtenemos la proxima fecha de pago */
            $inscripcion['proxima_fecha_pago'] = $inscripcion['cuotas']->where('estatus', 0)->min('fecha') ?? 'PAGADO';

            /** Verificamos si el estudiante no esta en un grupo */
            $estudianteEstaEnGrupo = GrupoEstudiante::where([
                "codigo_grupo" => $inscripcion->codigo_grupo,
                "cedula_estudiante" => $inscripcion->cedula_estudiante,
            ])->get();

            if (count($estudianteEstaEnGrupo)) {
                $inscripcion['estatus_reasignar'] = false;
            } else {
                $inscripcion['estatus_reasignar'] = true;
            }
            $inscripcion['extras'] = explode(',', $inscripcion->extras);
        }

        return $inscripcion;
    }

    /** obtener toda la informacion de los grupos o un grupo por filtro */
    public static function getGrupos($filtro = false, $estatus = false, $paginacion = 12)
    {
        $grupos = [];
        if ($filtro) {
            $grupos = Grupo::join('profesores', 'profesores.cedula', '=', "grupos.cedula_profesor")
                ->join('niveles', 'niveles.codigo', '=', "grupos.codigo_nivel")
                ->select(
                    'grupos.*',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'profesores.nombre as profesor_nombre',
                    'profesores.nacionalidad as profesor_nacionalidad',
                    'profesores.cedula as profesor_cedula',
                    'profesores.telefono as profesor_telefono',
                    'profesores.correo as profesor_correo',
                    'profesores.edad as profesor_edad',
                    'profesores.nacimiento as profesor_nacimiento',
                    'profesores.direccion as profesor_direccion',
                    'profesores.foto as profesor_foto',
                )
                ->where('grupos.estatus', '>=', 1)
                ->where('grupos.codigo', $filtro)
                ->orWhere('grupos.cedula_profesor', $filtro)
                ->orWhere('grupos.nombre', 'like', "%{$filtro}%")
                ->orWhere('profesores.nombre', 'like', "%{$filtro}%")
                ->orderBy('id', 'desc')
                ->paginate($paginacion);
        } else if ($estatus) {
            $estatus = $estatus == 3 ? 0 : $estatus;

            $grupos = Grupo::join('profesores', 'profesores.cedula', '=', "grupos.cedula_profesor")
                ->join('niveles', 'niveles.codigo', '=', "grupos.codigo_nivel")
                ->select(
                    'grupos.*',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'profesores.nombre as profesor_nombre',
                    'profesores.nacionalidad as profesor_nacionalidad',
                    'profesores.cedula as profesor_cedula',
                    'profesores.telefono as profesor_telefono',
                    'profesores.correo as profesor_correo',
                    'profesores.edad as profesor_edad',
                    'profesores.nacimiento as profesor_nacimiento',
                    'profesores.direccion as profesor_direccion',
                    'profesores.foto as profesor_foto',
                )
                ->where('grupos.estatus', '=', $estatus)
                ->orderBy('id', 'desc')
                ->paginate($paginacion);
        } else {
            $grupos = Grupo::join('profesores', 'profesores.cedula', '=', "grupos.cedula_profesor")
                ->join('niveles', 'niveles.codigo', '=', "grupos.codigo_nivel")
                ->select(
                    'grupos.*',
                    'niveles.nombre as nivel_nombre',
                    'niveles.precio as nivel_precio',
                    'niveles.libro as nivel_libro',
                    'niveles.duracion as nivel_duracion',
                    'niveles.tipo_duracion as nivel_tipo_duracion',
                    'profesores.nombre as profesor_nombre',
                    'profesores.nacionalidad as profesor_nacionalidad',
                    'profesores.cedula as profesor_cedula',
                    'profesores.telefono as profesor_telefono',
                    'profesores.correo as profesor_correo',
                    'profesores.edad as profesor_edad',
                    'profesores.nacimiento as profesor_nacimiento',
                    'profesores.direccion as profesor_direccion',
                    'profesores.foto as profesor_foto',
                )
                ->where('grupos.estatus', '=', 1)
                ->orderBy('id', 'desc')
                ->paginate($paginacion);
        }

        /** Agregamos informacion del grupo com lista de estudiantes y matricula total */
        foreach ($grupos as $grupo) {
            $grupoEstudiante = GrupoEstudiante::join('estudiantes', 'estudiantes.cedula', '=', 'grupo_estudiantes.cedula_estudiante')
                ->select(
                    'grupo_estudiantes.cedula_estudiante',
                    'grupo_estudiantes.id as id_grupo_estudiante',
                    'estudiantes.id as estudiante_id',
                    'estudiantes.nombre as estudiante_nombre',
                    'estudiantes.edad as estudiante_edad',
                    'estudiantes.nacionalidad as estudiante_nacionalidad',
                    'estudiantes.telefono as estudiante_telefono',
                    'estudiantes.correo as estudiante_correo',
                    'estudiantes.direccion as estudiante_direccion',
                    'estudiantes.nacimiento as estudiante_nacimiento',
                    'estudiantes.foto as estudiante_foto'
                )
                ->where([
                    'grupo_estudiantes.codigo_grupo' => $grupo->codigo
                ])->get();

            $grupo->fecha_init = Helpers::normalizarFecha($grupo->fecha_inicio);
            $grupo->fecha_end = Helpers::normalizarFecha($grupo->fecha_fin);
            $grupo->hora_init = Helpers::normalizarHora($grupo->hora_inicio);
            $grupo->hora_end = Helpers::normalizarHora($grupo->hora_fin);
            $grupo['matricula'] = $grupoEstudiante->count();

            foreach ($grupoEstudiante as $key => $estudiante) {
                $estudiante->inscripcion = Inscripcione::where([
                    "codigo_grupo" =>  $grupo->codigo,
                    "cedula_estudiante" => $estudiante['cedula_estudiante']
                ])->get()[0];

                /** Obtenemos la ultima fecha de pago */
                $cuotas = Cuota::where([
                    'codigo_inscripcion' => $estudiante->inscripcion->codigo,
                    'cedula_estudiante' => $estudiante->inscripcion->cedula_estudiante
                ])->get();

                $estudiante->inscripcion->proxima_fecha_pago = $cuotas->where('estatus', 0)->min('fecha') ?? 'PAGADO';
            }

            $grupo['estudiantes'] = $grupoEstudiante;
        }



        return $grupos;
    }

    public static function getRepresentante($cedula)
    {
        return Representante::where(['cedula' => $cedula])->get();
    }

    public static function setFechasHorasNormalizadas($datos)
    {
        $fechaInscripcion = Carbon::parse($datos->fecha);
        $dtInit = Carbon::parse($datos->grupo_fecha_inicio);
        $dtEnd = Carbon::parse($datos->grupo_fecha_fin);
        $htInit = Carbon::parse($datos->grupo_hora_inicio);
        $htEnd = Carbon::parse($datos->grupo_hora_fin);

        // Normalizando fechas y horas
        $datos->fecha_init = $dtInit->format('d/m/Y');
        $datos->fecha_end = $dtEnd->format('d/m/Y');
        $datos->hora_init = $htInit->format('h:ia');
        $datos->hora_end = $htEnd->format('h:ia');
        $datos->fecha = $fechaInscripcion->format('d/m/Y');

        return $datos;
    }

    public static function normalizarFecha($fecha, $formato = 'd/m/Y')
    {
        return  date_format(date_create($fecha), $formato);
    }

    public static function normalizarHora($hora, $formato = 'h:ia')
    {
        $newHora = Carbon::parse($hora);
        return $newHora->format($formato);
    }

    public static function updateCedula($cedulaActual, $cedulaNueva)
    {
        try {
            // Pagos
            Pago::where('cedula_estudiante', $cedulaActual)->update([
                "cedula_estudiante" => $cedulaNueva
            ]);
            // Inscripciones
            Inscripcione::where('cedula_estudiante', $cedulaActual)->update([
                "cedula_estudiante" => $cedulaNueva
            ]);

            // Grupos
            GrupoEstudiante::where('cedula_estudiante', $cedulaActual)->update([
                "cedula_estudiante" => $cedulaNueva
            ]);

            // Dificultades 
            DificultadEstudiante::where('cedula_estudiante', $cedulaActual)->update([
                "cedula_estudiante" => $cedulaNueva
            ]);

            // Representantes 
            RepresentanteEstudiante::where('cedula_estudiante', $cedulaActual)->update([
                "cedula_estudiante" => $cedulaNueva
            ]);


            return true;
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Actualizar La Cédula del estudiante en todas sus relaciones en el objeto helper método updateCedula,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public static function setDificultades($listDificultades, $cedulaEstudiante)
    {
        foreach ($listDificultades as $insertDificultad) {
            $d = DificultadEstudiante::updateOrCreate(
                [
                    // Para comparar
                    "cedula_estudiante" => $cedulaEstudiante,
                    "dificultad" => $insertDificultad->nombre
                ],
                [
                    // Para las nueva inserción
                    "dificultad" => $insertDificultad->nombre,
                    "estatus" => $insertDificultad->estatus
                ]
            );
        }
    }

    public static function asignarRepresentante($cedulaEstudiante, $cedulaRepresentante)
    {
        if (isset($cedulaEstudiante) && isset($cedulaRepresentante)) {
            return RepresentanteEstudiante::create([
                "cedula_estudiante" => $cedulaEstudiante,
                "cedula_representante" => $cedulaRepresentante
            ]);
        } else {
            return false;
        }
    }

    public static function setRepresentantes($request, $cedula_edit = 0)
    {
        try {
            /** Cedula del estudiante */
            $cedula = empty($request->cedula) ? $cedula_edit : $request->cedula;

            /** Se registra el representante */
            if (!empty($request->rep_nombre)) {
                Representante::updateOrCreate(
                    [
                        // Comparamos
                        "cedula" => $request->rep_cedula,
                    ],
                    [
                        // Se actualiza o Crea el representante 
                        "nombre" => $request->rep_nombre ?? '',
                        "edad" => $request->rep_edad ?? '',
                        "ocupacion" => $request->rep_ocupacion ?? '',
                        "telefono" => $request->rep_telefono ?? '',
                        "direccion" => $request->rep_direccion ?? '',
                        "correo" => $request->rep_correo ?? '',
                        "nacimiento" => $request->rep_nacimiento ?? '',
                    ]
                );
            }

            /** Relacionamos los estudiante con el representante */
            if (!empty($request->rep_cedula)) {
                RepresentanteEstudiante::updateOrCreate(
                    [
                        "cedula_estudiante" => $cedula
                    ],
                    [

                        "cedula_representante" => $request->rep_cedula
                    ]
                );
            }
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            $errorInfo = Helpers::getMensajeError($th, "Error al Registrar el representante en el objeto helper,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public static function getUsuarios()
    {
        $usuarios = User::all();
        foreach ($usuarios as $key => $usuario) {
            $usuarios[$key] = self::getUsuario($usuario->id);
        }
        return $usuarios;
    }

    public static function getUsuario($id)
    {
        $usuario = User::where("id", $id)->get()[0];
        if ($usuario) {
            $usuario->permisos = self::getPermisosUsuario(RolPermiso::where("id_rol", $usuario->rol)->get());
            $usuario->rol = Role::where("id", $usuario->rol)->get()[0];
        }
        return $usuario;
    }

    public static function getPermisosUsuario($permisos)
    {
        $permisosObject = [];
        foreach ($permisos as $permiso) {
            $permisosObject[$permiso->id_permiso] = Permiso::where('id', $permiso->id_permiso)->get()[0];
        }
        return $permisosObject;
    }


    /** Esta funcion retorna el siguiente codigo de la tabla solicitada */
    public static function getCodigo($table, $incrementar = 0)
    {
        $ultimoCodigo = intval(DB::table($table)->max('codigo'));

        $cod = Carbon::now();
        $cod->year($ultimoCodigo);
        $cod->addYear(1 + $incrementar);
        $codigo = explode("-", $cod->toDateString())[0];

        return $codigo;
    }

    public static function getMensajeError($e, $mensaje)
    {
        $errorInfo = $mensaje . " ("
            . $e->getMessage() . ")."
            . "Código de error: " . $e->getCode()
            . "Linea de error: " . $e->getLine()
            . "El archivo: " . $e->getFile()
            ?? 'No hay mensaje de error';
        return $errorInfo;
    }

    /**
     * Esta funcion recibe la informacion del formulario y detecta cuales son los input que
     * contienen el prefijo @var dif_ y las convierte en un array.
     *
     * @param Request
     */
    public static function getArrayInputs($request, $prefijo = "dif")
    {
        $array = null;
        foreach ($request as $key => $value) {
            $text = substr($key, 0, 3);

            if ($text == $prefijo) : $array[] = $value;
                continue;
            endif;
        }

        return $array;
    }

    /**
     * Esta funcion retorna los checkbox activos de los elementos deseados
     * @param datos array
     * @param inputChecks array
     */

    public static function getCheckboxActivo($datos, $inputChecks)
    {
        foreach ($datos as $key => $dato) {
            $dato->activo = 0;
            foreach ($inputChecks as $check) {
                if ($dato->id == $check) $dato->activo = 1;
            }
        }
        return $datos;
    }


    public static function getInputsEnArray($request, $prefijoInputs)
    {
        $arrayInput = [];
        $arrayInputAssoc = [];
        foreach ($prefijoInputs as $prefijo) {
            foreach ($request->all() as $key => $value) {
                $text = substr($key, 0, 6);
                if ($text == $prefijo) : $arrayInput[$key] = $value;
                    continue;
                endif;
            }
        }

        foreach ($arrayInput as $key => $value) {
            $id = substr($key, 6, 7);
            $arrayInputAssoc[$id][substr($key, 0, 5)] =  $value;
        }


        return $arrayInputAssoc;
    }

    /**
     * Esta funcion recibe la informacion del formulario y detecta cuales son los input que
     * contienen las dificultades y las convierte en un array y despues solicita las dificultades
     * y las configura cual esta activa o no pra retornar un array con cotas las dificultades
     * activas e inactivas para se almacenadas en el estudiante
     *
     * @param Request
     */
    public static function getDificultades($request)
    {
        $dificultades = null;
        $listDificultades = Dificultade::all();

        /** Aqui se arma el arreglo de las dificultades seleccionadas */
        foreach ($request as $key => $value) {
            $text = substr($key, 0, 3);
            if ($text == "dif") : $dificultades[] = $value;
                continue;
            endif;
        }

        /** Validamos si hay alguna seleccionada */
        if ($dificultades) {
            foreach ($listDificultades as $listDificultad) {

                foreach ($dificultades as $nombreDificultad) {
                    if ($nombreDificultad == $listDificultad->nombre) {
                        $listDificultad->estatus = 1;
                        break;
                    } else {
                        $listDificultad->estatus = 0;
                    }
                }
            }
        } else {
            foreach ($listDificultades as $listDificultad) {
                $listDificultad->estatus = 0;
            }
        }

        return $listDificultades;
    }

    /**
     * Esta funcion retorna toda la informacion relacionada con el estudiante como:
     * @var Representantes
     * @var Dificultades
     */
    public static function getEstudiantes($filtro = false, $paginacion = 12)
    {
        $estudiantes = [];
        if ($filtro) {
            $estudiantes = Estudiante::where('cedula', 'like', "%{$filtro}%")
                ->orWhere('nombre', 'like', "%{$filtro}%")
                ->orderBy('id', 'desc')->paginate($paginacion);
        } else {
            $estudiantes = Estudiante::orderBy('id', 'desc')->paginate($paginacion);
        }



        foreach ($estudiantes as $key => $estudiante) {
            $estudiantes[$key] = self::getEstudiante($estudiante->cedula);
        }

        return $estudiantes;
    }

    public static function getEstudiante($cedula)
    {
        $estudiante = null;

        if (isset($cedula)) {
            $estudiante = Estudiante::where([
                "cedula" => $cedula
            ])->first();

            if ($estudiante) {

                /** Obrenemos el representante */
                $representanteEstudiante = RepresentanteEstudiante::where(
                    'cedula_estudiante',
                    $estudiante->cedula
                )->first();

                if ($representanteEstudiante) {
                    $estudiante['representante'] = Representante::where(
                        'cedula',
                        $representanteEstudiante->cedula_representante
                    )->first();

                    $estudiante['representante']['idRelacionPibote'] = $representanteEstudiante->id;
                } else $estudiante['representante'] = null;
                /** CIERRE Obrenemos los representantes */

                /** Obtenemos las dificultades de apredizaje del estudiante */
                $estudiante['dificultades'] = DificultadEstudiante::where('cedula_estudiante', $estudiante->cedula)->get();


                /** Obtenemos todos los datos de inscripción del estudiante */
                $inscripciones = Inscripcione::where("cedula_estudiante", $estudiante->cedula)->orderBy('fecha', 'desc')->get();

                foreach ($inscripciones as $inscripcion) {
                    $inscripcion = self::getInscripcion($inscripcion->codigo) ? self::getInscripcion($inscripcion->codigo) : [];
                }

                $estudiante['inscripciones'] = $inscripciones;

                /** obtenemos las preincriciones del estudiante */
                $estudiante->preinscripciones = Preinscripcione::where('cedula_estudiante', $estudiante->cedula)->get();

                /** formatear cedula */
                $estudiante->cedulaFormateada = number_format($estudiante->cedula, 0, ',', '.');

                /** formatear telefono */
                if (!empty($estudiante->telefono)) {
                    $estudiante->telefonoFormateado = '(' . substr($estudiante->telefono, 0, 4) . ')' . ' ' . substr($estudiante->telefono, 4, 3) . '-' . substr($estudiante->telefono, 7);
                } else {
                    $estudiante->telefonoFormateado = "No asignado.";
                }
            }
        }

        return $estudiante;
    }

    public static function normalizarDatos(
        $data,
        $atributos = [],
        $code = "UTF-8",
        $iso = "ISO-8859-1//TRANSLIT"
    ) {

        foreach ($atributos as $key => $atributo) {
            if (is_string($data[$atributo])) {
                $data[$atributo] = iconv($code, $iso, $data[$atributo]);
            }
        }

        return [$data];
    }

    /**
     * Esta funcion se encarga de guardar la imagen en el store en la direccion public/fotos
     * recibe los siguientes parametros
     * @param request  Estes es el elemento global de las peticiones y se accede a su metodo file y atributo file
     * @return url Retorna la direccion donde se almaceno la imagen
     */
    public static function setFile($request)
    {
        // Movemos la imagen a storage/app/public/imagenes
        return Storage::url(
            Storage::putFile('imagenes', $request->file('file'), 'public')
        );
    }

    /**
     * Eliminamos la imagen o archivo anterior
     * @param url se solicita la url del archivo para removerlo de su ubicacion
     */
    public static function removeFile($url)
    {
        return Storage::delete($url);
    }

    /**
     * Seteamos la data relacional a los grupos y retornamos los datos
     *
     * @param array
     * Este recibe el arreglo donde se desea añadir la informacion de las relaciones.
     *
     * @param arrayKey
     * Este parametro recibe un array asociativo que el key hace referencia a la tabla de la base de datos
     * y el valor al key de relacion a la otra tabla de la DB.
     *
     * ejemplo: ["profesores" => "cedula_profesor"]
     * Aqui buscamos los datos de la tabla grupos
     * desde el cedula_profesor
     *
     */

    public static function addDatosDeRelacion($array, $arrayKey, $sqlExtra = "")
    {
        if (count($array)) {
            foreach ($array as $key => $value) {
                foreach ($arrayKey as $keyTable => $valueKey) {
                    $llave = explode("_", $valueKey);
                    // return DB::select("select * from {$keyTable} where {$llave[0]} = :{$valueKey} {$sqlExtra}", [$value[$valueKey]]);
                    $array[$key][$llave[1]] = count(DB::select("select * from {$keyTable} where {$llave[0]} = :{$valueKey} {$sqlExtra}", [$value[$valueKey]])) > 1
                        ? DB::select("select * from {$keyTable} where {$llave[0]} = :{$valueKey} {$sqlExtra}", [$value[$valueKey]])
                        : DB::select("select * from {$keyTable} where {$llave[0]} = :{$valueKey} {$sqlExtra}", [$value[$valueKey]])[0] ?? [];
                }
            }
        }

        return $array;
    }

    /**
     * @param Object ### Recibe un objeto ###
     *  Esta funcion se encarga de convertir un objecto en una Arreglo Asociativo y asigna
     *  una llave o posicion [0]->data
     *
     */
    public static function setConvertirObjetoParaArreglo($object)
    {
        return [get_object_vars($object)];
    }
    //
    /**
     * Añadiendo la matricula de cada grupo
     *
     */
    public static function setMatricula($grupos)
    {
        foreach ($grupos as $key => $value) {
            $grupos[$key]['matricula'] = GrupoEstudiante::where([
                "estatus" => 1,
                "codigo_grupo" => $value->codigo,
            ])->count();
        }
        return $grupos;
    }

    /**
     * Validar si el dato existe
     */

    public static function datoExiste($data, $array = ["tabla" => ["campo", "sqlExtra", "key"]])
    {
        foreach ($array as $key => $value) {
            return $result = count(DB::select("select * from {$key} where {$value[0]} = :codigo {$value[1]}", [$data[$value[2]]]))
                ? DB::select("select * from {$key} where {$value[0]} = :codigo {$value[1]}", [$data[$value[2]]])[0]
                : false;
        }
    }

    /**
     * Esta funcion configura las cuotas del estudiante
     * y retorna un array
     */

    public static function getCuotas($data)
    {
        $arrayCuotas = [];
        $dataExtra = static::addDatosDeRelacion(
            [["codigo_grupo" => $data->codigo_grupo, "codigo_plan" => $data->codigo_plan]],
            [
                "grupos" => "codigo_grupo",
                "planes" => "codigo_plan",
            ]
        )[0];

        $dataExtra["grupo"] = static::addDatosDeRelacion(
            Helpers::setConvertirObjetoParaArreglo($dataExtra["grupo"]),
            [
                "niveles" => "codigo_nivel",
            ]
        )[0];

        $nivel = $dataExtra["grupo"]["nivel"];
        $plan = $dataExtra["plan"];
        static::setFechaCuota($data["fecha"]);

        $monto = static::getMontoCuota($plan, $nivel);

        for ($i = 0; $i < $plan->cantidad_cuotas; $i++) {
            array_push($arrayCuotas, [
                "cedula_estudiante" => $data["cedula_estudiante"],
                "codigo_grupo" => $data["codigo_grupo"],
                "fecha" => $i == 0 ? $data["fecha"] : static::getFechaCuota($plan),
                "cuota" => $monto,
                "estatus" => 0,

            ]);
        }

        return $arrayCuotas;
    }

    /**
     * Esta funcion calcula el rango de las fecha y retorna la siguiente fecha
     * de la cuota a cobrar
     *
     */
    public static function getFechaCuota($plan)
    {
        $dt = Carbon::create(self::getFechaCuotaActual());
        $date = explode(" ", $dt->addDays($plan['plazo']))[0];
        static::setFechaCuota($date);
        return $date;
    }

    public static function setFechaCuota($fecha)
    {
        static::$fechaCuota = $fecha;
    }

    public static function getFechaCuotaActual()
    {
        return self::$fechaCuota;
    }

    public static function getMontoCuota($plan, $nivel)
    {
        $monto = ($nivel->precio / $plan->cantidad_cuotas);
        return self::auto_decimal_format($monto);
    }

    public static function registrarCuotas($cuotas)
    {
        try {
            foreach ($cuotas as $cuota) {
                Cuota::create([
                    "cedula_estudiante" => $cuota["cedula_estudiante"],
                    "codigo_grupo" => $cuota["codigo_grupo"],
                    "fecha" => $cuota["fecha"],
                    "cuota" => $cuota["cuota"],
                    "estatus" => $cuota["estatus"],
                ]);
            }
        } catch (\Throwable $th) {
            $errorInfo = static::getMensajeError($th, "Error al Registrar las cuotas del estudiante en el método store,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }

        return true;
    }

    public static function auto_decimal_format($n, $def = 2)
    {
        $a = explode(".", $n);
        if (count($a) > 1) {
            $b = str_split($a[1]);
            $pos = 1;
            foreach ($b as $value) {
                if ($value != 0 && $pos >= $def) {
                    $c = number_format($n, $pos);
                    $c_len = strlen(substr(strrchr($c, "."), 1));
                    if ($c_len > $def) {
                        return rtrim($c, 0);
                    }
                    return $c; // or break
                }
                $pos++;
            }
        }
        return number_format($n, $def);
    }
} // end
