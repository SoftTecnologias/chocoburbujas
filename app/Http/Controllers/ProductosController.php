<?php

namespace App\Http\Controllers;

use App\Carrito;
use App\Cliente;
use App\Costo_Envio;
use App\Detalle_Pedido;
use App\Estado;
use App\Municipio;
use App\Pedido;
use \App\Products;
use \App\Producto;
use Exception;
use File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
                'productos.img3',
                'productos.mostrar'
            )
            ->join('marcas', "productos.marca_id", '=', 'marcas.id')
            ->join('categorias', "productos.categoria_id", '=', 'categorias.id')
            ->join('proveedores', "productos.proveedor_id", '=', 'proveedores.id')
            ->join('tipo_unidades', 'productos.unidad_id', '=', 'tipo_unidades.id')
            ->get();
        return Response::json($productos);
    }

    public function mostrarEnIndex(Request $request,$id){
      try {
          $producto = Producto::findOrFail($id);

          $producto->fill([
              "mostrar" => $request->mostrar
          ]);

          $producto->save();
          $respuesta = ["code" => 200, "msg" => '', 'detail' => 'success'];
      }catch (Exception $e){
          $respuesta = ["code" => 500, "msg" => 'Error al conectar con el servicio, intentelo mas tarde', 'detail' => 'error'];
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
        // panel/api/categorias
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $img1 = $request->file("img1");
            $img2 = $request->file("img2");
            $img3 = $request->file("img3");
            $imgu1 = $request->input("imgu1");
            $imgu2 = $request->input("imgu2");
            $imgu3 = $request->input("imgu3");
            $productid = DB::table('productos')->insertGetId([
                "codigo" => $request->input('codigo'),
                "nombre" => $request->input('nombre'),
                "descripcion" => $request->input('descripcion'),
                "marca_id" => $request->input('marca_id'),
                "categoria_id" => $request->input('categoria_id'),
                "proveedor_id" => $request->input('proveedor_id'),
                "unidad_id" => $request->input('unidad_id'),
                "stock_max" => $request->input('maximo'),
                "stock_min" => $request->input('minimo'),
                "stock" => 0,
                "precio1" => $request->input('precio1'),
                "precio2" => $request->input('precio2'),
                "img1" => "producto.png",
                "img2" => "producto.png",
                "img3" => "producto.png",
                "mostrar" => "0"
            ]);
            if ($imgu1 == null) {
                if ($img1 != null) {
                    $product = Producto::findOrFail($productid);
                    $product->fill([
                        "img1" => $productid . "_1." . $img1->getClientOriginalExtension()
                    ]);
                    $product->save();
                    $nombre = "/productos/" . $productid . "_1." . $img1->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, \File::get($img1));
                }
            } else {
                $f = explode("/", $imgu1);
                $ext = explode(".", $f[sizeof($f) - 1]);
                $nombre = $productid . "_1." . $ext[sizeof($ext) - 1];
                $product = Producto::findOrFail($productid);
                $product->fill([
                    "img1" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/productos/" . $nombre, fopen($imgu1, 'r'));
            }
            if ($imgu2 == null) {
                if ($img2 != null) {
                    $product = Producto::findOrFail($productid);
                    $product->fill([
                        "img2" => $productid . "_2." . $img2->getClientOriginalExtension()
                    ]);
                    $product->save();
                    $nombre = "/productos/" . $productid . "_2." . $img2->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, \File::get($img2));
                }
            } else {
                $f = explode("/", $imgu2);
                $ext = explode(".", $f[sizeof($f) - 1]);
                $nombre = $productid . "_2." . $ext[sizeof($ext) - 1];
                $product = Producto::findOrFail($productid);
                $product->fill([
                    "img2" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/productos/" . $nombre, fopen($imgu2, 'r'));
            }
            if ($imgu3 == null) {
                if ($img3 != null) {
                    $product = Producto::findOrFail($productid);
                    $product->fill([
                        "img3" => $productid . "_3." . $img3->getClientOriginalExtension()
                    ]);
                    $product->save();
                    $nombre = "/productos/" . $productid . "_3." . $img3->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, \File::get($img3));
                }
            } else {
                $f = explode("/", $imgu3);
                $ext = explode(".", $f[sizeof($f) - 1]);
                $nombre = $productid . "_3." . $ext[sizeof($ext) - 1];
                $product = Producto::findOrFail($productid);
                $product->fill([
                    "img3" => $nombre
                ]);
                $product->save();
                Storage::disk('local')->put("/productos/" . $nombre, fopen($imgu3, 'r'));
            }
            $respuesta = ["code" => 200, "msg" => 'El usuario fue creado exitosamente', 'detail' => 'success'];
        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $respuesta = ["code" => 200, "msg" => $producto, "detail" => "ok"];
        } catch (Exception $e) {
            $respuesta = ["code" => 404, "msg" => $e->getMessage(), "detail" => "error"];
        }

        return Response::json($respuesta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $img1 = $request->file("img1");
            $img2 = $request->file("img2");
            $img3 = $request->file("img3");
            $imgu1 = $request->input("imgu1");
            $imgu2 = $request->input("imgu2");
            $imgu3 = $request->input("imgu3");
            $producto = Producto::findOrFail($id);
            $up = ([
                "codigo" => $request->input('codigo'),
                "nombre" => $request->input('nombre'),
                "descripcion" => $request->input('descripcion'),
                "marca_id" => $request->input('marca_id'),
                "categoria_id" => $request->input('categoria_id'),
                "proveedor_id" => $request->input('proveedor_id'),
                "unidad_id" => $request->input('unidad_id'),
                "stock_max" => $request->input('maximo'),
                "stock_min" => $request->input('minimo'),
                "precio1" => $request->input('precio1'),
                "precio2" => $request->input('precio2'),
            ]);


            if ($imgu1 == null) {
                if ($img1 != null) {
                    $up["img1"] = $id . "_1." . $request->file("img1")->getClientOriginalExtension();
                    if ($producto->img1 != "producto.png") {
                        Storage::delete("/productos/" . $producto->img1);
                    }
                    $nombre = "/productos/" . $id . "_1." . $img1->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, \File::get($img1));
                }
            } else {
                $f = explode("/", $imgu1);
                $ext = explode(".", $f[sizeof($f) - 1]);
                $nombre = $id . "_1." . $ext[sizeof($ext) - 1];
                $up['img1'] = $nombre;
                if ($producto->img1 != "producto.png") {
                    Storage::delete("/productos/" . $producto->img1);
                }
                Storage::disk('local')->put("/productos/" . $nombre, fopen($imgu1, 'r'));
            }
            if ($imgu2 == null) {
                if ($img2 != null) {
                    $up["img2"] = $id . "_2." . $request->file("img2")->getClientOriginalExtension();
                    if ($producto->img2 != "producto.png") {
                        Storage::delete("/productos/" . $producto->img2);
                    }
                    $nombre = "/productos/" . $id . "_2." . $img2->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, \File::get($img2));
                }
            } else {
                $f = explode("/", $imgu2);
                $ext = explode(".", $f[sizeof($f) - 1]);
                $nombre = $id . "_2." . $ext[sizeof($ext) - 1];
                $up['img2'] = $nombre;
                if ($producto->img2 != "producto.png") {
                    Storage::delete("/productos/" . $producto->img2);
                }
                Storage::disk('local')->put("/productos/" . $nombre, fopen($imgu2, 'r'));
            }
            if ($imgu3 == null) {
                if ($img3 != null) {
                    $up["img3"] = $id . "_3." . $request->file("img3")->getClientOriginalExtension();
                    if ($producto->img3 != "producto.png") {
                        Storage::delete("/productos/" . $producto->img3);
                    }
                    $nombre = "/productos/" . $id . "_3." . $img3->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, \File::get($img3));
                }
            } else {
                $f = explode("/", $imgu3);
                $ext = explode(".", $f[sizeof($f) - 1]);
                $nombre = $id . "_3." . $ext[sizeof($ext) - 1];
                $up['img3'] = $nombre;
                if ($producto->img3 != "producto.png") {
                    Storage::delete("/productos/" . $producto->img3);
                }
                Storage::disk('local')->put("/productos/" . $nombre, fopen($imgu3, 'r'));
            }

            $producto->fill($up);
            $producto->save();
            $respuesta = ["code" => 200, "msg" => "Usuario actualizado", "detail" => "success"];
        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), "detail" => "error"];
        }
        return Response::json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            if ($producto->img1 != "producto.png") {
                Storage::delete("/productos/" . $producto->img1);
            }
            if ($producto->img2 != "producto.png") {
                Storage::delete("/productos/" . $producto->img2);
            }
            if ($producto->img3 != "producto.png") {
                Storage::delete("/productos/" . $producto->img3);
            }

            $producto->delete();

            $respuesta = ["code" => 200, "msg" => 'El usuario ha sido eliminado', 'detail' => 'success'];
        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), 'detail' => 'warning'];
        }
        return Response::json($respuesta);
    }

    public function addCarrito(Request $request, $id)
    {
        $producto = Producto::find($id);
        $oldCart = Session::has('carrito') ? Session::get('carrito') : null;
        $cart = new Carrito($oldCart);
        $cart->add($producto, $producto->id);
        $request->session()->put('carrito', $cart);

        return back();
    }

    //llamada con ajax
    public function addToCart(Request $request)
    {
        try {
            //Buscamos el producto por codigo 'En teoria tiene que ser unico '
            if ($cookie = Cookie::get('cliente')) {
                $producto = Producto::where('codigo', '=', $request->input('codigo'))->first();
                $hoy =getdate();
                $hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $promotions = DB::table('producto_promocion')->join('promociones','idPromocion','=','idPromocion')
                    ->where('fin_promocion','>=',$hoy)
                    ->get();

                $item = null;
                foreach ($promotions as $promotion){
                    if($producto->id == $promotion->idProducto){
                        $item = [
                            "id" => base64_encode($producto->id),
                            "nombre" => $producto->nombre,
                            "codigo" => $producto->codigo,
                            "precio1" => $producto->precio1-(($promotion->descuento/100)*$producto->precio1),
                            "img1" => $producto->img1,
                            "price" => $producto->precio1,
                            "discount" => $promotion->descuento,
                        ];

                    }
                }

                if($item == null){
                    $item = [
                        "id" => base64_encode($producto->id),
                        "nombre" => $producto->nombre,
                        "codigo" => $producto->codigo,
                        "precio1" => $producto->precio1,
                        "img1" => $producto->img1,
                        "price" => $producto->precio1,
                        "discount" => 0,
                    ];
                }


                $cart = $cookie['carrito'];
                #dd($cart);
                $cart->add($item, $producto->id);
                #dd($cart);
                $cookie['carrito'] = $cart;
                #dd($cookie['carrito']);
                return Response::json([
                    'code' => 200,
                    'msg' => $cookie['carrito'],
                    'detail' => 'success'
                ])->withCookie('cliente', $cookie);
            } else {
                return Response::json([
                    'code' => 404,
                    'msg' => "Necesitas estar logueado para agregar al carrito",
                    'detail' => 'error'
                ]);
            }
        } catch (Exception $e) {
            return Response::json([
                'code' => 500,
                'msg' => $e->getMessage(),
                'detail' => 'error2'
            ])->withCookie('cliente', Cookie::get("cliente"));
        }
    }

    public function removeCarrito(Request $request, $id)
    {
        if (!$cookie = $request->cookie('cliente')) {
            return Response::json([
                'code' => 404,
                'msg' => 'No tienes un carrito de compras disponible.',
                'detail' => 'Error'
            ]);
        }
        $producto = Producto::where('codigo', '=', $request->input('codigo'))->first();
        #dd($producto);
        $cart = $cookie['carrito'];
        #dd($cookie['carrito']);
        $cart->remove($producto->id);
        $cookie['carrito'] = $cart;
        return Response::json([
            'code' => 200,
            'msg' => $cart,
            'detail' => 'OK'
        ])->withCookie('cliente', $cookie);
    }

    //llamada ajax
    public function removeCart(Request $request)
    {
        if (!$cookie = $request->cookie('cliente')) {
            return Response::json([
                'code' => 404,
                'msg' => 'No tienes un carrito de compras disponible.',
                'detail' => 'Error'
            ]);
        }
        $producto = Producto::where('codigo', '=', $request->input('codigo'))->first();
        #dd($producto);
        $cart = $cookie['carrito'];
        #dd($cookie['carrito']);
        $cart->remove($producto->id);
        $cookie['carrito'] = $cart;
        return Response::json([
            'code' => 200,
            'msg' => $cart,
            'detail' => 'OK'
        ])->withCookie('cliente', $cookie);
    }

    //Vista del carrito (paso 1 de compra)
    public function getCarrito(Request $request)
    {
        try {
            $categorias = DB::table('categorias')->take(10)->get();
            $marcas = DB::table('marcas')
                ->orderBy('nombre', 'asc')
                ->get();
            foreach ($marcas as $marca) {
                $marca->id = base64_encode($marca->id);
            }
            foreach ($categorias as $categoria) {
                $productos = DB::table('productos')->take(9)->where('categoria_id', $categoria->id)->orderBy('vendidos', 1)->get();
                $categoria->id = base64_encode($categoria->id);
                array_push($menu, [$categoria->id => $productos]);
            }
            if ($cookie = $request->cookie('cliente')) {
                $cart = $cookie['carrito'];
                $user = Cliente::find(base64_decode($cookie['id']));
                return view('shop.carrito', [
                    'products' => $cart->productos,
                    'total' => $cart->total,
                    'categorias' => $categorias,
                    'marcas' => $marcas,
                    'user' => $user->username
                ]);
            } else {
                return view('shop.carrito', ['products' => null, 'categorias' => $categorias, 'marcas' => $marcas]);
            }
        } catch (Exception $exception) {
            dd($exception);
        }
    }

    public function postCarrito(Request $request)
    {
        try {
            $resultado = [];
            if ($cookie = $request->cookie('cliente')) {  //Cliente encontrado
                $cart = $cookie['carrito'];
                $user = Cliente::find(base64_decode($cookie['id']));
                //revisamos la existencia de los productos
                $i = 0;
                foreach ($cart->productos as $key => $producto) {
                    $pt = DB::table('productos')->select('stock')
                        ->where('id', base64_decode($producto['item']['id']))->get();
                    #dd($producto['cantidad']);
                    if ($producto['cantidad'] > $pt[0]->stock) {
                        //no hubo y se agrega al resultado
                        $resultado[$i] = [
                            'product_id' => base64_decode($producto['item']['id']),
                            'existencia' => false,
                            'msg' => "Actualmente hay en existencia " . $pt[0]->stock . " de " . $producto['cantidad'] . " solicitados"
                        ];
                        $i++;
                    }
                }
                if (count($resultado) == 0) { //Todos los productos existen
                    return response()->json([
                        'code' => 200,
                        'msg' => "Correcto",
                        'detail' => "Its all ok!"
                    ]);
                } else { //no hay al menos un producto
                    return response()->json([
                        'code' => 404,
                        'msg' => $resultado,
                        'detail' => "producto (s) no encontrados"
                    ]);
                }


            } else { //no hay una sesion
                return response()->json([
                    'code' => 403,
                    'msg' => "Necesitas iniciar Sesión",
                    'detail' => route('cliente.login')
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'code' => 500,
                'msg' => $exception,
                'detail' => "Ha ocurrido un error "
            ]);
        }

    }

    public function Checkout(Request $request)
    {
        try {
            if ($cookie = $request->cookie('cliente')) {  //Cliente encontrado
                $cart = $cookie['carrito'];
                $total = $cart->total;
                $categorias = DB::table('categorias')->take(10)->get();
                $marcas = DB::table('marcas')
                    ->orderBy('nombre', 'asc')
                    ->get();
                $user = Cliente::find(base64_decode($cookie['id']));
                $costoenvio = Costo_Envio::where([
                    ['estado_id', $user->estado],
                    ['municipio_id', $user->municipio]
                ])->first();
                //revisamos la existencia de los productos
                if ($costoenvio == null) { // No existe en los envio
                    //redirigimos a la pantalla de alerta
                    return view('shop.alert', ['categorias' => $categorias, 'marcas' => $marcas, 'user' => $user->username]);
                } else { //Existe en los costos
                    //Redirigimos al pago
                    //Creamos el pedido
                    $orden = new Pedido();
                    $orden->cliente_id = $user->id;
                    $orden->envio_disponible = true;
                    $orden->subtotal = $total;
                    $orden->costo_envio = $costoenvio->costo;
                    $orden->total = $total + $costoenvio->costo;
                    $orden->save();
                    //Guardamos los detalles
                    $cart = $cookie['carrito'];

                    foreach ($cart->productos as $producto) {
                        #dd($producto);
                        $detalle = new Detalle_Pedido();
                        $detalle->pedido_id = $orden->id;
                        $detalle->cantidad = $producto['cantidad'];
                        $detalle->product_id = base64_decode($producto['item']['id']);
                        $detalle->subtotal = $producto['item']['precio1'] * $producto['cantidad'];
                        $detalle->precio = $producto['item']['precio1'];
                        $detalle->save();

                    }

                    return view('shop.checkout', [
                        'categorias' => $categorias,
                        'marcas' => $marcas,
                        'user' => $user->username,
                        'orden' => $orden,
                        'detalles' => $detalle
                    ]);
                }
            } else { //no hay una sesion
                return redirect()->route('cliente.login');
            }
        } catch (Exception $exception) {
            dd($exception);
        }

    }

    public function postCheckout(Request $request)
    {
        $productos = json_decode($request->input("productos"));
        if ($cookie = $request->cookie('cliente')) {
            $cart = $this->setCart($cookie['carrito'], $productos);
            $total = $cart->total;
            $cookie['carrito'] = $cart;
            $categorias = DB::table('categorias')->take(10)->get();
            $marcas = DB::table('marcas')
                ->orderBy('nombre', 'asc')
                ->get();
            $user = Cliente::find($cookie['id']);
            return view('shop.checkout', ['total' => $total, 'categorias' => $categorias, 'marcas' => $marcas, 'user' => $user->username]);
        } else {

        }

    }

    public function setCart($oldCart, $productos)
    {
        $cart = $oldCart;
        foreach ($productos as $product) {
            $producto = Producto::where('codigo', '=', $product->codigo)->first();
            $cart->setCantidad($producto->id, $product->cantidad);
        }
        return $cart;
    }

    public function getDelivery(Request $request)
    {
        $categorias = DB::table('categorias')->take(10)->get();
        $marcas = DB::table('marcas')
            ->orderBy('nombre', 'asc')
            ->get();
        if ($cookie = $request->cookie('cliente')) {
            $user = Cliente::find(base64_decode($cookie['id']));
            $estados = Estado::all();
            $municipios = Municipio::where('estado_id', $user->estado)->get();
            return view('shop.direccionenvio', [
                'categorias' => $categorias,
                'marcas' => $marcas,
                'estados' => $estados,
                'municipios' => $municipios,
                'user' => $user->username,
                'direccion' => $user
            ]);
        } else {
            return view('shop.direccionenvio', ['categorias' => $categorias, 'marcas' => $marcas]);
        }
    }

    public function postPayment(Request $request)
    {  #dd(config('services.stripe.secret'));
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        try {
            if ($cookie = $request->cookie('cliente')) {
                $orden = Pedido::find($request->orderid);
                $user = Cliente::find(base64_decode($cookie['id']));
                $token =$request->input('stripeToken');
                if($user->stripe_client_id == null){ //El cliente no está registrado
                    $customer = \Stripe\Customer::create(array(
                        "email" => $user->email,
                        "source" => $token,
                    ));
                    $user->stripe_client_id = $customer->id;
                    $user->save();
                }

                $cargo = \Stripe\Charge::create(array(
                    "amount" => intval($orden->total) * 100,
                    //git"customer" => $customer->id,
                    "currency" => "mxn",
                    "source" => $token, // obtained with Stripe.js
                    "description" => "Pago de orden de compra .$orden->id",
                    "receipt_email" => $user->email,
                ));

                $categorias = DB::table('categorias')->take(10)->get();
                $marcas = DB::table('marcas')
                    ->orderBy('nombre', 'asc')
                    ->get();

                $cookie['carrito'] =  new Carrito(null);
                $response = new \Illuminate\Http\Response(view('shop.success', [
                    'categorias' => $categorias,
                    'marcas' => $marcas,
                    'user' => $user->username,
                    'orden'=>  $orden
                ]));
                return $response->withCookie('cliente',$cookie);
            } else {
                return route('cliente.login');
            }
        } catch (\Exception $e) {
            dd($e);
        }

    }

    public function getItems(Request $request)
    {
        $cookie = null;
        if ($cookie = $request->cookie('cliente')) {

            $respuesta = ['code' => 200, 'msg' => $cookie['carrito'], 'detail' => "success"];
        } else {
            $respuesta = ['code' => '403', 'msg' => "Necesitas estar logueado para consultar tu carrito", 'detail' => "error"];
        }
        return Response::json($respuesta)->withCookie('cliente', $cookie);
    }

    public function search(Request $request)
    {
        $busqueda = $request->query();

        /*
         * filtros que podemos recibir
         * Search = nombre del producto!
         * precio = 1-5 ciertos filtros. cualquier otro filtro será +500
         * marca = se hará la busqueda por nombre para recuperar el id de la marca (si existe)
         * */
        if (!array_key_exists('search', $busqueda)) { //Si no existe el parametro search ni para que -.-
            $topselling = DB::table('productos')->take(4)->orderBy('vendidos', 'asc')->get();
            $promociones = DB::table('productos')->take(10)->where('promocion', 1)->orderBy('precio1', 'asc')->get();
            $blogs = DB::table('blogs')->take(4)->orderBy('fecha', 'desc')->get();
            $categorias = DB::table('categorias')->take(4)->get();
            $menu = array();
            $marcas = DB::table('marcas')
                ->orderBy('nombre', 'asc')
                ->get();

            return view('shop.index', ['topselling' => $topselling,
                'promociones' => $promociones,
                'blogs' => $blogs,
                'categorias' => $categorias,
                'marcas' => $marcas
            ]);
        }
        $search = $busqueda['search'];
        $marcas = DB::table('marcas')
            ->select(DB::raw("id, nombre,(
		                      SELECT COUNT(*)
		                      FROM productos p
		                      where p.marca_id = marcas.id AND (p.nombre like '%$search%' OR p.descripcion like '%$search%' OR p.codigo like '%$search%')
                             ) as total "))
            ->orderBy('nombre', 'asc')
            ->get();
        $categorias = DB::table('categorias')->take(10)->get();
        //search existe, pero no existe los parametros precio ni busqueda
        if (!array_key_exists('precio', $busqueda) && !array_key_exists('marca', $busqueda)) { //no existen ambos filtros
            $resultado = DB::table('productos')
                ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                ->paginate(9);
        } else {
            //revisamos si existen los dos o solo alguno
            if (array_key_exists('precio', $busqueda) && array_key_exists('marca', $busqueda)) { //existen ambas y por tanto se hace la consulta
                $marca_id = DB::table('marcas')->select('id')->where('nombre', $busqueda['marca'])->first(); //obtenemos el id de la marca que pasamos
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
                            ->where('marca_id', '=', $marca_id->id)
                            ->whereBetween('precio1', $precio)
                            ->paginate(9);

                    } else { // se tomará automaticamente +500
                        $resultado = DB::table('productos')
                            ->where([
                                ['nombre', 'like', '%' . $busqueda['search'] . '%'],
                                ['precio1', '>', 500]
                            ])
                            ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                            ->paginate(9);
                    }
                } catch (Exception $e) {
                    //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                    $resultado = DB::table('productos')
                        ->where([
                            ['nombre', 'like', '%' . $busqueda['search'] . '%'],
                            ['precio1', '>', 500]
                        ])
                        ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                        ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                        ->paginate(9);
                }
            } else { // solo existe una
                if (array_key_exists('precio', $busqueda)) {
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
                                ->whereBetween('precio1', $precio)
                                ->paginate(9);

                        } else { // se tomará automaticamente +500
                            $resultado = DB::table('productos')
                                ->where('precio1', '>', 500)
                                ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                                ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                                ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                                ->paginate(9);
                        }
                    } catch (Exception $e) {
                        //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                        $resultado = DB::table('productos')
                            ->where('precio1', '>', 500)
                            ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                            ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                            ->paginate(9);
                    }
                } elseif (array_key_exists('marca', $busqueda)) {
                    $marca_id = DB::table('marcas')->select('id')->where('nombre', $busqueda['marca'])->first(); //obtenemos el id de la marca que pasamos
                    $resultado = DB::table('productos')
                        ->where('nombre', 'like', '%' . $busqueda['search'] . '%')
                        ->orWhere('descripcion', 'like', '%' . $busqueda['search'] . '%')
                        ->orWhere('codigo', 'like', '%' . $busqueda['search'] . '%')
                        ->where('marca_id', '=', $marca_id->id)
                        ->paginate(9);
                }

            }
        }

        $hoy =getdate();
        $hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
        $promotions = DB::table('producto_promocion')->join('promociones','idPromocion','=','idPromocion')
            ->where('fin_promocion','>=',$hoy)
            ->get();

        foreach ($resultado as $item){
            $item->promo = 0;
            foreach ($promotions as $promotion){
                if($item->id == $promotion->idProducto){
                    $item->promo = 1;
                    $item->newprice = $item->precio1-(($promotion->descuento/100)*$item->precio1);
                }
            }
        }
	foreach ($marcas as $marca) {
          $marca->id = base64_encode($marca->id);
        }
        foreach ($categorias as $categoria) {
          $productos = DB::table('productos')->take(9)->where('categoria_id', $categoria->id)->orderBy('vendidos', 1)->get();
          $categoria->id = base64_encode($categoria->id);
         # array_push($menu, [$categoria->id => $productos]);
        }

        return view('shop.busqueda', ['categorias' => $categorias, 'productos' => $resultado, 'marcas' => $marcas]);
    }

    public function getMunicipios(Request $request, $id)
    {
        $municipios = DB::table('municipios')->where('estado_id', $id)->get();
        return Response::json([
            'code' => 200,
            'msg' => json_encode($municipios),
            'detail' => 'OK'
        ]);
    }

    public function Municipiosfiltroprecio(Request $request, $id)
    {
        $municipios = DB::table('municipios as m')
            ->select('m.id','m.nombre')
            ->leftJoin('costo_envio as ce','ce.municipio_id','=','m.id')
            ->where('m.estado_id', $id)
            ->where('ce.id', null)
            ->get();
        return Response::json([
            'code' => 200,
            'msg' => json_encode($municipios),
            'detail' => 'OK'
        ]);
    }

    public function updateCart(Request $request)
    {
        try {
            if ($cookie = Cookie::get("cliente")) {
                $datos = json_decode($request->productos, true);
                foreach ($datos as $dato) {
                    $producto = Producto::findOrFail(base64_decode($dato['id']));
                    $hoy =getdate();
                    $hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                    $promotions = DB::table('producto_promocion')->join('promociones','idPromocion','=','idPromocion')
                        ->where('fin_promocion','>=',$hoy)
                        ->get();

                    $item = null;
                    foreach ($promotions as $promotion){
                        if($producto->id == $promotion->idProducto){
                            $item = [
                                "id" => base64_encode($producto->id),
                                "nombre" => $producto->nombre,
                                "codigo" => $producto->codigo,
                                "precio1" => $producto->precio1-(($promotion->descuento/100)*$producto->precio1),
                                "img1" => $producto->img1,
                                "price" => $producto->precio1,
                                "discount" => $promotion->descuento,
                            ];

                        }
                    }

                    if($item == null){
                        $item = [
                            "id" => base64_encode($producto->id),
                            "nombre" => $producto->nombre,
                            "codigo" => $producto->codigo,
                            "precio1" => $producto->precio1,
                            "img1" => $producto->img1,
                            "price" => $producto->precio1,
                            "discount" => 0,
                        ];
                    }
                    $cantidad = $dato['cantidad'];
                    $carrito = $cookie['carrito'];
                    $carrito->update($item, $producto->id, $cantidad);
                    $cookie['carrito'] = $carrito;
                }
                return Response::json([
                    'code' => 200,
                    'msg' => $cookie['carrito'],
                    'detail' => 'success'
                ])->withCookie('cliente', $cookie);
            } else {
                return Response::json([
                        'code' => '404',
                        'msg' => "Necesitas estar logueado para agregar al carrito",
                        'detail' => 'warning']
                );
            }
        } catch (Exception $e) {
            return Response::json([
                'code' => '500',
                'msg' => "Tuvimos un error :" . $e->getCode(),
                'detail' => 'error'
            ])->withCookie('cliente', Cookie::get("cliente"));
        }
    }

    public function makeOrder(Request $request)
    {

    }

    public function cancelOrder(Request $request)
    {

    }

}
