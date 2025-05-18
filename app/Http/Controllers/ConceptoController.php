<?php

namespace App\Http\Controllers;

use App\Models\{
    Concepto,
    DataDev,
    Helpers
};
use App\Http\Requests\StoreConceptoRequest;
use App\Http\Requests\UpdateConceptoRequest;
use Illuminate\Http\Response;

class ConceptoController extends Controller
{

    public function index()
    {
        try {

            $conceptos = Concepto::all();
            $respuesta = DataDev::$respuesta;
            foreach ($conceptos as $key => $value) {
                $value->estatus = $value->estatus ? "Activo" : "Inactivo";
            }
            return view('admin.conceptos.lista', compact('conceptos', 'respuesta'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar lista de Conceptos de pago en el método index,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }


    public function create()
    {
        try {
            $respuesta = DataDev::$respuesta;
            return view('admin.conceptos.crear', compact('respuesta'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos Conceptos de pago en el método create,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function store(StoreConceptoRequest $request)
    {
        try {
            $request['descripcion'] = trim(strtoupper($request['descripcion']));
            $request['codigo'] = trim(strtoupper($request['codigo']));


            $estatusCreate = 0;
            $datoExiste = Helpers::datoExiste($request, ["conceptos" => ["codigo", "", "codigo"]]);
            if (!$datoExiste) {
                $estatusCreate = Concepto::create($request->all());
            }
            $mensaje = DataDev::$respuesta['mensaje'] = $estatusCreate ? "El Concepto se Registró correctamente."
                : "El Código del Concepto ¡Ya existe!, Cambie el Código por favor.";
            $estatus = DataDev::$respuesta['estatus'] = $estatusCreate ? 200
                : 301;
            $respuesta = DataDev::$respuesta;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Registrar datos de Conceptos de pago en el método store,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function show(Concepto $concepto)
    {
        redirect()->route('admin.conceptos.index');
    }

    public function edit(Concepto $concepto)
    {
        try {
            $respuesta = DataDev::$respuesta;
            return view('admin.conceptos.editar', compact('concepto', 'respuesta'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar datos de Conceptos de pago en el método edit,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }


    public function update(UpdateConceptoRequest $request, Concepto $concepto)
    {
        try {
            $request['estatus'] =  $request['estatus'] ?? 0;
            $concepto->update($request->all());
            $mensaje = "El Concepto de pago se actualizó correctamente.";
            $estatus =  Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = "Error al Actualizar los datos de Conceptos de pago, es probable que el Código ya exista.";
            $estatus =  Response::HTTP_NOT_FOUND;
            return back()->with( compact("mensaje", "estatus"));
        }
    }

    public function destroy(Concepto $concepto)
    {
        try {
            $concepto->delete();
            $mensaje = "El Concepto de pago se Eliminó correctamente.";
            $estatus =  Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al intentar Eliminar los datos de Conceptos de pago en el método destroy,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }
}
