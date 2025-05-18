<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;


use App\Models\{
    Estudiante,
    DificultadEstudiante,
    Helpers,
    DataDev
};
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class EstudianteController extends Controller
{
    public function index(Request $request)
    {
        $estudiantes = [];

        if ($request->filtro) {
            $estudiantes =  Helpers::getEstudiantes($request->filtro);
        } else {
            $estudiantes =  Helpers::getEstudiantes();
        }

        $respuesta =  DataDev::$respuesta;

        return view('admin.estudiantes.lista', compact('estudiantes', 'request', 'respuesta'));
    }

    public function create()
    {
        $estatus = Response::HTTP_NOT_FOUND;
        $mensaje = 'Pagina no encontrada';
        return back()->with(compact('mensaje', 'estatus'));
    }

    public function store(StoreEstudianteRequest $request)
    {
        try {

            // Validando cedula 
            $estatusCreate = 0;

            // Configuramos las dificultades en un array
            $dificultadesInput = Helpers::getDificultades($request->request);

            // Validamos si se envio una foto
            if (isset($request->file)) {
                $request['foto'] = Helpers::setFile($request);
            }

            // registramos el estudiante
            $estatusCreate = Estudiante::create($request->all());

            if ($estatusCreate) {
                // Validamos si existe el representante
                if (isset($request->rep_cedula)) {
                    if (isset($request->rep_nombre)) {
                        // Se crea y asigna el representante al estudiante
                        Helpers::setRepresentantes($request);
                    } else {
                        // Solo asignamos al representante
                        Helpers::asignarRepresentante($request->cedula, $request->rep_cedula);
                    }
                }

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


            $mensaje =  $estatusCreate   ? "Estudiante registrado correctamente"
                : "No se pudo registrar verifique los datos.";
            $estatus = $estatusCreate ? Response::HTTP_CREATED : Response::HTTP_NOT_FOUND;

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al intentar registrar estudiante!");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function edit(Estudiante $estudiante)
    {
        try {
            $estudiante =  Helpers::getEstudiante($estudiante->cedula);
            $urlPrevia = url()->previous();


            $respuesta = DataDev::$respuesta;
            return view('admin.estudiantes.editar', compact(
                'estudiante',
                'urlPrevia',
                'respuesta'
            ));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al Consultar datos del estudiante en el método edit,");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact("mensaje", 'estatus'));
        }
    }

    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {

        try {
            // Validamos si se envio una foto
            if (isset($request->file)) {
                // Eliminamos la imagen anterior
                $fotoActual = explode('/', $estudiante->foto);
                if ($fotoActual[count($fotoActual) - 1] != 'default.jpg') {
                    Helpers::removeFile($estudiante->foto);
                }

                // Insertamos la nueva imagen o archivo
                $request['foto'] = Helpers::setFile($request);
            } else {
                $request['foto'] = $estudiante->foto;
            }

            // Editar cedula
            if (!empty($request->cedula)) {
                if ($estudiante->cedula != $request->cedula) {
                    Helpers::updateCedula($estudiante->cedula, $request->cedula);
                }
            }

            // Actualizamos los datos de lestudiante
            $estudiante->update($request->all());


            // Actualizamos los datos del representante
            // validamos que la cedula no cambio
            Helpers::setRepresentantes($request, $estudiante->cedula);



            // Configuramos las dificultades en un array y obtenemos
            $listDificultades = Helpers::getDificultades($request->request);
            // Seteamos las dificultades
            Helpers::setDificultades($listDificultades, $estudiante->cedula);

            $mensaje = "Los Datos del estudiante se guardaron correctamente";
            $estatus = Response::HTTP_OK;

            if ($request->urlPrevia) return redirect($request->urlPrevia)->with(compact('mensaje', 'estatus'));

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            //throw $th;
            $mensaje = Helpers::getMensajeError($th, ", Error interno al intentar editar un estudiante");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function destroy(Estudiante $estudiante)
    {
        try {

            Helpers::destroyData($estudiante->cedula, false, false, [
                "pagos" => true,
                "cuotas" => true,
                "inscripcione" => true,
                "preinscripcione" => true,
                "grupoEstudiante" => true,
                "representanteEstudiante" => true,
                "dificultadEstudiante" => true,
            ]);

            $estudiante->delete();

            $mensaje = "El estudiante {$estudiante->nombre}, fue eliminado correctamente";
            $estatus = 200;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error interno al intentar eliminar el estudiante");
            $estatus = 301;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
