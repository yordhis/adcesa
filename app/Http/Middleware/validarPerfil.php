<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidarPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (str_contains($request->path(), 'perfil')) {
            $idPath = explode('/', $request->path())[1];
            // $user = User::find($idPath);

            if ($idPath != Auth::user()->id) {
                $mensaje = "No puedes acceder a otro perfil que no te pertenece!";
                $estatus = Response::HTTP_UNAUTHORIZED;
                return redirect()->route('page.index')->with(compact('mensaje', 'estatus'));
            }
        }
    
        return $next($request);
    }
}
