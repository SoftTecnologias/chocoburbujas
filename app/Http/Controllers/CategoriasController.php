<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

use \App\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /*Regresa todas las categorias*/
        return Datatables::eloquent(Categoria::query())->make(true);
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
    {  /*Aqui crearé la categoria */
        try {
            $categoria = DB::table('categorias')->insertGetId([
                'nombre' => $request->input('nombre')
            ]);
            $respuesta = ["code"=>200, "msg"=>'La categoria fue realizada exitosamente', 'detail' => 'success'];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'error'];
        }

        Return Response::json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   /*Mostrar una categoria en concreto*/
        try{
            $cat = Categoria::findOrFail($id);
            $respuesta = ["code" => 200, "msg"=>$cat,"detail"=>"ok"];
        }catch(Exception $e){
            $respuesta = ["code" => 404, "msg"=>$e->getMessage(),"detail"=>"error"];
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
            $cat = Categoria::find($id);
            $cat -> fill(['nombre'=>$request->input('nombre')]);
            $cat -> save();
            $respuesta = ["code"=>200, "msg"=>"Categoria actualizada","detail"=>"success"];
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
            $cate = Categoria::findOrFail($id);
            $cate ->delete();
            $respuesta = ["code"=>200, "msg"=>'La categoria se ha eliminado', 'detail' => 'success'];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);

    }

}
