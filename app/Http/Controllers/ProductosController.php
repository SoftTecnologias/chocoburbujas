<?php

namespace App\Http\Controllers;

use App\Carrito;
use \App\Products;
use \App\Producto;
use Exception;
use File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Integer;


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

    public function addCarrito(Request $request, $id){
        $producto = Producto::find($id);
        $oldCart = Session::has('carrito') ? Session::get('carrito') : null;
        $cart = new Carrito($oldCart);
        $cart->add($producto, $producto->id);
        $request->session()->put('carrito',$cart);

        return back();
    }
    //llamada con ajax
    public function  addToCart(Request $request){
        try {
            //Buscamos el producto por codigo 'En teoria tiene que ser unico '
            $producto = Producto::where('codigo', '=', $request->input('codigo'))->first();
            $oldCart = Session::has('carrito') ? Session::get('carrito') : null;
            $cart = new Carrito($oldCart);
            $cart->add($producto, $producto->id);
            $request->session()->put('carrito', $cart);

            return Response::json([
                'code' => 200,
                'msg' => $cart,
                'detail' => 'OK'
            ]);
        }catch(Exception $e){
            return Response::json([
                'code' => 500,
                'msg' => $e->getMessage(),
                'detail' => 'error'
            ]);
        }
    }

    public function removeCarrito(Request $request, $id){
        if(!Session::has('carrito')){
            return view('shop.carrito');
        }
        $oldCart = Session::has('carrito') ? Session::get('carrito'):null;
        $cart = new Carrito($oldCart);
        $cart->remove($id);
        $request->session()->put('carrito',$cart);
        return back();
    }

    //llamada ajax
    public function removeCart(Request $request){
        if (!Session::has('carrito')){
            return Response::json([
                'code' => 404,
                'msg' => 'No tienes un carrito de compras disponible.',
                'detail' => 'Error'
            ]);
        }
        $producto = Producto::where('codigo','=',$request->input('codigo'))->first();
        $oldCart=Session::has('carrito') ? Session::get('carrito') : null;
        $cart = new Carrito($oldCart);
        $cart->remove($producto->id);
        $request->session()->put('carrito',$cart);
        return Response::json([
            'code' => 200,
            'msg' => $cart,
            'detail' => 'OK'
        ]);
    }
    public function getCarrito(){
        $categorias = DB::table('categorias')->take(10)->get();
        $marcas = DB::table('marcas')
            ->orderBy('nombre','asc')
            ->get();
        if(!Session::has('carrito')){
            return view('shop.carrito',['products'=> null,'categorias' => $categorias, 'marcas'=> $marcas]);
        }

        $oldCart = Session::get('carrito');
        $cart = new Carrito($oldCart);
        return view('shop.carrito',['products' => $cart->productos, 'total' =>$cart->total,'categorias' => $categorias, 'marcas'=> $marcas]);
    }

    public function Checkout(){
        if(!Session::has('carrito')){
            return view('shop.carrito');
        }
        $oldCart = Session::get('carrito');
        $cart = new Carrito($oldCart);
        $total = $cart->total;
        $categorias = DB::table('categorias')->take(10)->get();
        $marcas = DB::table('marcas')
            ->orderBy('nombre','asc')
            ->get();
        return view('shop.checkout',['total' => $total, 'categorias'=> $categorias,'marcas' => $marcas]);
    }

    public function getItems(){
        $oldCart = Session::get('carrito');
        $cart = new Carrito($oldCart);

        $respuesta = ['code' => 200, 'msg'=>$cart];
        return Response::json($respuesta);
    }

    public function search(Request $request){
        $busqueda= $request->query();

        /*
         * filtros que podemos recibir
         * Search = nombre del producto!
         * precio = 1-5 ciertos filtros. cualquier otro filtro será +500
         * marca = se hará la busqueda por nombre para recuperar el id de la marca (si existe)
         * */
        if(!array_key_exists('search',$busqueda)){ //Si no existe el parametro search ni para que -.-
            $topselling = DB::table('productos')->take(4)->orderBy('vendidos', 'asc')->get();
            $promociones = DB::table('productos')->take(10)->where('promocion',1)->orderBy('precio1', 'asc')->get();
            $blogs = DB::table('blogs')->take(4)->orderBy('fecha','desc')->get();
            $categorias = DB::table('categorias')->take(4)->get();
            $menu = array();
            $marcas = DB::table('marcas')
                ->orderBy('nombre','asc')
                ->get();
            foreach ($categorias as $categoria){
                $productos = DB::table('productos')->take(9)->where('categoria_id',$categoria->id)->orderBy('vendidos',1)->get();
                array_push($menu,[$categoria->id => $productos]);
            }
            return view('shop.index',['topselling'=>$topselling,
                'promociones'=>$promociones,
                'blogs' => $blogs,
                'categorias'=>$categorias,
                'marcas' => $marcas
            ]);
        }
        $search = $busqueda['search'];
        $marcas = DB::table('marcas')
            ->select(DB::raw("id, nombre,(
		                      SELECT COUNT(*)
		                      FROM [laravel_chocoburbujas].[dbo].[productos] p
		                      where p.marca_id = marcas.id AND (p.nombre like '%$search%' OR p.descripcion like '%$search%' OR p.codigo like '%$search%')
                             ) as total "))
            ->orderBy('nombre','asc')
            ->get();
        $categorias = DB::table('categorias')->take(10)->get();
        //search existe, pero no existe los parametros precio ni busqueda
        if(!array_key_exists('precio',$busqueda) && !array_key_exists('marca',$busqueda) ) { //no existen ambos filtros
            $resultado = DB::table('productos')
                ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                ->paginate(9);
        }
        else{
            //revisamos si existen los dos o solo alguno
            if(array_key_exists('precio', $busqueda) && array_key_exists('marca', $busqueda)){ //existen ambas y por tanto se hace la consulta
                $marca_id = DB::table('marcas')->select('id')->where('nombre',$busqueda['marca'])->first(); //obtenemos el id de la marca que pasamos
                try {
                    //revisamos que esté dentro de 1 - 5 si no la consulta debe ser diferente
                    if ((Integer)$busqueda['precio'] >= 1 && (Integer)$busqueda['precio'] <= 5) {
                        switch ((Integer) $busqueda['precio']) {
                            case 1:
                                $precio = array(0, 99.99);
                                break;
                            case 2:
                                $precio = array(100, 199.99);
                                break;
                            case 3:
                                $precio = array(200, 299.99);
                                break;
                            case 4:
                                $precio = array(300, 399.99);
                                break;
                            case 5:
                                $precio = array(400, 499.99);
                                break;
                        }
                        $resultado = DB::table('productos')
                            ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                            ->where('marca_id','=',$marca_id->id)
                            ->whereBetween('precio1',$precio)
                            ->paginate(9);

                    } else { // se tomará automaticamente +500
                        $resultado = DB::table('productos')
                            ->where([
                                ['nombre', 'like', '%' . $busqueda['search'] . '%'],
                                ['precio1','>',500]
                            ])
                            ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                            ->paginate(9);
                    }
                }catch(Exception $e){
                    //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                    $resultado = DB::table('productos')
                        ->where([
                            ['nombre', 'like', '%' . $busqueda['search'] . '%'],
                            ['precio1','>',500]
                        ])
                        ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                        ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                        ->paginate(9);
                }
            }else{ // solo existe una
                if(array_key_exists('precio', $busqueda)){
                    try {

                        //revisamos que esté dentro de 1 - 5 si no la consulta debe ser diferente
                        if ((Integer)$busqueda['precio'] >= 1 && (Integer)$busqueda['precio'] <= 5) {
                            switch ((Integer)$busqueda['precio']) {
                                case 1:
                                    $precio = array(0, 99.99);
                                    break;
                                case 2:
                                    $precio = array(100, 199.99);
                                    break;
                                case 3:
                                    $precio = array(200, 299.99);
                                    break;
                                case 4:
                                    $precio = array(300, 399.99);
                                    break;
                                case 5:
                                    $precio = array(400, 499.99);
                                    break;
                            }
                            $resultado = DB::table('productos')
                                ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                                ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                                ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                                ->whereBetween('precio1',$precio)
                                ->paginate(9);

                        } else { // se tomará automaticamente +500
                            $resultado = DB::table('productos')
                                ->where('precio1','>',500)
                                ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                                ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                                ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                                ->paginate(9);
                        }
                    }catch(Exception $e){
                        //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                        $resultado = DB::table('productos')
                            ->where('precio1','>',500)
                            ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                            ->paginate(9);
                    }
                }elseif (array_key_exists('marca', $busqueda)){
                    $marca_id = DB::table('marcas')->select('id')->where('nombre',$busqueda['marca'])->first(); //obtenemos el id de la marca que pasamos
                    $resultado = DB::table('productos')
                        ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                        ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                        ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                        ->where('marca_id','=',$marca_id->id)
                        ->paginate(9);
                }

            }
        }
        return view('shop.busqueda',['categorias'=>$categorias,'productos'=> $resultado, 'marcas' => $marcas]);
    }


}
