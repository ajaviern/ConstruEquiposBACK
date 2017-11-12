<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Respuesta;
use App\Equipo;
class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $equipos = Equipo::join('categoriaequipo','equipos.categoria','=','categoriaequipo.id')

            ->select('equipos.*','categoriaequipo.categoria as nombrecategoria')
            ->orderBy('equipos.created_at', 'ASC')
            ->get();
        //return response()->json($equipos);

       // $equipos  = Equipo::All() ;
        $respuesta = new Respuesta();
        if(count($equipos)>0){
            $respuesta->data =$equipos;
            $respuesta->error = false;
            $respuesta->mensaje = "Equipos encontrados exitosamente";
        }else{

            $respuesta->data =$equipos;
            $respuesta->error = true;
            $respuesta->mensaje = "Equipos No encontrados";
        }
        return response()->json($respuesta);
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
        $datos["categoria"] = $request->categoria;
        $datos["descripcion"] = $request->descripcion;
        $datos["modelo"] = $request->modelo;
        $datos["estado"] = "Activo";
        $datos["cantidad"] = $request->cantidad;
        $datos["valor"] = $request->valor;


        $equipo = new Equipo($datos);

        $respuesta = new Respuesta();

        if ($equipo->save())
        {
            $respuesta->data = $equipo;
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
        return Equipo::find($id);
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
        $equipo = Equipo::find($id);

        if($equipo){
            $equipo["descripcion"] = $request->descripcion;
            $equipo["modelo"] = $request->modelo;
            $equipo["estado"] = $request->estado;

            if ($equipo->save())
            {
                $respuesta->data = $equipo;
                $respuesta->error = false;
                $respuesta->mensaje = "Equipo Actualizado exitosamente";

            }else{
                $respuesta->error = true;
                $respuesta->mensaje = "Equipo No se pudo Actualizar";
            }

            return response()->json($respuesta);

        }else{
            $respuesta->data = $equipo;
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

        if (Equipo::destroy($id))
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
