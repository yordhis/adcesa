<?php

namespace App\Models;

use App\Models\{
    User,
    RolPermiso,
    Permiso,
    Role,
};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Helpers extends Model
{
    use HasFactory;

    /** 
     * Función que configura una respuesta JSON para la consultas de la API 
     * por el método HTTP.
     * 
     * @param string $mensaje 
     * @param array $data Datos de la petición
     * @param number $estatus Código de respuesta
     * 
     * @return object JSON { "mensaje": "mensaje", "data":DATA, "estatus":[estatus] }
     */
    public static function getRespuestaJson($mensaje, $data = [], $estatus = Response::HTTP_OK)
    {
        return response()->json([
            "mensaje" => $mensaje,
            "data" => $data,
            "estatus" => $estatus
        ], $estatus);
    }

    /** 
     * Función que permite personalizar el formato a la fecha.
     * @package Carbon
     * @param string $fecha Fecha sin formato
     * @param string $formato Configuración del formato deseado
     * 
     * @return string Fecha formateada
     * 
     */
    public static function normalizarFecha($fecha, $formato = 'd/m/Y')
    {
        return  date_format(date_create($fecha), $formato);
    }

    /** 
     * Función que permite personalizar el formato a la hora.
     * @package Carbon
     * @param string $hora hora sin formato
     * @param string $formato Configuración del formato deseado
     * 
     * @return string hora formateada
     * 
     */
    public static function normalizarHora($hora, $formato = 'h:ia')
    {
        $newHora = Carbon::parse($hora);
        return $newHora->format($formato);
    }

    /** 
     * Función obtiene todos los usuarios del sistema CMS
     * con los roles de administrador y vendedor.
     * 
     * @return array[usuarios] 
     */
    public static function getUsuarios()
    {
        $usuarios = User::where('rol', '<', 3)->get();
        foreach ($usuarios as $key => $usuario) {
            $usuarios[$key] = self::getUsuario($usuario->id);
        }
        return $usuarios;
    }

    /** 
     * Función que obtiene un solo usuario mediante el id del usuairo.
     * 
     * @return usuario object
     */
    public static function getUsuario($id)
    {
        $usuario = User::where("id", $id)->first();
        if ($usuario) {
            $usuario->permisos = self::getPermisosUsuario($usuario->rol);
            $usuario->rol_nombre = Role::where("id", $usuario->rol)->first()->nombre;
        }
        return $usuario;
    }

    /** 
     * Función que obtiene todos los permisos del rol del usuario.
     * 
     * @param idRol string
     * @return permisos array
     */
    public static function getPermisosUsuario($idRol): array
    {
        $rolPermisos = RolPermiso::where('id_rol', $idRol)
            ->where('estatus_rp', 1)
            ->join('permisos', 'permisos.id', '=', 'rol_permisos.id_permiso')
            ->select(
                'rol_permisos.*',
                'permisos.nombre as permiso'
            )
            ->get();

        $permisos = [];
        foreach ($rolPermisos as $rol) {
            array_push($permisos, $rol->permiso);
        }

        return $permisos;
    }


    /** Esta funcion retorna el siguiente codigo de la tabla solicitada */
    public static function getCodigo($table, $incrementar = 0)
    {
        $ultimoCodigo = intval(DB::table($table)->max('codigo'));

        $cod = Carbon::now();
        $cod->year($ultimoCodigo);
        $cod->addYear(1 + $incrementar);
        $codigo = explode("-", $cod->toDateString())[0];

        return $codigo;
    }

    public static function getMensajeError($e, $mensaje)
    {
        $errorInfo = $mensaje . " ("
            . $e->getMessage() . ")."
            . "Código de error: " . $e->getCode()
            . "Linea de error: " . $e->getLine()
            . "El archivo: " . $e->getFile()
            ?? 'No hay mensaje de error';
        return $errorInfo;
    }

    /**
     * Esta funcion recibe la informacion del formulario y detecta cuales son los input que
     * contienen el prefijo @var dif_  o el quese le envie y las convierte en un array.
     *
     * @param object $request Aqui vienen los input o entradas de la solicitud
     * @param string $prefijo Esto se encarga de identificar los nombre de campos que se van a capturar
     * 
     * @return array Valores de los campos capturados en la solicitud
     */
    public static function getArrayInputs($request, $prefijo = "dif")
    {
        $array = null;
        foreach ($request as $key => $value) {
            $text = substr($key, 0, 3);

            if ($text == $prefijo) : $array[] = $value;
                continue;
            endif;
        }

        return $array;
    }

    /**
     * Esta funcion retorna los checkbox activos de los elementos deseados
     * @param datos array
     * @param inputChecks array
     */
    public static function getCheckboxActivo($datos, $inputChecks)
    {
        foreach ($datos as $key => $dato) {
            $dato->activo = 0;
            foreach ($inputChecks as $check) {
                if ($dato->id == $check) $dato->activo = 1;
            }
        }
        return $datos;
    }


    public static function getInputsEnArray($request, $prefijoInputs)
    {
        $arrayInput = [];
        $arrayInputAssoc = [];
        foreach ($prefijoInputs as $prefijo) {
            foreach ($request->all() as $key => $value) {
                $text = substr($key, 0, 6);
                if ($text == $prefijo) : $arrayInput[$key] = $value;
                    continue;
                endif;
            }
        }

        foreach ($arrayInput as $key => $value) {
            $id = substr($key, 6, 7);
            $arrayInputAssoc[$id][substr($key, 0, 5)] =  $value;
        }


        return $arrayInputAssoc;
    }

    /**
     * Esta funcion se encarga de guardar la imagen en el store en la direccion public/fotos
     * recibe los siguientes parametros
     * @param request  Estes es el elemento global de las peticiones y se accede a su metodo file y atributo file
     * @return url Retorna la direccion donde se almaceno la imagen
     */
    public static function setFile($request)
    {
        // Movemos la imagen a storage/app/public/imagenes
        return Storage::url(
            Storage::putFile('imgs', $request->file('file'), 'public')
        );
    }

    /**
     * Eliminamos la imagen o archivo anterior
     * @param url se solicita la url del archivo para removerlo de su ubicacion
     */
    public static function removeFile($url)
    {
        return Storage::delete($url);
    }

    /**
     * @param Object ### Recibe un objeto ###
     *  Esta funcion se encarga de convertir un objecto en una Arreglo Asociativo y asigna
     *  una llave o posicion [0]->data
     *
     */
    public static function setConvertirObjetoParaArreglo($object)
    {
        return [get_object_vars($object)];
    }
} // end
