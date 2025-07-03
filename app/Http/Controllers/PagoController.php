<?php

namespace App\Http\Controllers;

use App\Models\{
    Pago,
    Helpers,
    DataDev,
};
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class PagoController extends Controller
{

    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $pagos = Pago::where('estatus', 1)->orderBy('codigo', 'desc')->get();
            foreach ($pagos as $key => $pago) {
                $pago['estudiante'] = Helpers::getEstudiante($pago->cedula_estudiante);
                $array = explode(',', $pago->monto);
                $pago->monto = $array[0] . "Bs | " . $array[1] . "$";
            }
            return view('admin.pagos.lista', compact('pagos', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $errorInfo = Helpers::getMensajeError($th, "Error al Consultar lista de pago en el método index,");
            return response()->view('errors.404', compact("errorInfo"), 404);
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }

    public function store(StorePagoRequest $request)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }

    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        try {
            // 1: aprobado | 2: rechazado | 0: pendiente
            $pago->update([
                'estatus' => $request->estatus
            ]);


            $mensaje = "Pago cambio de estatus correctamente.";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar marca');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function show(Pago $pago)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }

    public function destroy(Pago $pago)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }
}
