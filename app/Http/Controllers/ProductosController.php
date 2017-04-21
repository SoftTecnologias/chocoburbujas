<?php

namespace App\Http\Controllers;

use \App\Products;
use \App\Producto;
use Exception;
use File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = DB::table('productos')
                        ->select('productos.id',
                                 'productos.codigo',
                                 'productos.nombre',
                                 'productos.descripcion',
                                 'marcas.nombre as marca',
                                 'categorias.nombre as categoria',
                                 'proveedores.nombre as proveedor',
                                 'tipo_unidades.descripcion as unidad',
                                 'productos.stock_max',
                                 'productos.stock_min',
                                 'productos.stock',
                                 'productos.precio1',
                                 'productos.precio2',
                                 'productos.img1',
                                 'productos.img2',
                                 'productos.img3'
                                 )
                        ->join('marcas',"productos.marca_id",'=','marcas.id')
                        ->join('categorias',"productos.categoria_id",'=','categorias.id')
                        ->join('proveedores',"productos.proveedor_id",'=','proveedores.id')
                        ->join('tipo_unidades','productos.unidad_id','=','tipo_unidades.id')
                        ->get();
        return Response::json($productos);
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
            $img1 = $request->file("img1");
            $img2 = $request->file("img2");
            $img3 = $request->file("img3");
            $imgu1  = $request->input("imgu1");
            $imgu2  = $request->input("imgu2");
            $imgu3  = $request->input("imgu3");
            $productid = DB::table('productos')->insertGetId([
                "codigo"        => $request->input('codigo')   ,
                "nombre"        => $request->input('nombre')   ,
                "descripcion"   => $request->input('descripcion')   ,
                "marca_id"      => $request->input('marca_id')   ,
                "categoria_id"  => $request->input('categoria_id')   ,
                "proveedor_id"  => $request->input('proveedor_id')   ,
                "unidad_id"     => $request->input('unidad_id')   ,
                "stock_max"     => $request->input('maximo')   ,
                "stock_min"     => $request->input('minimo')   ,
                "stock"         => $request->input('actual')   ,
                "precio1"       => $request->input('precio1')   ,
                "precio2"       => $request->input('precio2')   ,
                "img1"          => "producto.png"   ,
                "img2"          => "producto.png"   ,
                "img3"          => "producto.png"
            ]);

            if($imgu1==null){
                if($img1!=null){
                    $product = Producto::findOrFail($productid);
                    $product->fill([
                        "img1" => $productid."_1.".$img1->getClientOriginalExtension()
                    ]);
                    $product->save();
                    $nombre="/productos/".$productid."_1.".$img1->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img1));
                }
            }else{
                $f = explode("/",$imgu1);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$productid."_1.".$ext[sizeof($ext)-1];
                $product = Producto::findOrFail($productid);
                $product->fill([
                    "img1" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/productos/".$nombre,  fopen($imgu1,'r'));
            }
            if($imgu2 == null){
                if($img2!=null){
                    $product = Producto::findOrFail($productid);
                    $product->fill([
                        "img2" => $productid."_2.".$img2->getClientOriginalExtension()
                    ]);
                    $product->save();
                    $nombre="/productos/".$productid."_2.".$img2->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img2));
                }
            }else{
                $f = explode("/",$imgu2);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$productid."_2.".$ext[sizeof($ext)-1];
                $product = Producto::findOrFail($productid);
                $product->fill([
                    "img2" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/productos/".$nombre,  fopen($imgu2,'r'));
            }
            if($imgu3 == null){
                if($img3!=null){
                    $product = Producto::findOrFail($productid);
                    $product->fill([
                        "img3" => $productid."_3.".$img3->getClientOriginalExtension()
                    ]);
                    $product->save();
                    $nombre="/productos/".$productid."_3.".$img3->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img3));
                }
            }else{
                $f = explode("/",$imgu3);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$productid."_3.".$ext[sizeof($ext)-1];
                $product = Producto::findOrFail($productid);
                $product->fill([
                    "img3" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/productos/".$nombre,  fopen($imgu3,'r'));
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

            $producto = Producto::findOrFail($id);
            $respuesta=["code"=>200,"msg"=>$producto,"detail"=>"ok"];
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
            $img1 = $request->file("img1");
            $img2 = $request->file("img2");
            $img3 = $request->file("img3");
            $imgu1  = $request->input("imgu1");
            $imgu2  = $request->input("imgu2");
            $imgu3  = $request->input("imgu3");
            $producto = Producto::findOrFail($id);
            $up=([
                "codigo"        => $request->input('codigo')   ,
                "nombre"        => $request->input('nombre')   ,
                "descripcion"   => $request->input('descripcion')   ,
                "marca_id"      => $request->input('marca_id')   ,
                "categoria_id"  => $request->input('categoria_id')   ,
                "proveedor_id"  => $request->input('proveedor_id')   ,
                "unidad_id"     => $request->input('unidad_id')   ,
                "stock_max"     => $request->input('maximo')   ,
                "stock_min"     => $request->input('minimo')   ,
                "stock"         => $request->input('actual')   ,
                "precio1"       => $request->input('precio1')   ,
                "precio2"       => $request->input('precio2')   ,
            ]);


            if($imgu1==null){
                if($img1!=null){
                    $up["img1"]=$id."_1.". $request->file("img1")->getClientOriginalExtension();
                    if($producto->img1 != "producto.png") {
                        Storage::delete("/productos/". $producto->img1);
                    }
                    $nombre="/productos/".$id."_1.".$img1->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img1));
                }
            }else{
                $f = explode("/",$imgu1);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$id."_1.".$ext[sizeof($ext)-1];
                $up['img1'] = $nombre;
                if($producto->img1 != "producto.png"){
                    Storage::delete("/productos/". $producto->img1);
                }
                Storage::disk('local')->put("/productos/".$nombre,  fopen($imgu1,'r'));
            }
            if($imgu2 == null){
                if($img2!=null){
                    $up["img2"]=$id."_2.". $request->file("img2")->getClientOriginalExtension();
                    if($producto->img2 != "producto.png") {
                        Storage::delete("/productos/". $producto->img2);
                    }
                    $nombre="/productos/".$id."_2.".$img2->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img2));
                }
            }else{
                $f = explode("/",$imgu2);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$id."_2.".$ext[sizeof($ext)-1];
                $up['img2'] = $nombre;
                if($producto->img2 != "producto.png"){
                    Storage::delete("/productos/". $producto->img2);
                }
                Storage::disk('local')->put("/productos/".$nombre,  fopen($imgu2,'r'));
            }
            if($imgu3 == null){
                if($img3!=null){
                    $up["img3"]=$id."_3.". $request->file("img3")->getClientOriginalExtension();
                    if($producto->img3 != "producto.png") {
                        Storage::delete("/productos/". $producto->img3);
                    }
                    $nombre="/productos/".$id."_3.".$img3->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre,  \File::get($img3));
                }
            }else{
                $f = explode("/",$imgu3);
                $ext = explode(".",$f[sizeof($f)-1]);
                $nombre=$id."_3.".$ext[sizeof($ext)-1];
                $up['img3'] = $nombre;
                if($producto->img3 != "producto.png"){
                    Storage::delete("/productos/". $producto->img3);
                }
                Storage::disk('local')->put("/productos/".$nombre,  fopen($imgu3,'r'));
            }

            $producto->fill($up);
            $producto->save();
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
            $producto = Producto::findOrFail($id);
            if($producto->img1 != "producto.png") {
                Storage::delete("/productos/". $producto->img1);
            }
            if($producto->img2 != "producto.png") {
                Storage::delete("/productos/". $producto->img2);
            }
            if($producto->img3 != "producto.png") {
                Storage::delete("/productos/". $producto->img3);
            }

            $producto->delete();

            $respuesta = ["code"=>200, "msg"=>'El usuario ha sido eliminado', 'detail' => 'success'];
        }catch(Exception $e){
            $respuesta = ["code"=>500, "msg"=>$e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }


}
