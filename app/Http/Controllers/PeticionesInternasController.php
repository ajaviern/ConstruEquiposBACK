<?php

namespace App\Http\Controllers;

use App\PeticionesInternas;
use Illuminate\Http\Request;
use App\Entidades\Respuesta;

class PeticionesInternasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(PeticionesInternas::All());
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
        $respuesta = new Respuesta();
        $datos["id_usuario"] = $request->id_usuario;

        $peticion = new PeticionesInternas($datos);



        if ($peticion->save())
        {
            $respuesta->data = $peticion;
            $respuesta->error = false;
            $respuesta->mensaje = "Equipo Registrado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Equipo No registrado";
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
        //
        return PeticionesInternas::find($id);
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
        $peticion = PeticionesInternas::find($id);

        if($peticion){
            $peticion["id_usuario"] = $request->id_usuario;

            if ($peticion->save())
            {
                $respuesta->data = $peticion;
                $respuesta->error = false;
                $respuesta->mensaje = "Equipo Actualizado exitosamente";

            }else{
                $respuesta->error = true;
                $respuesta->mensaje = "Equipo No se pudo Actualizar";
            }

            return response()->json($respuesta);

        }else{
            $respuesta->data = $peticion;
            $respuesta->error = true;
            $respuesta->mensaje = "Equipo No Encontrado";
            return response()->json($respuesta);
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

        if (PeticionesInternas::destroy($id))
        {
            $respuesta->error = false;
            $respuesta->mensaje = "Usuario Eliminado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Usuario No Eliminado";
        }

        return response()->json($respuesta);
    }
}
