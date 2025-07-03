<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Carrito;
use App\Models\Cuenta;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
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
        try {
            return $pedido;
            // $pedido = Pedido::findOrFail($id);
            if ($pedido) {

                /** Completar datos */
                $request['nombres_cliente'] = Strings::upper($request->nombres_cliente);
                $request['apellidos_cliente'] = Strings::upper($request->apellidos_cliente);
                $request['direccion_cliente'] = Strings::upper($request->direccion_cliente);
                $request['nacionalidad_cliente'] = Strings::upper($request->nacionalidad_cliente ?? '');
                $request['estado_cliente'] = Strings::upper($request->estado_cliente ?? '');
                $request['ciudad_cliente'] = Strings::upper($request->ciudad_cliente ?? '');


                /** ejecutar la actualización */
                $pedido->update($request->all());
                $mensaje = "Datos actualizados correctamente";
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                $mensaje = "Usuario no encontrado";
                $estatus = Response::HTTP_NOT_FOUND;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que eliminas cuentas de usuarios pedidos
     */
    public function destroy(string $id)
    {
        try {
            $pedido = pedido::findOrFail($id);
            $pedido->delete();

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
