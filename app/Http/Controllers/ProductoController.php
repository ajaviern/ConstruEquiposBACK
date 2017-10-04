<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Respuesta;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = Producto::All();
        $respuesta = new Respuesta();

        if(count($productos)>0){

            $respuesta->data = $productos;
            $respuesta->error = false;
            $respuesta->mensaje = "Productos Encontrados";


        }else{
            $respuesta->data = $productos;
            $respuesta->error = true;
            $respuesta->mensaje = "No se encontraron productos";

        }

        return response()->json($respuesta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //
        $datos["nombre"] = $request->nombre;


        $productos = new Producto($datos);

        $respuesta = new Respuesta();

        if ($productos->save())
        {
            $respuesta->data = $productos;
            $respuesta->error = false;
            $respuesta->mensaje = "Producto Registrado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Producto No registrada";
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
        return Producto::find($id);
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
        $productos = Producto::find($id);

        $productos["nombre"] = $request->nombre;


        $respuesta = new Respuesta();

        if ($productos->save())
        {
            $respuesta->data = $productos;
            $respuesta->error = false;
            $respuesta->mensaje = "Producto Actualizado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Producto No Actualizado ";
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

        if (Producto::destroy($id))
        {
            $respuesta->error = false;
            $respuesta->mensaje = "Producto Eliminado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "El producto No pudo ser Eliminado";
        }

        return response()->json($respuesta);
    }
}
