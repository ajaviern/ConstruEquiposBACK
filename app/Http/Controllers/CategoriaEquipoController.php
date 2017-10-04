<?php

namespace App\Http\Controllers;

use App\CategoriaEquipo;
use Illuminate\Http\Request;
use App\Entidades\Respuesta;
use App\Equipo;
class CategoriaEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoriaequipo = CategoriaEquipo::All();
        $respuesta = new Respuesta();

       if($categoriaequipo){

           $respuesta->data = $categoriaequipo;
           $respuesta->error = false;
            $respuesta->mensaje = "Categorias Actuales";


       }else{
           $respuesta->data = $categoriaequipo;
           $respuesta->error = true;
           $respuesta->mensaje = "No se encontraron categorias";

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


        $categoriaequipo = new CategoriaEquipo($datos);

        $respuesta = new Respuesta();

        if ($categoriaequipo->save())
        {
            $respuesta->data = $categoriaequipo;
            $respuesta->error = false;
            $respuesta->mensaje = "Categoria Registrada exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Categoria No registrada";
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
        return CategoriaEquipo::find($id);
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
        //
        $categoriaequipo = CategoriaEquipo::find($id);

        $categoriaequipo["categoria"] = $request->categoria;


        $respuesta = new Respuesta();

        if ($categoriaequipo->save())
        {
            $respuesta->data = $categoriaequipo;
            $respuesta->error = false;
            $respuesta->mensaje = "Categoria Actualizada exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Categoria No Actualizada";
        }

        return response()->json($respuesta);
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

        if (CategoriaEquipo::destroy($id))
        {
            $respuesta->error = false;
            $respuesta->mensaje = "Categoria Eliminada exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "La categoria No pudo ser Eliminada";
        }

        return response()->json($respuesta);
    }
}
