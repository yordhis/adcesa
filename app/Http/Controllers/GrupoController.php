<?php

namespace App\Http\Controllers;

use App\Exports\ExportarMatricula;
use App\Models\{
    Grupo,
    GrupoEstudiante,
    Nivele,
    Profesore,
    DataDev,
    Helpers
};
use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class GrupoController extends Controller
{
    public function index(Request $request)
    {
        try {

            $respuesta = DataDev::$respuesta;
            $niveles = Nivele::where("estatus", 1)->get();
            $profesores = Profesore::where('estatus', 1)->get();
            $codigo = Helpers::getCodigo('grupos');
            $dias = DataDev::$dias;

            $grupos = Helpers::getGrupos($request->filtro, $request->estatus);



            return view('admin.grupos.lista', compact('grupos', 'request', 'respuesta', 'niveles', 'profesores', 'codigo', 'dias'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar Grupos en el método index,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    /** imprimir matricula del grupo de estudio */
    public function imprimirMatriculaDelGrupo($codigoGrupo)
    {
        // $grupos = Helpers::getGrupos($codigoGrupo);
        // return $grupos[0];
        return Excel::download(new ExportarMatricula($codigoGrupo), "matricula-grupo-codigo-{$codigoGrupo}.xlsx");
    }

    public function store(StoreGrupoRequest $request)
    {
        try {

            $estatusCreate = 0;
            $diasGrupo = Helpers::getArrayInputs($request->request, "dia") ?? [];

            $request['dias'] =  implode(',', $diasGrupo);
            $datoExiste = Helpers::datoExiste($request, ["grupos" => ["nombre", "", "nombre"]]);
            if (count($diasGrupo)) {
                if (!$datoExiste) {
                    $estatusCreate = Grupo::create($request->all());
                }
            }

            $mensaje = DataDev::$respuesta['mensaje'] = $estatusCreate ? "El Grupo se Creó correctamente."
                : "El nombre del Grupo ya existe, Cambie el nombre.";
            $mensaje = DataDev::$respuesta['mensaje'] = count($diasGrupo) ?  $mensaje
                :  "Debe ingresar los Días de clases para el grupo de estudio";
            $estatus = DataDev::$respuesta['estatus'] = $estatusCreate ? 200 : 301;

            $respuesta = DataDev::$respuesta;

            return redirect()->route('admin.grupos.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al crear un grupo en el método store,");
            return redirect()->route('admin.grupos.index')->with([
                "mensaje" => $mensaje,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function edit(Grupo $grupo)
    {
        try {
            $diasGrupo = explode(',', $grupo->dias);
            $respuesta = DataDev::$respuesta;
            $dias = DataDev::$dias;
            $niveles = Nivele::where("estatus", 1)->get();
            $profesores = Profesore::where('estatus', 1)->get();

            foreach ($dias as $key => $dia) {
                foreach ($diasGrupo as $diaG) {
                    if ($diaG == $dia) {
                        $dias[$key] = [
                            "dia" => $dia,
                            "activo" => "checked"
                        ];
                        break;
                    } else {
                        $dias[$key] = [
                            "dia" => $dia,
                            "activo" => null
                        ];
                    }
                }
            }

            return view(
                'admin.grupos.editar',
                compact('niveles', 'profesores', 'grupo', 'dias', 'respuesta')
            );
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de Consulta de grupo en el método Edit,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGrupoRequest  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        try {
            $estatusUpdate = false;
            $diasGrupo = Helpers::getArrayInputs($request->request, "dia") ?? [];
            $request['dias'] =  implode(',', $diasGrupo);
            if (count($diasGrupo)) {
                $estatusUpdate = $grupo->update($request->all());
            }

            $mensaje = DataDev::$respuesta['mensaje'] = $estatusUpdate ? "El Grupo se Actualizó correctamente."
                : "El Grupo no sufrió ningun cambio.";

            $mensaje = DataDev::$respuesta['mensaje'] = count($diasGrupo) ?  $mensaje
                :  "Debe ingresar los Días de clases para el grupo de estudio";

            $estatus = DataDev::$respuesta['estatus'] = $estatusUpdate ? 200
                : 301;



            return $estatusUpdate   ? redirect()->route('admin.grupos.index')->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ])
                : back()->with([
                    "mensaje" => $mensaje,
                    "estatus" => $estatus
                ]);
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Actualizar grupo en el método update,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function destroy(Grupo $grupo)
    {
        try {

            /** Eliminar el grupo */
            $grupo->update(["estatus" => 0]);
           
            return url()->previous(function(){
                return session([
                    "mensaje" => "Grupo eliminado correctamente.",
                    "estatus" => Response::HTTP_OK
                ]);
            });
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Eliminar grupo en el método destroy,");
            return back()->with([
                "mensaje" =>  $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
