<?php
/**
 * Created by PhpStorm.
 * User: Erley
 * Date: 07/11/2017
 * Time: 23:35
 */
namespace App\Logica;

use App\Entidades\Respuesta;
use App\Equipo;
use App\Producto;
use App\User;
use App\Alquiler;
use App\DetalleSalidas;
use Carbon\Carbon;
use DateInterval;
use DateTime;

class LogicaAlquiler
{

    /**
     * Método para la creacion de un nuevo alquiler
     * @param $datos
     */
    public function createAlquiler($datos)
    {


        $respuesta = new Respuesta();


        if ($this->ValidarDatosAlquiler($datos)) {

            if ($this->ValidarUsuario($datos['usuarios_id'])) {

                $detalles = $datos['detalle'];
                $hoy =  $datos['fecha'];
               // $hoy = Carbon::now();
                //$hoy->setTimezone('-5');
                //$hoy->toDateString();
               //$datos['fecha'] = strftime("%Y-%m-%d-%H-%M-%S", time());
                $datos['fecha'] = $hoy;
                $datos['total'] = $this->getSubtotal($datos['detalle'],$hoy);
                $datos['estado'] = "pendiente";


                $alquiler = new Alquiler($datos);
                if ($alquiler->save()) {

                    foreach ($detalles as $item) {
                        //cuando agregas un participante
                        //  return response()->json($DatosUserReunion);

                        $producto = $this->getProducto($item['equipos_id']);

                        $detalle['alquileres_id'] = $alquiler->id;
                        $detalle['equipos_id'] = $item['equipos_id'];
                        $detalle['fecha'] = $item['fecha'];

                        //Calculamos el total
                        $fecha_inicial = new DateTime($hoy);
                        $fecha_final = new DateTime($item['fecha']);
                        $interval = $fecha_inicial->diff($fecha_final);
                        $dias = $interval->format('%R%a días');
                        $sub =  $producto->valor * $item['cantidad'] * $dias;

                        $detalle['cantidad'] = $item['cantidad'];
                        $detalle['subtotal'] = $sub ;

                        //guardamos
                        $intersecto = new DetalleSalidas($detalle);
                        $intersecto->save();

                      //  $equipo = Equipo::find($detalle['equipos_id']);
                        $producto->cantidad=$producto->cantidad- $detalle['cantidad'];
                        $producto->update();


                    }

                    $respuesta->error = false;
                    $respuesta->mensaje = "Alquiler Registrado Exitosamente";
                    $respuesta->datos = $alquiler;
                } else {
                    $respuesta->error = true;
                    $respuesta->mensaje = "Error al crear el alquiler";
                }


            } else {
                $respuesta->error = true;
                $respuesta->mensaje = "Usuario Inválido";
            }

        } else {
            $respuesta->error = true;
            $respuesta->mensaje = "Faltan algunos datos";
        }


        return $respuesta;
    }

    /**
     * Método para la validacion de campos requeridos
     * @param $datos
     * @return bool
     */
    private function ValidarDatosAlquiler($datos)
    {

        if (!empty($datos["usuarios_id"]) &&
            !empty($datos["fecha"]) &&
            !empty($datos["detalle"])) {

            return true;

        }


        return false;
    }

    /**
     * Valida si este usuario es valido
     * @param $id
     * @return bool
     */
    private function ValidarUsuario($id)
    {
        $usuario = User::find($id);

        if ($usuario) {
            return true;
        }
        return false;
    }


    private function getProducto($id)
    {
        $equipo = Equipo::find($id);

        return $equipo;
    }

    /**
     * Método para obetner el subtotal de un alquiler
     * @param $detalles
     * @return int
     */
    private function getSubtotal($detalles,$fecha_ini)
    {

        $fecha_inicial = new DateTime($fecha_ini);

        $sub = 0;

        foreach ($detalles as $item) {
             $producto = $this->getProducto($item['equipos_id']);
            $fecha_final = new DateTime($item['fecha']);

            $interval = $fecha_inicial->diff($fecha_final);
            $dias = $interval->format('%R%a días');

            $sub = $sub + $producto->valor * $item['cantidad'] * $dias;



        }

        return $sub;
    }

    private function getHoraCarbon($string){


        //print_
       // $date = Carbon::now();
       // $date->setTimezone('-5');
        // Ejemplo 1
        //$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
        $porciones = explode("-", $string);

        //print_r('**********************');


        //print_r($porciones[0]);
        //print_r($porciones[1]);
        //print_r($porciones[2]);
        //exit;
        $res =   Carbon::create($porciones[0], $porciones[1], $porciones[2]);
      //  $res = Carbon::createFromDate($porciones[0], $porciones[1], $porciones[2]);
       // $date = explode("-", $fechaLimite);
        //$dateLimite = Carbon::createFromDate($date[0], $date[1], $date[2]);
        //if(is_numeric($porciones[0])&& $porciones[1]){
          //  $date->setTime($porciones[0],$porciones[1]);
       // }



        return $res;
    }



    /**
     * Método que devuelve todos los productos terminal que
     * @param $usuarios_id
     * @return Respuesta
     */
    public function GetAllAlquileresUsuario($usuarios_id){

        $respuesta = new Respuesta();

        if($this->ValidarUsuario($usuarios_id)){
            $alquileres = Alquiler::join('users', 'alquileres.usuarios_id', '=','users.id')
                    ->select('alquileres.*','users.cedula','users.name','users.apellido','users.telefono')
                    ->where('alquileres.usuarios_id', $usuarios_id)
                     ->orderBy('alquileres.created_at', 'DESC')
                    ->get();


            if (count($alquileres) > 0) {

                    //Agregamos el detalle del alquiler
                    foreach ($alquileres as $t){
                        $t["detalle"] = DetalleSalidas::join('alquileres', 'detalles_salidas.alquileres_id', '=', 'alquileres.id')
                            ->join('equipos', 'detalles_salidas.equipos_id', '=', 'equipos.id')
                            ->where('detalles_salidas.alquileres_id', $t["id"])
                            ->select('detalles_salidas.*', 'equipos.descripcion','equipos.modelo')
                            ->get();
                    }

                $respuesta->error = false;
                $respuesta->mensaje = "Alquileres Encontrados";
                $respuesta->datos = $alquileres;
            } else {
                $respuesta->error = true;
                $respuesta->mensaje = "El usuario no tiene alquileres";
            }

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Usuario Invalido";
        }


        return $respuesta;
    }

    public function GetAllAlquileres(){

        $respuesta = new Respuesta();

            $alquileres = Alquiler::join('users', 'alquileres.usuarios_id', '=','users.id')
                ->select('alquileres.*','users.cedula','users.name','users.apellido','users.telefono')
                ->orderBy('alquileres.created_at', 'DESC')
                ->get();


            if (count($alquileres) > 0) {

                //Agregamos el detalle del alquiler
                foreach ($alquileres as $t){
                    $t["detalle"] = DetalleSalidas::join('alquileres', 'detalles_salidas.alquileres_id', '=', 'alquileres.id')
                        ->join('equipos', 'detalles_salidas.equipos_id', '=', 'equipos.id')
                        ->where('detalles_salidas.alquileres_id', $t["id"])
                        ->select('detalles_salidas.*', 'equipos.descripcion','equipos.modelo')
                        ->get();
                }

                $respuesta->error = false;
                $respuesta->mensaje = "Alquileres Encontrados";
                $respuesta->datos = $alquileres;
            } else {
                $respuesta->error = true;
                $respuesta->mensaje = "El usuario no tiene alquileres";
            }



        return $respuesta;
    }

    public function Facturacion($id_alquiler){
        $respuesta = new Respuesta();

        $alquiler =Alquiler::find($id_alquiler);
         if($alquiler){
             $alquiler->estado ='despachado';
             $alquiler->update();

             $respuesta->error =false;
             $respuesta->data =$alquiler;
             $respuesta->mensaje="Alquiler Pagado y Despachado";

         }else{
            $respuesta->error =true;
           // $respuesta->data =$alquiler;
            $respuesta->mensaje="Error en el id del alquiler";

        }
        return $respuesta;

    }
}