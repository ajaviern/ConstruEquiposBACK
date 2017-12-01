<?php

namespace App\Http\Controllers;

use App\CategoriaEquipo;
use App\DetalleSalidas;
use Illuminate\Http\Request;
use App\Entidades\Respuesta;
use App\Equipo;
use Carbon\Carbon;
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
        $datos['totalExistencias']= $datos["cantidad"];

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
    public function show($categorias_id)
    {
        $equipos = Equipo::join('categoriaequipo', 'equipos.categoria', '=','categoriaequipo.id')
            ->select('equipos.*','categoriaequipo.categoria as nombreCategoria')
            ->where('equipos.categoria', $categorias_id)
           // ->orderBy('alquileres.created_at', 'DESC')
            ->get();

        return $equipos;
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

    /**
     * EquiposmasAlquilados a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function EquiposmasAlquilados()
    {
        //
        $respuesta = new Respuesta();

        $equiposall =  Equipo::select('equipos.*')
           // ->where()
            ->get();

            foreach ($equiposall as $equipo){
                $detalles = DetalleSalidas::select('detalles_salidas.*')
                    ->where('detalles_salidas.equipos_id',$equipo->id)
                    ->get();
                $equipo['y'] = count($detalles);
                $equipo['key']= $equipo->descripcion;
            }

            $respuesta->error = false;
            $respuesta->mensaje = "Reportes";
            $respuesta->data=$equiposall;


        return response()->json($respuesta);
    }

    public function EquiposmasAlquiladosPorMes($fechaInicial,$fechaFinal)
    {
        //
        $respuesta = new Respuesta();
        $Fechahoy= Carbon::now();

        $Hace30 = $Fechahoy->subDays(30);


        $equiposall =  Equipo::select('equipos.*')
            // ->where()
            ->get();

        foreach ($equiposall as $equipo){
            $detalles = DetalleSalidas::select('detalles_salidas.*','alquileres.fecha as fechainicial')
                ->join('alquileres','detalles_salidas.equipos_id','alquileres.id')
                ->where('detalles_salidas.equipos_id',$equipo->id)
               ->where('detalles_salidas.fecha ',$equipo->fecha)
               // ->where('detalles_salidas.fecha','',$equipo->fecha)
                ->get();
            $equipo['y'] = count($detalles);
            $equipo['key']= $equipo->descripcion;
        }

        $respuesta->error = false;
        $respuesta->mensaje = "Reportes";
        $respuesta->data=$equiposall;


        return response()->json($respuesta);
    }

    public function AlquileresSeisMesesAntes()
    {



        //
        $respuesta = new Respuesta();

        $categorias  = CategoriaEquipo::select('categoriaequipo.*')
            // ->where()
            ->get();


        $labels = [];
        $data = [];

        $cont = 0;
        foreach ($categorias as $cat){
          $detalles = DetalleSalidas::select('detalles_salidas.*')
              ->join('equipos','detalles_salidas.equipos_id','equipos.id')
              ->join('categoriaequipo','equipos.categoria','categoriaequipo.id')
               ->where('categoriaequipo.id',$cat->id)
              ->get();
          $sub = 0;

            foreach ($detalles as $detalle){
                $sub = $sub +$detalle->subtotal;
            }
            $labels[$cont] =$cat->categoria;
            $data[$cont] = $sub;
            $cont++;

        }

        $answer['labels']=$labels;
        $answer['data']=$data;



        $respuesta->error = false;
        $respuesta->mensaje = "Datos encontrados";
        $respuesta->data=$answer;


        return response()->json($respuesta);
    }
}
