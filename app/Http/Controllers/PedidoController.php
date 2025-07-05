<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Mail\StatusMail;
use App\Models\Carrito;
use App\Models\Cuenta;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Insumo;
use App\Models\InsumoToProducto;
use App\Models\Medida;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Strings;

class PedidoController extends Controller
{

    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $pedidos = [];
            if ($request->filtro) {
                $pedidos = Pedido::where('codigo', $request->filtro)
                    ->orderBy('created_at', $request->input('order', 'DESC'))
                    ->paginate($request->input('limit', 12));

                if (!count($pedidos)) {
                    $pedidos = Pedido::where('nombres_cliente', 'like',  "%$request->filtro%")
                        ->orderBy('nombres_cliente', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($pedidos)) {
                    $pedidos = Pedido::where('email_cliente', 'like',  "%$request->filtro%")
                        ->orderBy('nombres_cliente', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($pedidos)) {
                    $pedidos = Pedido::where('cedula_cliente', $request->filtro)
                        ->orderBy('nombres_cliente', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
            } else {
                $pedidos = Pedido::orderBy('created_at', $request->input('order', 'DESC'))
                    ->paginate($request->input('limit', 12));
            }

            foreach ($pedidos as $key => $pedido) {
                /** obtenmos el carrito de compra del pedido */
                $carrito = Carrito::where('codigo_pedido', $pedido->codigo)->get();
                foreach ($carrito as $key => $item) {
                    $item->mas_detalles = json_decode($item->mas_detalles);
                    $item->imagenes_adicionales = json_decode($item->imagenes_adicionales);

                    /** obtener los insumos del servicio */
                    if ($item->tipo_producto) {
                        $item['insumos'] = InsumoToProducto::where('id_producto', $item->id_producto)->get();
                        foreach ($item['insumos'] as $key => $insumoToProducto) {
                            $item['insumos'][$key] = Insumo::find($insumoToProducto->id_insumo);
                            $item['insumos'][$key]['medida'] = Medida::find($item['insumos'][$key]->id_medida);
                        }
                    }
                }
                $pedido['carrito'] = $carrito;

                /** Obtenemos el pago del pedido */
                $pago = Pago::where('codigo_pedido', $pedido->codigo)->first();
                $pago['cuenta'] = Cuenta::find($pago->id_cuenta) ?? null;
                $pedido['pago'] = $pago;
            }

            return view('admin.pedidos.index', compact('pedidos', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $insumos = [];
            $productoSolicitado = session('producto') ?? null;
            $clienteSolicitado = session('cliente') ?? null;
            $carritos = [];
            return view('admin.pedidos.create', compact(
                'respuesta',
                'request',
                'insumos',
                'productoSolicitado',
                'clienteSolicitado',
                'carritos'
            ));
        } catch (\Throwable $th) {
            $mensaje = 'Error al mostrar vista de registrar pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
    /**
     * Método que crea cuentas de pedidos
     */
    public function store(StorePedidoRequest $request)
    {
        try {
            return $request->all();
            /** Generar codigo de pedido */
            $request['codigo'] = Helpers::generarCodigoPedidoUnico();

            /** Validar que el codigo no se repita */
            $codigoExiste = Pedido::where('codigo', $request['codigo'])->first();
            if ($codigoExiste) {
                $mensaje = "El código de pedido ya existe.";
                $estatus = Response::HTTP_CONFLICT;
                return back()->with(compact('mensaje', 'estatus'));
            }

            /** Completar datos */
            $request['nombres_cliente'] = Strings::upper($request->nombres_cliente);
            $request['apellidos_cliente'] = Strings::upper($request->apellidos_cliente);
            $request['direccion_cliente'] = Strings::upper($request->direccion_cliente);
            $request['nacionalidad_cliente'] = Strings::upper($request->nacionalidad_cliente ?? '');
            $request['estado_cliente'] = Strings::upper($request->estado_cliente ?? '');
            $request['ciudad_cliente'] = Strings::upper($request->ciudad_cliente ?? '');


            /** Registrarmos el pedido */
            Pedido::create($request->all());

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "Pedido creado correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** Mensaje de error en la misma vista */
            $mensaje = Helpers::getMensajeError($th, 'Error al crear cuenta de usuario.');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que actualiza los datos de la insumo
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        $insumosRequeridos = [];
        $estatusActual = $pedido->estatus;
        try {
            /** Configurar los insumos a debitar del inventario de insumos*/
            foreach ($request->all() as $key => $value) {
                if ($request[$key]) {
                    if (str_contains($key, 'cantidad')) {
                        /** obtener el id del insumo */
                        $id = explode('_', $key)[0];
                        $cantidad = $request[$key];

                        array_push($insumosRequeridos, [
                            'id_insumo' => $id,
                            'cantidad' => $cantidad,
                        ]);
                    }
                } else {
                    $mensaje = "No puedes aprobar un pedido sino asignas los insumos a descontar en el inventario de insumos.";
                    $estatus = Response::HTTP_NOT_FOUND;
                    return back()->with(compact('mensaje', 'estatus'));
                }
            }


            /** descontar del inventario insumos */
            foreach ($insumosRequeridos as $key => $insumo) {
                $insumoActual = Insumo::find($insumo['id_insumo']);
                $nuevoStock = doubleval($insumoActual->stock) - doubleval($insumo['cantidad']);
                $insumoActual->update([
                    'stock' => $nuevoStock
                ]);
            }

            if ($pedido) {
                /** ejecutar la actualización */
                $pedido->update([
                    'estatus' => $request->estatus
                ]);

                /** Eviar correo de notificacion de cambio de estatus al cliente */
                Mail::to($pedido->email_cliente)
                    ->cc(config('mail.from.address'))
                    ->send(new StatusMail(
                        $pedido,
                        'Pedido cambio de estatus ' . $pedido->estatus
                    ));

                $mensaje = "El pedido fue aprobado y se descontaron los insumos correctamente";
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                $mensaje = "Usuario no encontrado";
                $estatus = Response::HTTP_NOT_FOUND;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            /** devolver los insumos debitados */
            if (count($insumosRequeridos)) {
                foreach ($insumosRequeridos as $key => $insumo) {
                    $insumoActual = Insumo::find($insumo['id_insumo']);
                    $insumoActual->update([
                        'stock' => $insumoActual->stock + $insumo['cantidad']
                    ]);
                }
            }
            /** dejarlo en el estatus anterior */
            $pedido->update([
                'estatus' => $estatusActual
            ]);
            /** respuesta de falla */
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** Metodo Configurar fechas de inicio y de entrega */
    public function configurarFechas(Request $request)
    {
        try {

            $pedido = Pedido::find($request->id_pedido);

            /** ejecutar la actualización */
            $pedido->update([
                'estatus' => $request->estatus,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_entrega' => $request->fecha_entrega,
            ]);

            /** Eviar correo de notificacion de cambio de estatus al cliente */
            Mail::to($pedido->email_cliente)
                ->cc(config('mail.from.address'))
                ->send(new StatusMail(
                    $pedido,
                    'Pedido cambio de estatus ' . $pedido->estatus
                ));

            $mensaje = "El pedido fue puesto en marcha correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** respuesta de falla */
            $mensaje = Helpers::getMensajeError($th, 'Error al configurar fecha y actualizar a proceso el pedido');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** Metodo marcar como entregado */
    public function marcarComoEntregado(Request $request)
    {
        try {

            $pedido = Pedido::find($request->id_pedido);

            /** ejecutar la actualización */
            $pedido->update([
                'estatus' => $request->estatus,
                'fecha_entrega' => $request->fecha_entrega,
            ]);

            /** Notificar al cliente por correo */
            /** Eviar correo de notificacion de cambio de estatus al cliente */
            Mail::to($pedido->email_cliente)
                ->cc(config('mail.from.address'))
                ->send(new StatusMail(
                    $pedido,
                    'Pedido cambio de estatus ' . $pedido->estatus
                ));

            $mensaje = "El pedido se entrego, pedido finalizado correctamente.";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** respuesta de falla */
            $mensaje = Helpers::getMensajeError($th, 'Error al entregar el pedido');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que eliminas cuentas de usuarios pedidos
     */
    public function destroy($id)
    {
        try {
            $pedido = pedido::findOrFail($id);
            $carrito = Carrito::where('codigo_pedido', $pedido->codigo)->get();
            $pago = Pago::where('codigo_pedido', $pedido->codigo)->first();

            /** Borramos las imagenes adicionales */
            foreach ($carrito as $key => $producto) {
                if ($producto->tipo_producto) {
                    $imagenesAdicionalesExiste = json_decode($producto->imagenes_adicionales);
                    if (count($imagenesAdicionalesExiste)) {
                        foreach ($imagenesAdicionalesExiste as $key => $imagen) {
                            Helpers::removeFile($imagen);
                        }
                    }
                }
            }

            /** Barramos el comprobante */
            if ($pago->comprobante) {
                Helpers::removeFile($pago->comprobante);
            }

            $pago->delete();
            $pedido->delete();
            Carrito::where('codigo_pedido', $pedido->codigo)->delete();

            $mensaje = 'pedido eliminado correctamente.';
            $estatus = Response::HTTP_OK;

            // Redireccionar a la lista de pedidos con un mensaje de éxito
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al eliminar pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }



    public function show($pedidoId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($pedidoId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }
}
