<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use \App\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->select('id','nombre','ape_pat','ape_mat','email','username','img','rol')
            ->get();

        return Response::json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { /* Creación de los usuarios*/
      try{
          $userid = DB::table("users")->insertGetId([
              "nombre" => $request->input("nombre"),
              "ape_pat" => $request->input("ape_pat"),
              "ape_mat" => $request->input("ape_mat"),
              "email" => $request->input("email"),
              "username" => $request->input("username"),
              "password" => bcrypt($request->input("password")),
              "rol" => $request->input("rol"),
              'img' => "user.png"
          ]);
          /*En a siguiente parte se cargará la imagen y se renombrará*/
          if($request->file("img")!= null){
              $user = User::findOrFail($userid);
              $user->fill([
                  "img" => $userid.".".$request->file("img")->getClientOriginalExtension()
              ]);
              $user->save();
              $user->apikey = bcrypt($user->id);
              $nombre="/usuarios/".$userid.".".$request->file("img")->getClientOriginalExtension();
              Storage::disk('local')->put($nombre, File::get($request->file("img")));
              $user->save();
          }
          $respuesta = ["code"=>200, "msg"=>'El usuario fue creado exitosamente', 'detail' => 'success'];
      }catch (Exception $e){
          $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'warning'];
      }
      return Response::json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { /*Mostrar usuario en concreto*/
        try{
            $userid = User::findOrFail($id);
            $respuesta=["code"=>200,"msg"=>$userid,"detail"=>"ok"];
        }catch(Exception $e){
            $respuesta=["code"=>404,"msg"=>$e->getMessage(),"detail"=>"error"];
        }

        return Response::json($respuesta);
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
        try{
            $user = User::findOrFail($id);
            $up=([
                "nombre" => $request->input("nombre"),
                "ape_pat" => $request->input("ape_pat"),
                "ape_mat" => $request->input("ape_mat"),
                "email" => $request->input("email"),
                "username" => $request->input("username"),
                "rol" => $request->input("rol"),
            ]);
            /*Revisaremos si hay una contraseña*/
            if($request->input("password")!=null){
                /*Hay una contraseña por tanto se puede actualizar*/
                if(Hash::check($request->input("password"),$user->password)){
                    $up['password']=bcrypt($request->input("npassword"));
                }else{
                    throw  new Exception("La contraseña ingresada no coincide");
                }
            }
            /*Revisamos si hay una imagen cargada*/

            if($request->file("img")!=null){
                $up["img"]=$request->input("id").".". $request->file("img")->getClientOriginalExtension();
                if($user->img != "user.png") {
                    Storage::delete("/usuarios/". $user->img);
                }
                $file = $request->file("img");
                $nombre="/usuarios/".$id.".".$file->getClientOriginalExtension();
                Storage::disk('local')->put($nombre, File::get($file));
            }
            $user->fill($up);
            $user->save();
            $respuesta = ["code"=>200, "msg"=>"Usuario actualizado","detail"=>"success"];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(),"detail"=>"error"];
        }
        return Response::json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            if($user->img != "user.png") {
                Storage::delete("/usuarios/". $user->img);
            }
            $user->delete();

            $respuesta = ["code"=>200, "msg"=>'El usuario ha sido eliminado', 'detail' => 'success'];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }
}
