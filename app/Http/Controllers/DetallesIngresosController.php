<?php

namespace App\Http\Controllers;

use App\Detalles_Ingresos;
use App\DetalleSalidas;
use App\DetallesIngresos;
use App\Equipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entidades\Respuesta;

class DetallesIngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(DetallesIngresos::All());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fechahoy = Carbon::now();
        $datos["id_detalles_salidas"] = $request->id_detalles_salidas;
        $datos["cantidad_ingreso"] = $request->cantidad_ingreso;
        $datos["fecha_ingreso"] = $fechahoy;

        //accedemos a la tabla
        $equipo = Equipo::select('equipos.*')
                ->join('detalles_salidas','equipos.id','detalles_salidas.equipos_id')//para enlazar 2 tablas
                ->join('alquileres','detalles_salidas.alquileres_id','alquileres.id')//para enlazar 2 tablas
                ->join('users','alquileres.usuarios_id','users.id')
                ->where('detalles_salidas.id', $datos["id_detalles_salidas"])// comparamos que detalles_salidas.id sea igual a  $datos["id_detalles_salidas"]
                //  ->get();//esto devuelve un array una coleccion
                ->first();//devuelve el primero de la coleccion
        //print_r($equipo);
        //exit;

        $equipo->cantidad= $equipo->cantidad + $datos["cantidad_ingreso"];
        $equipo->save();

        $detallesalida = DetalleSalidas::select('detalles_salidas.*')
            ->where('detalles_salidas.id', $datos["id_detalles_salidas"])// comparamos que detalles_salidas.id sea igual a  $datos["id_detalles_salidas"]
            //  ->get();//esto devuelve un array una coleccion
            ->first();//devuelve el primero de la coleccion

        $detallesalida->estado= 1;
        $detallesalida->save();

        $ingreso = new Detalles_Ingresos($datos);


        $respuesta = new Respuesta();



        if ($ingreso->save()) {
            $respuesta->data = $ingreso;
            $respuesta->error = false;
            $respuesta->mensaje = "Ingreso exitosamente Registrado..";


        } else {
            $respuesta->error = true;
            $respuesta->mensaje = "Ingreso No registrado";
        }

        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respuesta = new Respuesta();
        //
        $ingreso = Detalles_Ingresos::find($id);


        if ($ingreso) {
            $respuesta->data = $ingreso;
            $respuesta->error = false;
            $respuesta->mensaje = "Ingreso encontrado exitosamente";
            return response()->json($respuesta);
        } else {
            $respuesta->data = null;
            $respuesta->error = true;
            $respuesta->mensaje = "Ingreso No encontrado";
            return response()->json($respuesta);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        //
        $ingreso = DetallesIngresos::find($id);

        if ($ingreso) {

            $producto["id_detalles_salidas"] = $request->id_detalles_salidas;
            $producto["cantidad_ingreso"] = $request->cantidad_ingreso;
            $producto["fecha_ingreso"] = $request->fecha_ingreso;

            if ($producto->save()) {
                $respuesta->data = $ingreso;
                $respuesta->error = false;
                $respuesta->mensaje = "Ingreso Actualizado exitosamente";

            } else {
                $respuesta->error = true;
                $respuesta->mensaje = "Ingreso No Actualizado";
            }

            return response()->json($respuesta);
        } else {
            return response()->json("El Ingreso no se encuentra Registrado");
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $respuesta = new Respuesta();

        if (DetallesIngresos::destroy($id)) {
            $respuesta->error = false;
            $respuesta->mensaje = "Ingreso Eliminado exitosamente";

        } else {
            $respuesta->error = true;
            $respuesta->mensaje = "Ingreso No Eliminado";
        }

        return response()->json($respuesta);
    }
}
