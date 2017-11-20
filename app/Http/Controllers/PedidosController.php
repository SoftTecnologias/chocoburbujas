<?php

namespace App\Http\Controllers;

use App\canceldetail;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class PedidosController extends Controller
{
    public function getPedidos(){
        $pedidos = DB::select("SELECT v.id as orderid, (c.nombre+' '+c.ape_pat+' '+c.ape_mat) as name, c.telefono1 as phone,
		v.status as ostatus, (select nombre from users where userA = id) as userA,
		v.fecha_venta as orderdate
  FROM ventas as v 
  inner join clientes as c on cliente_id = c.id ",[1]);
        foreach ($pedidos as $pedido) {
            $pedido->orderid = base64_encode($pedido->orderid);
            switch ($pedido->ostatus){
                case 'N': $pedido->ostatus = 'No Asignado';
                    break;
                case 'T': $pedido->ostatus = 'Tomado';
                    break;
                case 'D': $pedido->ostatus = 'Despachado';
                    break;
                case 'E': $pedido->ostatus = 'Enviado';
                    break;
                case 'R': $pedido->ostatus = 'Recibido';
                    break;
                case 'C': $pedido->ostatus = 'Cancelado';
                    break;
                default: $pedido->ostatus = 'No Asignado';
                break;
            }
        }
        return Datatables::of(collect($pedidos))->make(true);
    }

    public function getTrabajadores(){
        $trabajadores = DB::select("Select nombre as name,id from users 
              where not exists (select userA from ventas where userA = users.id AND (ventas.status = 'D' or ventas.status = 'T' or ventas.status = 'N')) and
              users.rol = 1 ", [1]);
        foreach ($trabajadores as $trabajador)
            $trabajador->id = base64_encode($trabajador->id);

        return Response::json([
            'code' => 200,
            'msg' => json_encode($trabajadores),
            'detail' => 'OK'
        ]);
    }

    public function asignarTrabajador(Request $request, $id){
        try{
            $id = base64_decode($id);
            DB::table('ventas')
                ->where('id', $id)
                ->update(['userA' => base64_decode($request->trabajador),'status' => 'T']);

            $respuesta = ["code"=>200, "msg"=>"Usuario Asignado","detail"=>"success"];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(),"detail"=>"error"];
        }
        return Response::json($respuesta);
    }

    public function accion(Request $request, $id){
        try{
            $id = base64_decode($id);
            DB::table('ventas')
                ->where('id', $id)
                ->update(['status' => $request->estado]);
            if($request->estado == 'C'){
                $canceldetail = new canceldetail();

                $canceldetail->ventaid = $id;
                $canceldetail->detalle = $request->motivo;

                $canceldetail->save();
            }

            $respuesta = ["code"=>200, "msg"=>"El Pedido Cambio a Despachado","detail"=>"success"];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(),"detail"=>"error"];
        }
        return Response::json($respuesta);
    }

    public function pedidoDetail($id){

        try{
            $id = base64_decode($id);
            $detalle = DB::table('ventas as v')
                ->select('p.nombre as producto',
                    'd.precio as up','v.total')
                ->join('detalle_ventas as d','d.venta_id','=','v.id')
                ->join('productos as p','p.id','=','producto_id')
                ->join('marcas as m','m.id','=','p.marca_id')
                ->where('v.id','=',$id)
                ->get();
            $detalle_cancel = DB::table('ventas as v')
                ->select('p.nombre as producto','d.cantidad','d.total as tc',
                    'd.precio as up','cancel_detail.detalle','v.total')
                ->join('detalle_ventas as d','d.venta_id','=','v.id')
                ->join('productos as p','p.id','=','producto_id')
                ->join('marcas as m','m.id','=','p.marca_id')
                ->join('cancel_detail','v.id','=','cancel_detail.ventaid')
                ->where('v.id','=',$id)
                ->get();
            if($detalle_cancel != null){
                $detalle = $detalle_cancel;
            }

            return Response::json([
                'code' => 200,
                'msg' => json_encode($detalle),
                'detail' => 'OK'
            ]);
        }catch (Exception $e){
            dd($e);
        }

    }
}
