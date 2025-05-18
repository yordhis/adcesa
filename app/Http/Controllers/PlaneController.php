<?php

namespace App\Http\Controllers;

use App\Models\{
    Plane,
    DataDev,
    Helpers,
    Inscripcione
};

use App\Http\Requests\StorePlaneRequest;
use App\Http\Requests\UpdatePlaneRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaneController extends Controller
{

    public function index(Request $request)
    {
        try {
            $codigo = Helpers::getCodigo('planes');
            $respuesta = DataDev::$respuesta;

            if ($request->filtro) {
                $planes = Plane::where('codigo', $request->filtro)
                    ->where('estatus', '>=', 1)
                    ->orWhere('nombre', 'like', "%{$request->filtro}%")
                    ->orderBy('codigo', 'desc')
                    ->paginate(12);
            } else {
                $planes = Plane::orderBy('codigo', 'desc')
                    ->where('estatus', '>=', 1)
                    ->paginate(12);
            }
            return view(
                "admin.planes.lista",
                compact('planes', 'respuesta', 'request', 'codigo')
            );
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de consula en el método index,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function create()
    {
        $estatus = Response::HTTP_NOT_FOUND;
        $mensaje = 'Pagina no encontrada';
        return back()->with(compact('mensaje', 'estatus'));
    }

    public function store(StorePlaneRequest $request)
    {
        try {

            $estatusCreate = 0;

            $estatusCreate = Plane::create($request->all());

            $mensaje = $estatusCreate ? "El Plan se guardo correctamente."
                : "El nombre del Plan Ya existe, Cambie el nombre.";

            $estatus = $estatusCreate ? Response::HTTP_OK
                : Response::HTTP_BAD_REQUEST;



            return redirect(url()->previous())->with([
                "mensaje" =>   $mensaje,
                "estatus" =>   $estatus
            ]);
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error al intentar registrar un plan en el método store,");
            return redirect(url()->previous())->with([
                "mensaje" =>   $mensaje,
                "estatus" =>   404
            ]);
        }
    }

    public function show(Plane $plane)
    {
        $estatus = Response::HTTP_NOT_FOUND;
        $mensaje = 'Pagina no encontrada';
        return back()->with(compact('mensaje', 'estatus'));
    }


    public function edit(Plane $plane)
    {
        try {

            $urlPrevious = url()->previous();
            return view('admin.planes.editar', compact('plane', 'urlPrevious'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error de consula en el método edit,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function update(UpdatePlaneRequest $request, Plane $plane)
    {
        try {

            if (empty($request->estatus)) $request['estatus'] = 1;

            $estatusUpdate = $plane->update($request->all());

            $mensaje = DataDev::$respuesta['mensaje'] = $estatusUpdate ? "El Plan se Actualizó correctamente."
                : "El Plan no sufrió ninguncambio.";

            $estatus = DataDev::$respuesta['estatus'] = $estatusUpdate ? Response::HTTP_OK
                : Response::HTTP_BAD_REQUEST;

            $respuesta = DataDev::$respuesta;

            return redirect($request->urlPrevious)->with([
                "mensaje" =>   $mensaje,
                "estatus" =>   $estatus
            ]);
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al intentar actualizar Plan en el método update,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function destroy(Plane $plane)
    {
        try {

            /** Borrado sueve */
            $plane->update(['estatus' => 0]);
            return redirect(url()->previous())->with([
                "mensaje" =>  "El Plan se Eliminó correctamente.",
                "estatus" =>  Response::HTTP_OK
            ]);
            
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, "Error de al intentar Eliminar un nivel,");
            return redirect(url()->previous())->with([
                "mensaje" =>   $mensaje,
                "estatus" =>  Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
