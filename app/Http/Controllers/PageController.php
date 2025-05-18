<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\StorePageRepresentanteRequest;
use App\Http\Requests\StorePageRequest;
use App\Models\DataDev;
use App\Models\Dificultade;
use App\Models\DificultadEstudiante;
use App\Models\Estudiante;
use App\Models\Helpers;
use App\Models\Nivele;
use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    // Landinpage
    public function index()
    {
        $niveles = Nivele::all();
        $respuesta = DataDev::$respuesta;
        return view('page.index', compact('niveles', 'respuesta'));
    }

    /**
     * PASO 1 -> SELECCIÓN DEL PLAN
     */
    public function create(Request $request)
    {
        if (!$request->codigo_nivel) {
            $mensaje = 'Debe seleccionar un nivel para inicializar su pre-inscripción';
            $estatus = Response::HTTP_BAD_REQUEST;
            return redirect()->route('page.index')->with(compact('mensaje', 'estatus'));
        }
        $respuesta = DataDev::$respuesta;
        $niveles = Nivele::all();
        $planes = Plane::where('estatus', 2)->get();
        $nivelSolicitado = Nivele::where('codigo', $request->codigo_nivel)->first();
        $planSolicitado = null;
        $progreso = 0;
        $estudiantesRegistrados = session('estudiantesRegistrados') ?? [];
        return view(
            'page.preinscripcion',
            compact(
                'niveles',
                'planes',
                'request',
                'nivelSolicitado',
                'planSolicitado',
                'estudiantesRegistrados',
                'progreso',
                'respuesta'
            )
        );
    }

    /**
     * PASO 2 -> FORMULARIO DE REGISTRO DEL ESTUDIANTE
     */
    public function createEstudiante(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $dificultades = Dificultade::all();
            $nivelSolicitado = Nivele::where('codigo', $request->codigo_nivel)->first();
            $planSolicitado = Plane::where('codigo', $request->codigo_plan)->first();
            $totalDeRegistros = session('totalDeRegistros') ?? 0;
            $estudiantesRegistrados = session('estudiantesRegistrados') ?? [];
            $progreso = ($planSolicitado->cantidad_estudiantes == $totalDeRegistros) ? 100 : 50;
            return view(
                'page.estudiantePreinscripcion',
                compact(
                    'request',
                    'dificultades',
                    'nivelSolicitado',
                    'planSolicitado',
                    'respuesta',
                    'totalDeRegistros',
                    'estudiantesRegistrados',
                    'progreso'
                )
            );
        } catch (\Throwable $th) {
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar acceder a la vista de preincripción!");
            return back()->with(compact('estatus', 'mensaje'));
        }
    }

    /** 
     * PASO 2.2 Se ejecuta el registro del estudiante 
     */
    public function store(StorePageRequest $request)
    {
        try {

            /* Variables */
            $mensaje = '';
            $estatus = 0;
            $estudiante = null;
            $esMenorDeEdad = Helpers::esMenorDeEdad($request->nacimiento);
            $estudiantesRegistrados = session('estudiantesRegistrados') ?? [];

            /** 
             * Si el estudiante existe se retorna a vista anterior y se setea en la session y 
             * retornamos la info del estudiante
             */
            $estudianteExiste = Helpers::getEstudiante($request->cedula);
            if ($estudianteExiste) {
                array_push($estudiantesRegistrados, $estudianteExiste);
                session([
                    'estudiantesRegistrados' => $estudiantesRegistrados,
                    'totalDeRegistros' => count($estudiantesRegistrados),
                ]);
                $mensaje = '¡Ya el estudiante está registrado! puede proceder con el siguiente paso';
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            }

            /* Configuramos las dificultades en un array */
            $dificultadesInput = Helpers::getDificultades($request->request);

            /* Validamos si se envio una foto */
            if (isset($request->file)) {
                $request['foto'] = Helpers::setFile($request);
            }

            /* registramos el estudiante */
            $estudiante = Estudiante::create($request->all());

            if ($estudiante) {
                if (isset($dificultadesInput)) {
                    /** Relacionamos los estudiante con la dificultad */
                    foreach ($dificultadesInput as $dificultad) {
                        DificultadEstudiante::create([
                            "cedula_estudiante" => $request->cedula,
                            "dificultad" => $dificultad->nombre,
                            "estatus" => $dificultad->estatus,
                        ]);
                    }
                }
            }


            $mensaje =  $estudiante   ? "Estudiante registrado correctamente"
                : "No se pudo registrar verifique los datos.";
            $estatus = $estudiante ? Response::HTTP_CREATED : Response::HTTP_NOT_FOUND;

            array_push($estudiantesRegistrados, Helpers::getEstudiante($request->cedula));

            /** SE CREA LA UNA SESSION PARA ALMACENAR LOS ESTUDIANTES Y EL TOTAL */
            session([
                'estudiantesRegistrados' => $estudiantesRegistrados,
                'totalDeRegistros' => count($estudiantesRegistrados),
                'esMenorDeEdad' => $esMenorDeEdad,
            ]);

            /** FIN */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar registrar estudiante!");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** 
     * PASO 2.3 Se ejecuta el registro del estudiante 
     */
    public function asignarEstudianteExistente(Request $request)
    {
        try {
            // Validamos que sea una cedula
            $datosValidado = $request->validate([
                "cedulaExistente" => "required | numeric"
            ]);

            // Obtenemos los estudiantes asignados a la planilla 
            $estudiantesRegistrados = session('estudiantesRegistrados') ?? [];

            // Obtenemos de la sesión el total de registros
            $totalDeRegistros = session('totalDeRegistros') ?? 0;

            // Consultamos los datos del estudiante
            $estudianteExiste = Helpers::getEstudiante($request->cedulaExistente);
            if ($estudianteExiste) {
                // Se agrega a la sesión el estudiante
                array_push($estudiantesRegistrados, $estudianteExiste);
                session([
                    'estudiantesRegistrados' => $estudiantesRegistrados,
                    'totalDeRegistros' => count($estudiantesRegistrados),
                ]);

                // Retornamos la respuesta
                $mensaje = 'Estudiante asignado a la planilla de preinscripción';
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                // Si el estudiante
                $mensaje = 'El número de documento del estudiante no está registrado, por favor registrese.';
                $estatus = Response::HTTP_BAD_REQUEST;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar asignar estudiante existente!");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** PASO EXTRA -> REGISTRAR REPRESENTANTE */
    public function storeRepresentante(StorePageRepresentanteRequest $request)
    {
        try {
            $estudiantesRegistrados = session('estudiantesRegistrados');
            $mensaje = 'Representante registrado y asignado correctamente!';
            $estatus = Response::HTTP_OK;
            if (count($estudiantesRegistrados)) {
                foreach ($estudiantesRegistrados as $cedulaEstudiante) {
                    $request['cedula'] = $cedulaEstudiante->cedula;

                    if (Helpers::setRepresentantes($request)) {
                        $request->session()->put('esMenorDeEdad', false);
                        return back()->with(compact('mensaje', 'estatus'));
                    } else {
                        $mensaje = 'Error al registrar y asignar el representante, intente lo de nuevo!';
                        $estatus = Response::HTTP_BAD_REQUEST;
                        return back()->with(compact('mensaje', 'estatus'));
                    }
                }
            } else {
                $mensaje = 'Debe registrar un estudiante antes de asignar un represantante.!!!';
                $estatus = Response::HTTP_BAD_REQUEST;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar registrar y asignar el representante!");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** PASO EXTRA 1.1 -> ASIGNAR EL REPRESENTANTE EN CASO DE QUE YA EXISTA */
    public function asignarRepresentante(Request $request)
    {
        try {
            $mensaje = 'Representante asignado correctamente!';
            $estatus = Response::HTTP_OK;
            $estudiantesRegistrados = session('estudiantesRegistrados');
            foreach ($estudiantesRegistrados as $cedulaEstudiante) {
                $request['cedula'] = $cedulaEstudiante->cedula;
                if (Helpers::asignarRepresentante($request->cedula, $request->rep_cedula)) {
                    $request->session()->put('esMenorDeEdad', false);
                    return back()->with(compact('mensaje', 'estatus'));
                } else {
                    $mensaje = 'No se asigno el representante, intenta de nuevo!';
                    $estatus = Response::HTTP_BAD_REQUEST;
                    return back()->with(compact('mensaje', 'estatus'));
                }
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar asignar el representante!");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
