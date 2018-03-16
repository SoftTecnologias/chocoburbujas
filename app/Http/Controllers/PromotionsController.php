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
    public function index(){
        /*$product = DB::table('producto_promocion as pp')
            ->select('p.nombre','p.precio1')
            ->join('productos as p','pp.idProducto','=','p.id')
            ->where('pp.idPromocion',0)
            ->get();*/
        try{
            $promotion= Promotion::all();
            $datos =[];
            foreach ($promotion as $dato) {
                foreach ($dato->productPromotion as $pp) {
                    array_push($datos,[
                        'id' => $pp->idPromocion,
                        'nombre'=> $pp->producto->nombre,
                        'precio1'=> $pp->producto->precio1
                    ]);   
                }
            }
            return Response::json(Promotion::all());
        }catch(Exception $e){
            dd($e);
        }
    }

    public function indexDetails(){
        try{
            $promotion= Promotion::all();
            $datos =[];
            foreach ($promotion as $dato) {
                foreach ($dato->productPromotion as $pp) {
                    array_push($datos,[
                        'id' => $pp->idPromocion,
                        'nombre'=> $pp->producto->nombre,
                        'precio1'=> $pp->producto->precio1
                    ]);   
                }
            }
            return Response::json($datos);
        }catch(Exception $e){
            dd($e);
        }
    }
    public function rellenaTabla($id){
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
        $hoy =getdate();
        $hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
        $mpo = DB::table('promociones')
            ->select('id','nombre')
            ->where('fin_promocion','>=',$hoy)
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
    public function store(Request $request){
        try{
            $promocion = new Promotion();
            $promocion->nombre = $request->input('namepromo');
            $promocion->descripcion=$request->input('descripcionpromo');
            $promocion->descuento=$request->input('descuentopromo');
            $promocion->fin_promocion=$request->input('fechaFpromo');
            $promocion->inicio_promocion=$request->input('fechaIpromo');
            if ( $request->input('is_promotion_month') != null )
                $promocion->is_promotion_month =  $request->input('is_promotion_month');
            else
                $promocion->is_promotion_month =  0;
            $promocion->save();
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
        $respuesta = ['code' => 200, 'msg' => Promotion::find($id), 'detail' => 'success'];
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
            $promocion = Promotion::find($id);
            $promocion->nombre = $request->input('namepromo');
            $promocion->descripcion=$request->input('descripcionpromo');
            $promocion->descuento=$request->input('descuentopromo');
            $promocion->fin_promocion=$request->input('fechaFpromo');
            $promocion->inicio_promocion=$request->input('fechaIpromo');
            if ( $request->input('is_promotion_month') != null )
                $promocion->is_promotion_month =  $request->input('is_promotion_month');
            else
                $promocion->is_promotion_month =  0;
            $promocion->save();
            $respuesta = ['code' => 200, 'msg' => "Se actualizo correctamente", 'detail' => 'success'];
        }catch (Exception $e){
            $respuesta = ['code' => 500, 'msg' => "Error al agregar", 'detail' => 'error'];
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
        try {
            $promotion = Promotion::find($id);
            foreach ($promotion->productPromotion as $detalle) {
                $detalle->delete();
            }
            $promotion->delete();

            $respuesta = ["code" => 200, "msg" => 'La promoción ha sido eliminado', 'detail' => 'success'];
        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }

    //Eliminar promociones anteriores a la fecha (para limpiar la base de datos)
    public function deletePrevious(){
        try{
            $hoy =getdate();
            $hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
            $promo_vencidas = DB::table('promociones')->select('id')->where('fin_promocion','<',$hoy)->get();
            foreach ($promo_vencidas as $promo_vencida){
                DB::table('producto_promocion')->where('idPromocion', '=', $promo_vencida->id)->delete();
                $product = Promotion::destroy($promo_vencida->id);
            }

            $respuesta = ["code" => 200, "msg" => 'Las promociones se han eliminado correctamente', 'detail' => 'success'];

        }catch (Exception $e){
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }
}
