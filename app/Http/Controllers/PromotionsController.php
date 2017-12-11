<?php

namespace App\Http\Controllers;

use App\Product_Promotion;
use App\Promotion;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class PromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('producto_promocion as pp')
            ->select('p.nombre','p.precio1')
            ->join('productos as p','pp.idProducto','=','p.id')
            ->where('pp.idPromocion',0)
            ->get();

        return Response::json($product);
    }

    public function rellenaTabla($id)
    {

        $products = DB::table('producto_promocion as pp')
            ->select('p.nombre','p.precio1','pr.descuento','p.id')
            ->join('productos as p','pp.idProducto','=','p.id')
            ->join('promociones as pr','pp.idPromocion','=','pr.id')
            ->where('pp.idPromocion',$id)
            ->get();
        foreach ($products as $product){
            $product->descuento = $product->descuento/100;
        }

        return Response::json($products);
    }

    public function addProductToPromotion(Request $request){

    }

    public function getPromotions(){


        $mpo = DB::table('promociones')
            ->select('id','nombre')
            ->get();
        if(sizeof($mpo) > 0){
            $respuesta = ['code' => 200, 'msg' => $mpo, 'detail' => 'Ok'];
        }else{
            $respuesta = ['code' => 404, 'msg' => ['id'=>"",'nombre'=>"No se pudo recuperar los datos"], 'detail' => 'error'];
        }
        return Response::json($respuesta);
    }

    public function getPromotionsinfo($id){
        $mpo =Promotion::findOrFail($id);
        if(sizeof($mpo) > 0){
            $respuesta = ['code' => 200, 'msg' => $mpo, 'detail' => 'Ok'];
        }else{
            $respuesta = ['code' => 404, 'msg' => ['id'=>"",'nombre'=>"No se pudo recuperar los datos"], 'detail' => 'error'];
        }
        return Response::json($respuesta);
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
    {
        try{
            DB::table('promociones')->insertGetId([
                "nombre"=>$request->input('namepromo'),
                "descripcion"=>$request->input('descripcionpromo'),
                "descuento"=>$request->input('descuentopromo'),
                "fin_promocion"=>$request->input('fechapromo')]);

            $respuesta = ['code' => 200, 'msg' => "Se agrego correctamente", 'detail' => 'success'];
        }catch (Exception $e){
            $respuesta = ['code' => 500, 'msg' => "Error al agregar", 'detail' => 'error'];
        }
        return Response::json($respuesta);
    }

    public function productPromotion(Request $request){
        try{
            Product_Promotion::create([
                'idProducto' => $request->idproduct,
                'idPromocion'=> $request->idpromo
            ]);

            $respuesta = ['code' => 200, 'msg' => "Se agrego correctamente", 'detail' => 'success'];
        }catch (Exception $e){
            $respuesta = ['code' => 500, 'msg' => "Error al agregar", 'detail' => 'error'];
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $array = explode("-",$id);

            $product = DB::table('producto_promocion')
                ->where('idProducto',$array[0])
                ->where('idPromocion',$array[1])
                ->delete();

            $respuesta = ["code" => 200, "msg" => 'El producto ha sido eliminado', 'detail' => 'success'];
        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }
}
