<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePreinscripcioneRequest;
use App\Http\Requests\UpdatePreinscripcioneRequest;
use App\Models\Helpers;
use App\Models\Preinscripcione;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PreinscripcionePageController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /** PASO 3 -> REGISTRAR LA PRE INSCRIPCIÓN */
    public function store(Request $request)
    {
        /** Se valida la data dependiendo del caso que pague en efectivo o por la plataforma */
        $data = $request->validate([
            'checkbox' => 'required',
            'codigo_plan' => 'required',
            'codigo_nivel' => 'required',
            'total' => 'required',
        ]);

        $data['abono'] = 0;
        $data['referencia'] = $data['checkbox'];

        /** 
         * Validamos que no se pre-inscriba de nuevo el mismo curso o en otro nivel si posee
         * una pre-inscripcion activa
         */
        $estudiantes = session('estudiantesRegistrados');
        foreach ($estudiantes as $estudiante) {

            $preinscripcionActiva = Preinscripcione::where('cedula_estudiante', $estudiante->cedula)
                ->where('estatus', 0)
                ->first();

            if ($preinscripcionActiva) {
                $mensaje = '¡Ya el estudiante poseé una preinscripcion activa! con estatus Pendiente en el curso seleccionado';
                $estatus = Response::HTTP_BAD_REQUEST;
                session()->flush();
                return back()->with(compact('mensaje', 'estatus'));
            }
        }

        try {
            /** Solicitamos el nuevo codigo */
            $data['codigo'] = Helpers::getCodigo('preinscripciones');

            /** Procedemos a registrar las preinscripciones. */
            foreach ($estudiantes as $estudiante) {
                $data['cedula_estudiante'] = $estudiante->cedula;
                Preinscripcione::create($data);
            }

            $progreso = 100;
            $mensaje = 'El proceso de Pre-inscripción ¡finalizó con exito!';
            $estatus = Response::HTTP_OK;
            session()->flush();
            return view('page.fin', compact('mensaje', 'estatus', 'progreso'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdatePreinscripcioneRequest $request, Preinscripcione $preinscripcione)
    {
        return $preinscripcione;
    }


    public function destroy($id)
    {
        //
    }
}
