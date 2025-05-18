<?php

namespace App\Http\Controllers;

use App\Models\{
    Nivele,
    Helpers,
    DataDev,
};
use App\Http\Requests\StoreNiveleRequest;
use App\Http\Requests\UpdateNiveleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NiveleController extends Controller
{

    public function index(Request $request)
    {
        try {
            $codigo = Helpers::getCodigo('niveles');

            $respuesta = DataDev::$respuesta;
            if ($request->filtro) {
                $niveles = Nivele::where("codigo", $request->filtro)
                    ->where('estatus' , '>=', 1)
                    ->orWhere('nombre', 'like', "%{$request->filtro}%")
                    ->orWhere('libro', 'like', "%{$request->filtro}%")
                    ->orWhere('precio', 'like', "%{$request->filtro}%")
                    ->orderBy("codigo", "desc")->paginate(12);
            } else {
                $niveles = Nivele::where('estatus' , '=', 1)
                ->orderBy("codigo", "desc")->paginate(12);
            }
            return view('admin.niveles.lista', compact('niveles', 'codigo', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            //throw $th;
            $errorInfo = Helpers::getMensajeError($th, "Error de consula,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function store(StoreNiveleRequest $request)
    {
        try {

            $estatusCreate = 0;
            $datoExiste = Helpers::datoExiste($request, ["niveles" => ["nombre", "", "nombre"]]);
            if (!$datoExiste) {
                if ($request->file('file')) {
                    $request['imagen'] = Helpers::setFile($request);
                }

                $estatusCreate = Nivele::create($request->all());
            }

            $mensaje = $estatusCreate ? "El nivel se Registró correctamente."
                : "El nombre del Nivel Ya existe, Cambie el nombre.";
            $estatus = $estatusCreate ? Response::HTTP_OK
                : Response::HTTP_UNAUTHORIZED;

            return back()->with([
                "mensaje" => $mensaje,
                "estatus" => $estatus
            ]);
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al intentar crear un nivel,");
            return back()->with([
                "mensaje" => $errorInfo,
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function edit(Nivele $nivele)
    {
        try {

            $respuesta = DataDev::$respuesta;
            return view('admin.niveles.editar', compact('nivele', 'respuesta'));

        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de al intentar consultar un nivel,"); 
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function update(UpdateNiveleRequest $request, Nivele $nivele)
    {
        try {
            $mensaje = "";
            $estatus = Response::HTTP_OK;
            if ($request->file('file')) {
                /** seteamos la nueva imagen y la guardamos en el storage */
                $request['imagen'] = Helpers::setFile($request);
                /** eliminamos la imagen vieja */
                Helpers::removeFile($nivele->imagen);
            }

            if ($nivele->update($request->all())) {
                $mensaje = "El nivel se Actualizó correctamente.";
                $estatus = Response::HTTP_OK;
            } else {
                $mensaje = "¡El nivel NO se pudo actualizar!.";
                $estatus = Response::HTTP_UNAUTHORIZED;
            }

            return redirect()->route('admin.niveles.index')->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de al intentar Actualizar un nivel,");
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function destroy(Nivele $nivele)
    {
        try {
            /** Borrado suave */
            $nivele->update([ 'estatus' => 0 ]);
            Helpers::removeFile($nivele->imagen);
            
            return back()->with([
                "mensaje" =>  "El Nivel se Eliminó correctamente.",
                "estatus" =>  Response::HTTP_OK
            ]);

        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de al intentar Eliminar un nivel,");
            return back()->with([
                "mensaje" =>  $errorInfo,
                "estatus" =>  Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
