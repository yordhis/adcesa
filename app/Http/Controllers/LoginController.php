<?php

namespace App\Http\Controllers;

use App\Models\DataDev;
use App\Models\RolPermiso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $respuesta = DataDev::$respuesta;
        return view('login', compact('respuesta') );
    }

    /** Autenticación de usuario  */
    public function store(Request $request)
    {
        // Autenticamos al usuario
        $credenciales = $request->only('email', 'password');

        // $recuerdame = isset($request->recuerdame) ? true : false;
        $recuerdame = $request->filled('rememberMe');

        if (Auth::attempt($credenciales, $recuerdame)) {
            /** Se regenera la seción o se crea */
            /** OPTENEMOS LOS PERMISOS DEL USUARIO */
            $request->session()->put('permisos', RolPermiso::where('id_rol', Auth::user()->rol)
                ->join('permisos', 'rol_permisos.id_permiso', '=', 'permisos.id')
                ->select(
                    'rol_permisos.id_permiso',
                    'permisos.nombre',
                    'permisos.id',
                )
                ->pluck('permisos.id', 'permisos.nombre')->toArray());
            $request->session()->regenerate();

            /** Redireccionamos al usaurio segun su rol */
            if (array_key_exists('panel', session('permisos'))) {
                return redirect()->intended('panel');
            } else {
                return redirect()->intended('home');
            }
        }

        return back()->with([
            'mensaje' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            'estatus' => Response::HTTP_BAD_REQUEST,
        ]);
    }

    /** Cerrar sesión */
    public function logout(Request $request, Redirector $redirect)
    {
        Auth::logout();
        session('permisos', null);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $redirect->to('/');
        // return $redirect->to('login');
    }
}
