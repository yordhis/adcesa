<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWebRequest;
use App\Http\Requests\UpdateUserWebRequest;
use App\Mail\BienvenidaClienteEmail;
use App\Mail\RegistroEmail;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Pedido;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Strings;



class ClienteController extends Controller
{

    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $clientes = [];
            if ($request->filtro || $request->order) {
                $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                    ->select('users.*', 'roles.nombre as rol_nombre')
                    ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                    ->where('nombres', 'like',  "%$request->filtro%")
                    ->orderBy('nombres', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));

                if (!count($clientes)) {
                    $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                        ->select('users.*', 'roles.nombre as rol_nombre')
                        ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                        ->where('apellidos', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($clientes)) {
                    $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                        ->select('users.*', 'roles.nombre as rol_nombre')
                        ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                        ->where('email', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($clientes)) {
                    $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                        ->select('users.*', 'roles.nombre as rol_nombre')
                        ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                        ->where('cedula', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
            } else {
                $clientes = User::join('roles', 'roles.id', '=', 'users.rol')
                    ->select('users.*', 'roles.nombre as rol_nombre')
                    ->where('roles.nombre', '=', 'CLIENTE') // Rol de cliente
                    ->orderBy('nombres', 'ASC')
                    ->paginate($request->input('limit', 12));
            }

            return view('admin.clientes.index', compact('clientes', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar cliente.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que crea cuentas de clientes
     */
    public function store(StoreUserWebRequest $request)
    {
        try {
            $cedulaExiste = User::where('cedula', $request->cedula)->first();
            if ($cedulaExiste) {
                $mensaje = "El número de cedulo o rif ya esta registrado!";
                $estatus = Response::HTTP_UNAUTHORIZED;
                return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
            }

            /** Generamos una clave aleatoria */
            $claveGenerada = $request->input('password', Hash::make(Helpers::generarCodigoPedidoUnico('ADC')));
            /** Completar datos */
            $request['nombres'] = Strings::upper($request->nombres);
            $request['apellidos'] = Strings::upper($request->apellidos);
            $request['direccion'] = Strings::upper($request->direccion);
            $request['pais'] = Strings::upper($request->pais ?? '');
            $request['estado'] = Strings::upper($request->estado ?? '');
            $request['ciudad'] = Strings::upper($request->ciudad ?? '');
            $request['password'] = $claveGenerada;
            $request['rol'] = Role::where('nombre', 'CLIENTE')->first()->id;


            /** Insertamos la imagen y obtenermos la url para guardar en la DB */
            if ($request->file) {
                $request['foto'] = Helpers::setFile($request);
            }

            /** Ejecutamos el guardado del cliente */
            $user = User::create($request->all());

            /** ENVIAR CORREO */
            Mail::to($user->email)
                ->send(new BienvenidaClienteEmail($user));

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "Cuenta de usuario creada correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            if ($request->input('desdeLaWeb', false)) {
                return redirect()->route('login.index')->with(compact('mensaje', 'estatus'));
            }

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
    public function update(UpdateUserWebRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                /** Validar correo si se editó y que no se repita el correo */
                if ($request->email) {
                    if ($request->email != $user->email) {
                        $emailExiste = User::where('email', '=', $request->email)->first();
                        if ($emailExiste) {
                            $mensaje = "E-mail ya registrado en otra cuenta, por favor intente con otro!";
                            $estatus = Response::HTTP_BAD_REQUEST;
                            return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
                        }
                    }
                }
                /** Validar cédula */
                if ($request->cedula) {
                    if ($request->cedula != $user->cedula) {
                        $cedulaExiste = User::where('cedula', '=', $request->cedula)->first();
                        if ($cedulaExiste) {
                            $mensaje = "Cédula ya existe, por favor intente con otra!";
                            $estatus = Response::HTTP_BAD_REQUEST;
                            return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
                        }
                    }
                }

                /** Completar datos */
                $request['nombres'] = Strings::upper($request->nombres);
                $request['apellidos'] = Strings::upper($request->apellidos);
                $request['direccion'] = Strings::upper($request->direccion);
                $request['pais'] = Strings::upper($request->pais ?? '');
                $request['estado'] = Strings::upper($request->estado ?? '');
                $request['ciudad'] = Strings::upper($request->ciudad ?? '');


                /** Verificamos si enviaron una imagen nueva */
                if ($request->file) {
                    if ($user->foto) {
                        Helpers::removeFile($user->foto);
                    }
                    $request['foto'] = Helpers::setFile($request);
                }

                /** En caso de que edite el correo se debe actualizar el correo del cliente en todos suspedidos */
                if($user->email != $request->email){
                    Pedido::where('email_cliente', $user->email)->update(['email_cliente' => $request->email]);
                }
                
                /** ejecutar la actualización */
                $user->update($request->all());
                $mensaje = "Datos actualizados correctamente";
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                $mensaje = "Usuario no encontrado";
                $estatus = Response::HTTP_NOT_FOUND;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar cliente');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** Actualizar contraseña */
    public function editPassword(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            /** Validar que la contraseña actual sea valida */
            if (!Auth::attempt([
                "email" => $user->email,
                "password" => $request->password_actual,
            ])) {
                $mensaje = "La contraseña ingresada como actual no coincide con nuestros registros!";
                $estatus = Response::HTTP_BAD_REQUEST;
                return back()->with(compact('mensaje', 'estatus'));
            }
            $request->session()->regenerate();

            /** Validar que las nuevas contraseñas sean iguales */
            if (!($request->new_password === $request->renew_password)) {
                $mensaje = "Las contraseñas nuevas ingresadas no coincide!";
                $estatus = Response::HTTP_BAD_REQUEST;
                return back()->with(compact('mensaje', 'estatus'));
            }

            /** Actualizar la contraseña */
            $user->update(['password' => $request->new_password]);

            /** Enviar un correo notificando*/

            /** Cerrar la sesión */
            return redirect('logout');
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar contraseña del cliente');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que eliminas cuentas de usuarios clientes
     */
    public function destroy(string $id)
    {
        try {
            $cliente = User::findOrFail($id);
            $cliente->delete();

            $mensaje = 'Cliente eliminado correctamente.';
            $estatus = Response::HTTP_OK;

            // Redireccionar a la lista de clientes con un mensaje de éxito
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al eliminar cliente.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.clientes.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.clientes.index')->with(compact('mensaje', 'estatus'));
    }

    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.clientes.index')->with(compact('mensaje', 'estatus'));
    }
}
