<?php

namespace App\Http\Controllers;

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
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $redirect->to('login');
    }
}
