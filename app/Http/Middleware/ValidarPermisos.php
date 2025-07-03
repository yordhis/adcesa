<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Helpers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidarPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $permisos = Helpers::getPermisosUsuario(Auth::user()->rol);
            $nombreRol = Role::where('id', Auth::user()->rol)->first()->nombre;
            $path = explode('/', $request->path())[0];

        
            if (!in_array($path, $permisos)) {

                if ($nombreRol == 'CLIENTE') {
                    return redirect()->route('page.home')->with([
                        "mensaje" => "No tiene autorización para acceder a esa dirección: " . $path,
                        "estatus" => Response::HTTP_UNAUTHORIZED
                    ]);
                }
                return redirect()->route('admin.panel.index')->with([
                    "mensaje" => "No tiene autorización para acceder al modulo: " . $path,
                    "estatus" => Response::HTTP_UNAUTHORIZED
                ]);
            }
        }
        
        return $next($request);
    }
}
