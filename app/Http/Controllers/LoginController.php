<?php

namespace App\Http\Controllers;

use App\Models\RolPermiso;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
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
            if (Auth::user()->rol < 3) {
                return redirect()->intended('panel');
            } else {
                return redirect()->intended('home');
            } 
        }

        return back()->withErrors([
            'nombre' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    /** Cerrar sesión */
    public function logout(Request $request, Redirector $redirect)
    {
        Auth::logout();
        session('permisos', null);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $redirect->to('login');
    }
}
