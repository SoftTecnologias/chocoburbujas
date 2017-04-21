<?php

namespace App\Http\Controllers;

use App\Marca;
use Exception;
use File;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Facades\Datatables;


class MarcasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /*Regresa todas las marcas*/
        return Datatables::eloquent(Marca::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // panel/api/categorias
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $brandid= DB::table("marcas")->insertGetId([
                "nombre" => $request->input("nombre"),
                "img" => "brand.png"
            ]);
            if($request->file("img")!= null){
                $brand = Marca::findOrFail($brandid);
                $brand->fill([
                    "img"=> $brandid.".".$request->file("img")->getClientOriginalExtension()
                ]);
                $brand ->save();
                $nombre="/marcas/".$brandid.".".$request->file("img")->getClientOriginalExtension();
                Storage::disk('local') ->put($nombre, File::get($request->file("img")));
            }
            $respuesta = ["code"=>200, "msg"=>'La marca fue creada exitosamente', 'detail' => 'success'];
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
    {
        /*Mostrar una marca en concreto*/
        try{
            $marca = Marca::findOrFail($id);
            $respuesta=["code"=>200,"msg"=>$marca,"detail"=>"ok"];
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
            $marca = Marca::findOrFail($id);
            $up = ([
                "nombre" => $request->input('nombre')
            ]);

            if($request->file("img")!=null){
                $up["img"]=$request->input("id").".". $request->file("img")->getClientOriginalExtension();
                if($marca->img != "brand.png") {
                    Storage::delete("/marcas/" . $marca->img);
                }
                $file = $request->file("img");
                $nombre="/marcas/".$id.".".$file->getClientOriginalExtension();
                Storage::disk('local')->put($nombre, File::get($file));
            }
            $marca->fill($up);
            $marca->save();
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
          $marca = Marca::findOrFail($id);
            if($marca->img != "brand.png") {
                Storage::delete("/marcas/" . $marca->img);
            }
          $marca->delete();
          $respuesta = ["code"=>200, "msg"=>'La marca ha sido eliminada', 'detail' => 'success'];
        }catch(Exception $e){
          $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }
}
