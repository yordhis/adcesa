<?php

namespace App\Http\Controllers;

use App\Models\{
    Pago,
    Helpers,
    DataDev,
    Pedido,
    User,
};
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Mail\StatusMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
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

            /** cambiar el estatus al pedido */
            $estatusKey = 'PENDIENTE';
            switch ($request->estatus) {
                case 0: // por verificar
                    Pedido::where('codigo', $pago->codigo_pedido)->update([
                        'estatus' => 'PENDIENTE'
                    ]);
                    break;
                case 1: // aprobado (Pago verificado)
                     $estatusKey = 'PAGO VERIFICADO';
                    Pedido::where('codigo', $pago->codigo_pedido)->update([
                        'estatus' => $estatusKey
                    ]);
                    break;
                case 2: // rechazado (Pago rechazado)
                    $estatusKey = 'PAGO RECHAZADO';
                    Pedido::where('codigo', $pago->codigo_pedido)->update([
                        'estatus' => $estatusKey
                    ]);
                    break;

                default:
                    $mensaje = 'No envio ningún estatus de pedido y pago, por favor intente de nuevo';
                    $estatus = Response::HTTP_BAD_REQUEST;
                    return back()->with(compact('mensaje', 'estatus'));
                    break;
            }
            /** Obtener pedido */
            $pedido = Pedido::where('codigo', $pago->codigo_pedido)->first();
            /** Obtener cliente */
            

            /** Eviar correo de notificacion de cambio de estatus al cliente */
            Mail::to($pedido->email_cliente)
            ->send(new StatusMail(
                $pedido
            ));

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
