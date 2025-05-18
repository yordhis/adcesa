<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePreinscripcioneRequest;
use App\Http\Requests\UpdatePreinscripcioneRequest;
use App\Models\DataDev;
use App\Models\Estudiante;
use App\Models\Helpers;
use App\Models\Nivele;
use App\Models\Plane;
use App\Models\Preinscripcione;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;

class PreinscripcioneController extends Controller
{

    public function index(Request $request)
    {
        $preinscripciones = null;
        $respuesta = DataDev::$respuesta;
        $niveles = Nivele::where('estatus', '>=', 1)
            ->orderBy('nombre', 'asc')
            ->get();
        $planes = Plane::where('estatus', '>=', 1)
            ->orderBy('nombre', 'asc')
            ->get();

        if ($request->filtro) {
            $preinscripciones = Preinscripcione::where('codigo', 'like', '%' . $request->filtro . '%')
                ->orWhere('cedula_estudiante', 'like', '%' . $request->filtro . '%')
                ->orderBy('codigo', 'desc')
                ->paginate(12);
        } elseif ($request->estatus) {
            $request['estatus'] = $request->estatus == 2 ? 0 : $request->estatus;
            $preinscripciones = Preinscripcione::where('estatus', $request->estatus)
                ->orderBy('codigo', 'desc')
                ->paginate(12);
        } else {
            $preinscripciones = Preinscripcione::orderBy('codigo', 'desc')->paginate(12);
        }

        /** Se mapea la respuesta */
        foreach ($preinscripciones as $preinscripcion) {
            $preinscripcion->estudiante = Estudiante::where('cedula', $preinscripcion->cedula_estudiante)->first();
            $preinscripcion->plan = Plane::where('codigo', $preinscripcion->codigo_plan)->first();
            $preinscripcion->nivel = Nivele::where('codigo', $preinscripcion->codigo_nivel)->first();
        }
        // return $preinscripciones;
        return view('admin.preinscripciones.lista', compact('preinscripciones', 'request', 'niveles', 'planes', 'respuesta'));
    }

    /** PASO 3 -> REGISTRAR LA PRE INSCRIPCIÓN */
    public function store(Request $request)
    {
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

        $data = null;
        /** Se valida la data dependiendo del caso que pague en efectivo o por la plataforma */
        if ($request->efectivo) {
            $data = $request->all();
            $data['abono'] = 0;
            $data['referencia'] = $data['efectivo'];
        } else {
            $data = $request->validate([
                'referencia' => 'required|min:4|max:11',
                'abono' => 'numeric|required',
                'comprobante' => 'required|max:2048|mimes:jpg,png',
                'codigo_plan' => 'required',
                'codigo_nivel' => 'required',
            ]);
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

    public function update(UpdatePreinscripcioneRequest $request, Preinscripcione $preinscripcione)
    {
        try {
            $preinscripcione->update($request->all());
            return back()->with([
                "mensaje" => 'Pre-inscripción actualizada con éxito',
                "estatus" => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            return back()->with([
                "mensaje" => 'Error al actualizar la pre-inscripción. Error: ' . $th->getMessage(),
                "estatus" => Response::HTTP_BAD_REQUEST
            ]);
        }
    }

    /** eliminado permanente de la preinscripción */
    public function destroy($id)
    {
        try {
            /** Se busca la preinscripcion */
            $preinscripcione = Preinscripcione::find($id);
            $preinscripcione->delete();
         
            return back()->with([
                "mensaje" => 'Pre-inscripción eliminada con éxito',
                "estatus" => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            return back()->with([
                "mensaje" => 'Error al eliminar la pre-inscripción. Error: ' . $th->getMessage(),
                "estatus" => Response::HTTP_BAD_REQUEST
            ]);
        }

    }
}
