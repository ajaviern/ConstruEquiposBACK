<?php

namespace App\Http\Controllers;

use App\Entidades\Respuesta;
use Illuminate\Http\Request;

use App\User;
use Psy\CodeCleaner\UseStatementPass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return "hola";
        return response()->json(User::All());
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
        //
        $user = User::where('cedula', $request->cedula)
            ->select('*')
            ->get();

        $useremail = User::where('email', $request->email)
            ->select('*')
            ->get();

        //return $useremail;

        if($useremail->first()) {
            $respuesta->data = null;
            $respuesta->error = true;
            $respuesta->mensaje = "El email ya está Registrado";

            return response()->json($respuesta);

        }else{

            if($user->first()) {
                $respuesta->data = null;
                $respuesta->error = true;
                $respuesta->mensaje = "El usuario ya está Registrado";

                return response()->json($respuesta);
            }else{
                //
                $datos["cedula"] = $request->cedula;
                $datos["name"] = $request->name;
                $datos["apellido"] = $request->apellido;
                $datos["rol"] = $request->rol;
                $datos["telefono"] = $request->telefono;
                $datos["email"] = $request->email;
                $datos["password"] = $request->password;

                $usuario = new User($datos);



                if ($usuario->save())
                {
                    $respuesta->data = $usuario;
                    $respuesta->error = false;
                    $respuesta->mensaje = "Usuario creado exitosamente";

                }else{
                    $respuesta->error = true;
                    $respuesta->mensaje = "Usuario No creado";
                }

                return response()->json($respuesta);
            }
        }
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
        return User::find($id);
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
        $user = User::find($id);

        if ($user) {
            $user["cedula"] = $request->cedula;
            $user["name"] = $request->name;
            $user["apellido"] = $request->apellido;
            $user["rol"] = $request->rol;
            $user["telefono"] = $request->telefono;
            $user["email"] = $request->email;
            $user["password"] = $request->password;

            if ($user->save())
            {
                $respuesta->data = $user;
                $respuesta->error = false;
                $respuesta->mensaje = "Usuario Actualizado exitosamente";

            }else{
                $respuesta->error = true;
                $respuesta->mensaje = "Usuario No Actualizado";
            }

            return response()->json($respuesta);
        }else{
            $respuesta->data = $user;
            $respuesta->error = false;
            $respuesta->mensaje = "Usuario No se Actualizado exitosamente";
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

        if (User::destroy($id))
        {
            $respuesta->error = false;
            $respuesta->mensaje = "Usuario Eliminado exitosamente";

        }else{
            $respuesta->error = true;
            $respuesta->mensaje = "Usuario No Eliminado";
        }

        return response()->json($respuesta);
    }

    public function  login(Request $request){


        //return response()->json($request);
        $respuesta = new Respuesta();


        $user = User::Where('email',$request->email)->first();


        if (!$user)
        {
            $respuesta->error = true;
            $respuesta->mensaje = "No existe ese email registrado";

        }else{
            if($user->password!=$request->password)
            {
                $respuesta->error = true;
                $respuesta->mensaje = "Contraseña incorrecta";
            }else{
                $respuesta->data = $user;
                $respuesta->error = false;
                $respuesta->mensaje = "Ingreso exitoso";
            }

        }

        return response()->json($respuesta);
    }
}
