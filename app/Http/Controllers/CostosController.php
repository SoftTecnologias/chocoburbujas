<?php

namespace App\Http\Controllers;

use App\Costo_Envio;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class CostosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costos = DB::table("costo_envio as ce")
                -> select('ce.id','ce.costo','c.nombre as estado','m.nombre as muni')
                ->join('estados as c','ce.estado_id','=','c.id')
                ->join('municipios as m', 'ce.municipio_id','=','m.id')
                ->get();
        foreach ($costos as $costo){
            $costo->id = base64_encode($costo->id);
        }
        return Datatables::of(collect($costos))->make(true);
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
        //
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
        try {
            $id = base64_decode($id);
                $costo = Costo_Envio::findOrFail($id);

                $costo->costo = $request->motivo;

                $costo->save();
            $respuesta = ["code" => 200, "msg" => "Costo Actualizado", "detail" => "success"];
        }catch (Exception $e){
            $respuesta = ["code" => 500, "msg" => "Error al Actualizar", "detail" => "error"];
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
            $id = base64_decode($id);
           Costo_Envio::destroy($id);

            $respuesta = ["code" => 200, "msg" => "Eliminado Exitosamente", "detail" => "success"];
        }catch (Exception $e){
            $respuesta = ["code" => 500, "msg" => "Error al Eliminar", "detail" => "error"];
        }
        return Response::json($respuesta);
    }
}
