<?php

namespace App\Http\Controllers;

use App\Ingresos;
use Illuminate\Http\Request;
use App\Entidades\Respuesta;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Ingresos::All());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos["id_alquiler"] = $request->id_alquiler;
        $datos["id_alquiler_tabla_intersecto"] = $request->id_alquiler_tabla_intersecto;

        $ingreso = new Ingresos($datos);

        $respuesta = new Respuesta();

        if ($ingreso->save())
        {
            $respuesta->data = $ingreso;
            $respuesta->error = false;
            $respuesta->mensaje = "Ingreso exitosamente Registrado..";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Ingreso No registrado";
        }

        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respuesta = new Respuesta();
        //
        $ingreso = Ingresos::find($id);



        if($ingreso){
            $respuesta->data = $ingreso;
            $respuesta->error = false;
            $respuesta->mensaje = "Ingreso encontrado exitosamente";
            return response()->json($respuesta);
        }else{
            $respuesta->data = null;
            $respuesta->error = true;
            $respuesta->mensaje = "Ingreso No encontrado";
            return response()->json($respuesta);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = new Respuesta();
        //
        $ingreso = Ingresos::find($id);

        if($ingreso) {
            $producto["id_alquiler"] = $request->id_alquiler;
            $producto["id_alquiler_tabla_intersecto"] = $request->id_alquiler_tabla_intersecto;




            if ($producto->save())
            {
                $respuesta->data = $ingreso;
                $respuesta->error = false;
                $respuesta->mensaje = "Ingreso Actualizado exitosamente";

            }else{
                $respuesta->error = true;
                $respuesta->mensaje = "Ingreso No Actualizado";
            }

            return response()->json($respuesta);
        }else{
            return response()->json("El Ingreso no se encuentra Registrado");
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $respuesta = new Respuesta();

        if (Ingresos::destroy($id))
        {
            $respuesta->error = false;
            $respuesta->mensaje = "Ingreso Eliminado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Ingreso No Eliminado";
        }

        return response()->json($respuesta);
    }
}
