<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/Bogota');

use App\Empleados;
use App\EmpleadoRol;
use Illuminate\Http\Request;
use DB;
use App\Menu;
use Exception;

class ApiControllers extends Controller
{

    public function guardar(Request $request)
    {

        // transacción de guardado
        try {

            $nombre =  $request->input('nombre');
            $correo =  $request->input('correo');
            $sexo =  $request->input('sexo');
            $area =  $request->input('area');
            $descripcion =  $request->input('descripcion');
            $boletin =  $request->input('boletin');
            $roles = json_decode($request->input('roles'));

            // validar campos obligatorios
            if (!isset($nombre)) {
                throw new Exception("El campo nombre es requerido");
            }
            if (!isset($correo)) {
                throw new Exception("El campo correo es requerido");
            }
            if (!isset($sexo)) {
                throw new Exception("El campo sexo es requerido");
            }
            if (!isset($area)) {
                throw new Exception("El campo área es requerido");
            }
            if (!isset($descripcion)) {
                throw new Exception("El campo descripción es requerido");
            }

            // se envian los datos a la transacción 
            \DB::beginTransaction();

            $obj = [
                "nombre" => $nombre,
                "email" => $correo,
                "sexo" => $sexo,
                "area_id" => $area,
                "descripcion" => $descripcion,
                "boletin" => $boletin
            ];

            $empleado = Empleados::create($obj);

            // asociar roles al empleado
            foreach ($roles as $rol) {

                $obj = [
                    "rol_id" => $rol,
                    "empleado_id" =>  $empleado->id
                ];

                $empleadoRol = EmpleadoRol::create($obj);
            }

            \DB::commit();
        } catch (\Exception $e) {

            \DB::rollback();
            return \Response::json(array("resp" => "error", "msj" => $e->getMessage()), 422);
        }




        /*

        $obj = [
            "nombre" => $request->input('nombre'),
            "email" => $request->input('correo'),
            "sexo" => $request->input('sexo'),
            "area_id" => $request->input('area'),
            "descripcion" => $request->input('descripcion'),
            "boletin" => $request->input('boletin')
        ];

        $empleado = Empleados::create($obj);
        $empleado->save();

        $roles = json_decode($request->input('roles'));

        foreach($roles as $rol) {

            $obj = [
                "rol_id" => $rol,
                "empleado_id" =>  $empleado->id
            ];

            $empleadoRol = EmpleadoRol::create($obj);
            $empleadoRol->save();  
        }


        return $empleado->id;              


        return $nombre;

        return \Response::json(array("resp" => "error", "msj" => $request->input('name')), 403);

*/
        return array("resp" => "error", "msj" => $request->input('name'),);

    }

    /**Función para obtener los datos del empleado. */
    public function peticModalEdit($id)
    {

        $empleado = Empleados::find($id);
        $empleadoRol = EmpleadoRol::where('empleado_id', $id)->get();
        return \Response::json(array("resp" => "success", "empleado" => $empleado, "rolesEmpleado" => $empleadoRol));
    }

    public function eliminarEmpleado($id)
    {
        EmpleadoRol::where('empleado_id', $id)->delete();
        Empleados::find($id)->delete();
        
        return \Response::json(array("resp" => "success"));
    }

    /**Función para editar empleado seleccionado */
    public function editarEmpleado(Request $request, $id)
    { 
        // transacción de guardado
        try {

            $nombre =  $request->input('nombre');
            $correo =  $request->input('correo');
            $sexo =  $request->input('sexo');
            $area =  $request->input('area');
            $descripcion =  $request->input('descripcion');
            $boletin =  $request->input('boletin');
            $roles = json_decode($request->input('roles'));

            // validar campos obligatorios
            if (!isset($nombre)) {
                throw new Exception("El campo nombre es requerido");
            }
            if (!isset($correo)) {
                throw new Exception("El campo correo es requerido");
            }
            if (!isset($sexo)) {
                throw new Exception("El campo sexo es requerido");
            }
            if (!isset($area)) {
                throw new Exception("El campo área es requerido");
            }
            if (!isset($descripcion)) {
                throw new Exception("El campo descripción es requerido");
            }

            // se envian los datos a la transacción 
            \DB::beginTransaction();

            $empleado = Empleados::find($id);
            $empleado->nombre = $nombre;
            $empleado->email = $correo;
            $empleado->sexo = $sexo;
            $empleado->area_id = $area;
            $empleado->descripcion = $descripcion;
            $empleado->boletin = $boletin;

            $empleado->save();

            EmpleadoRol::where('empleado_id', $id)->delete();

            $roles = json_decode($request->input('roles'));
            // asociar roles al empleado
            foreach ($roles as $rol) {

                $obj = [
                    "rol_id" => $rol,
                    "empleado_id" =>  $empleado->id
                ];

                EmpleadoRol::create($obj);
            }

            \DB::commit();
        } catch (\Exception $e) {

            \DB::rollback();
            return \Response::json(array("resp" => "error", "msj" => $e->getMessage()), 422);
        }        
    }
}
