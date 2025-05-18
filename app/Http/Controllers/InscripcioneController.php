<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInscripcioneRequest;
use App\Http\Requests\UpdateInscripcioneRequest;
use App\Models\{
    Concepto,
    DataDev,
    Cuota,
    Grupo,
    GrupoEstudiante,
    Helpers,
    Inscripcione,
    Plane,
};
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;

class InscripcioneController extends Controller
{
    public function index(HttpRequest $request)
    {
        try {
            
            // Retorna la lista de inscripciones
            // donde el estatus es 3 = completado que hace referencia a que los pagos de
            // de la inscripción estan listo
            $respuesta = DataDev::$respuesta;
            $metodos = DataDev::$metodosPagos;
            $codigoDePago = Helpers::getCodigo('pagos');
            $conceptos = Concepto::where("estatus", 1)->get();
            $grupos = Helpers::getGrupos(false, false, 200);

            $inscripciones = Helpers::getInscripciones($request);
            //  return $inscripciones;
            return view(
                "admin.inscripciones.lista",
                compact(
                    'inscripciones',
                    'respuesta',
                    'request',
                    'codigoDePago',
                    'conceptos',
                    'grupos',
                    'metodos'
                )
            );
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar Inscripciones en el método index,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    /**
     * VISTA DE INGRESAR CEDULA DEL ESTUDIANTE
     * SI EXISTE REDIRECCIONA A PROCESAR INSCRIPCIÓN
     * SI NO SE DESPLIEGA EL FORMULARIO DE REGISTRO DE ESTUDIANTE
     */
    public function createEstudiante()
    {
        try {
            $respuesta = DataDev::$respuesta;
            return view('admin.inscripciones.crearEstudiante', compact('respuesta'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar Inscripciones en el método create,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function create()
    {
        try {
            $respuesta = DataDev::$respuesta;
            $codigo = Helpers::getCodigo('inscripciones');
            $planes = Plane::where('estatus', '>=', 1)->get();
            $grupos = Helpers::setMatricula(Grupo::where("estatus", 1)->get());

            return view('admin.inscripciones.crear', compact('planes', 'grupos', 'codigo', 'respuesta'));
        } catch (\Throwable $th) {

            $mensaje = Helpers::getMensajeError($th, "Error al Consultar Inscripciones en el método create,");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return  redirect()->route('admin.inscripciones.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        }
    }

    public function store(StoreInscripcioneRequest $request)
    {
        try {
            /** quitamos las comas de codigos y cedulas estudiantes */
            $request['estudiantes'] = substr($request->estudiantes, 0, strlen($request->estudiantes) - 1);
            $request['codigo'] = substr($request->codigo, 0, strlen($request->codigo) - 1);

            /** Convertimos los estudiantes a un array */
            $datosCuotas = [];
            $estudiantes = explode(',', $request->estudiantes);
            $codigos = explode(',', $request->codigo);
            $datosCuotas = Helpers::getInputsEnArray($request, ['monto_', 'fecha_']);

            /** Declaramos variables globales */
            $estatusCreate = false;
            $estudianteCapturado = [];
            $mensajeDeEstudiantesCapturados = "";
            $preMensaje = "El estudiante ya esta inscrito en este grupo de estudio.";

            /** Buscamos en el grupo asignado si el estudiante ya esta incluido */
            foreach ($estudiantes as $key => $cedula) {
                $capturado = Inscripcione::where([
                    "cedula_estudiante" => $cedula,
                    "codigo_grupo" =>  $request->codigo_grupo
                ])->get();
                if (count($capturado)) {
                    array_push(
                        $estudianteCapturado,
                        $capturado
                    );

                    $mensajeDeEstudiantesCapturados .= "(Código del grupo: {$capturado[0]->codigo_grupo} - Estudiante: {$capturado[0]->cedula_estudiante})";
                }
            }

            /** Cambiamos el mensaje de estudiantes encontrados */
            if (count($estudianteCapturado) > 1) $preMensaje = "Los estudiantes ya están registrados en el grupo seleccionado.";

            /** Validamos si este estudiante ya esta inscrito en ese grupo de estudio */
            if (count($estudianteCapturado) == 0) {
                // Estraemos los datos extras de la planilla de inscripcion
                $request['extras'] = implode(',', Helpers::getArrayInputs($request->request, 'ext'));

                /** Registramos la incripcion, asignamosel grupo y registramos las cuotas */
                foreach ($estudiantes as $keyCedula => $cedulaEstudiante) {

                    $estatusCreate = Inscripcione::create([
                        "codigo" => $codigos[$keyCedula] ?? $codigos[0],
                        "cedula_estudiante" => $cedulaEstudiante,
                        "codigo_grupo" => $request->codigo_grupo,
                        "codigo_plan" => $request->codigo_plan,
                        "fecha" => $request->fecha,
                        "extras" => $request->extras,
                        "total" => doubleval($request->total)
                    ]);

                    GrupoEstudiante::create([
                        "cedula_estudiante" => $cedulaEstudiante,
                        "codigo_grupo" => $request->codigo_grupo,
                    ]);

                    foreach ($datosCuotas as $cuota) {

                        Cuota::create([
                            "cedula_estudiante" => $cedulaEstudiante,
                            "codigo_inscripcion" => $codigos[$keyCedula] ?? $codigos[0],
                            "fecha" =>  $cuota['fecha'],
                            "cuota" => $cuota['monto'], // monto
                        ]);
                    }
                }
            }


            $mensaje = DataDev::$respuesta['mensaje'] = $estatusCreate ? "¡La inscripción del estudiante se proceso correctamente!"
                : "{$preMensaje} {$mensajeDeEstudiantesCapturados}";

            $estatus = DataDev::$respuesta['estatus'] = $estatusCreate ? 200 : 301;

            return $estatusCreate   ? redirect()->route('admin.inscripciones.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ])
                : redirect()->route('admin.inscripciones.create')->with([
                    "mensaje" => $mensaje,
                    "estatus" => $estatus
                ]);
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al Procesar Inscripción en el método store,");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return  redirect()->route('admin.inscripciones.create')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        }
    }

    /** imprimir planilla PDF de la inscripcion */
    public function planillapdf($cedula, $codigo)
    {
        try {
            $estudiantes = [];
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
                ->orderBy('inscripciones.codigo', 'desc')
                ->get();

            foreach ($inscripciones as $key => $inscripcion) {
                array_push($estudiantes, Helpers::getEstudiante($inscripcion->cedula_estudiante));
            }
            /** normalizar fecha y horas */
            Helpers::setFechasHorasNormalizadas($inscripciones[0]);

            /**
             * [0] = ¿promoción? @values si o no
             * [1] = explique @values @string
             * [2] = ¿Se entrego material? @values si o no
             * [3] = ¿cómo se enteró del curso? @values @string
             * [4] = observación @values @string
             */
            $inscripciones[0]->extras = explode(',', $inscripciones[0]->extras);

            $data = [
                "inscripciones" => $inscripciones,
                "estudiantes" => $estudiantes
            ];

            // Se genera el pdf
            $pdf = PDF::loadView('admin.inscripciones.planillapdf', $data);
            return $pdf->stream("{$estudiantes[0]->nombre}.pdf");
            // return $pdf->download("INSCRIPCION.pdf");
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al Consultar Inscripciones en el método generar pdf,");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return  redirect()->route('admin.inscripciones.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        }
    }


    public function update(UpdateInscripcioneRequest $request, Inscripcione $inscripcione)
    {
        try {
            $estatusUpdate = 0;
            // Editamos la observación
            $datosExtras = explode(",", $inscripcione->extras);
            $datosExtras[4] = $request->observacion;
            $datosExtras = implode(",", $datosExtras);
            $estatusUpdate = $inscripcione->update(["extras" => $datosExtras]);
            $estudiante = Helpers::getEstudiante($inscripcione->cedula_estudiante);

            $mensaje = 'Panilla de inscripción actualizada correctamente';
            $estatus = Response::HTTP_OK;
            
            return redirect(url()->previous())->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al Actulizar datos de la Planilla de Inscripción en el método update,");
            $estatus = Response::HTTP_BAD_REQUEST;
            return redirect(url()->previous())->with(compact('mensaje', 'estatus'));
        }
    }

    public function updateObservacion($idInscripcion, HttpRequest $request){
        try {

            $inscripcion = Inscripcione::where('id', $idInscripcion)->first();
            $extras = explode(',', $inscripcion->extras);
            $extras[4] = trim($request->observacion); 
            $result = $inscripcion->update(['extras' => implode(',', $extras) ]);

            $mensaje = $result ? "Observación actualizada" : "¡No se actualizó la observación, vuelve a intentar!";
            $estatus = $result ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST;
            
            return redirect(url()->previous())->with(compact('mensaje', 'estatus'));
            
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al Actulizar datos de la Planilla de Inscripción en el método update,");
            $estatus = Response::HTTP_BAD_REQUEST;
            return redirect(url()->previous())->with(compact('mensaje', 'estatus'));
        }


    }

    /** REASIGNAR GRUPO DE ESTUDIO */
    public function reasignarGrupo(HttpRequest $request)
    {
        try {

            $mensaje = "El estudiante se asigno al grupo correctamente";
            $estatus = Response::HTTP_OK;



            /** Obtenemos el grupo */
            $grupo =  Helpers::getGrupos($request->codigo_grupo);

            if (count($grupo)) {
                /** Realizamos la asignacion */
                $resultadoDeReasignar = GrupoEstudiante::create([
                    "cedula_estudiante" => $request->cedula_estudiante,
                    "codigo_grupo" => $request->codigo_grupo
                ]);

                if ($resultadoDeReasignar) {
                    Inscripcione::where([
                        'codigo' => $request->codigo_inscripcion,
                        'cedula_estudiante' => $request->cedula_estudiante
                    ])->update([
                        "codigo_grupo" => $request->codigo_grupo
                    ]);
                } else {
                    $mensaje = "No se pudo asignar al estudiante al grupo, vuelva a intentar.";
                    $estatus = Response::HTTP_UNAUTHORIZED;
                }
            } else {
                $mensaje = "El grupo seleccionado no exite, vuelva a intentar, seleccionando otro grupo.";
                $estatus = Response::HTTP_NOT_FOUND;
            }

            /** Redireccionamos a la vista anterior con la respuesta */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", Error interno al intentar reasignar un estudiante a un grupo.");
            return Helpers::getRespuestaJson($mensaje, [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /** Eliminar todo lo relacionado con el codigo de inscripcion */
    public function reset(Inscripcione $inscripcione)
    {
        try {
            // Borramos la inscripción
            $inscripcione->update(["estatus" => 1]);

            $mensaje = "Datos de inscripción retaurados correctamente.";
            $estatus = Response::HTTP_OK;
            return redirect()->route('admin.inscripciones.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al restaurar datos de inscripción,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }
    /** Eliminar todo lo relacionado con el codigo de inscripcion */
    public function destroy(Inscripcione $inscripcione)
    {
        try {

            Helpers::destroyData($inscripcione->cedula_estudiante, $inscripcione->codigo, $inscripcione->codigo_grupo, [
                "pagos" => false,
                "cuotas" => false,
                "inscripcione" => false,
                "grupoEstudiante" => true,
            ]);

            // Borramos la inscripción
            $inscripcione->update(["estatus" => 0]);

            $mensaje = "Datos de Inscripción Eliminado correctamente.";
            $estatus = Response::HTTP_OK;
            return redirect()->route('admin.inscripciones.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Eliminar datos de Inscripción en el método destroy,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }
}
