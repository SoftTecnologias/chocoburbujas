<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas = DB::table('blogs')->orderBy('fecha', 'desc')->get();

        return Response::json($entradas);
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
        try{
            $img = $request->file("img");
            $imgu = $request->input('imgu');
            $blogid = DB::table('blogs')->insertGetId([
                "titulo"=> $request->input('title'),
                "descripcion" => $request->input('description'),
                "img" => "blog.png"
            ]);
            if($imgu==null){
                if($img!=null){
                    $entrada = Blog::findOrFail($blogid);
                    $entrada->fill([
                        "img" => $blogid."_1.".$img->getClientOriginalExtension()
                    ]);
                    $entrada->save();
                    $nombre="/blogs/".$blogid."_1.".$img->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img));
                }
            }else{
                $f = explode("/",$imgu);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$blogid."_1.".$ext[sizeof($ext)-1];
                $product = Blog::findOrFail($blogid);
                $product->fill([
                    "img" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/blogs/".$nombre,  fopen($imgu,'r'));
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
    {
        try{
            $entrada = Blog::findOrFail($id);
            $respuesta=["code"=>200,"msg"=>$entrada,"detail"=>"ok"];
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
        try {
            $img = $request->file('img');
            $imgu = $request->input('imgu');
            $entrada = Blog::findOrFail($id);
            $up= ([
                "titulo" => $request->input('title'),
                "descripcion" => $request->input('description')
            ]);
            if($imgu==null){
                if($img!=null){
                    $up["img"]=$id."_1.". $request->file("img")->getClientOriginalExtension();
                    if($entrada->img != "blog.png") {
                        Storage::delete("/blogs/". $entrada->img);
                    }
                    $nombre="/blogs/".$id."_1.".$img->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img));
                }
            }else{
                $f = explode("/",$imgu);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$id."_1.".$ext[sizeof($ext)-1];
                $up['img'] = $nombre;
                if($entrada->img != "blog.png"){
                    Storage::delete("/blogs/". $entrada->img);
                }
                Storage::disk('local')->put("/blogs/".$nombre,  fopen($imgu,'r'));
            }
            $entrada->fill($up);
            $entrada->save();
            $respuesta = ["code"=>200, "msg"=>"Entrada actualizada ","detail"=>"success"];
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
            $entrada = Blog::findOrFail($id);
            if($entrada->img != "blog.png") {
                Storage::delete("/blogs/". $entrada->img);
            }
            $entrada->delete();

            $respuesta = ["code"=>200, "msg"=>'La entrada ha sido eliminada', 'detail' => 'success'];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }
}
