<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;

class ClientesController extends Controller
{
    /**
     * @return $this
     */
    public function index(){
        $topselling = DB::table('productos')->take(4)->orderBy('vendidos', 'asc')->get();
        $promociones = DB::table('productos')->take(10)->where('promocion',1)->orderBy('precio1', 'asc')->get();
        $blogs = DB::table('blogs')->take(4)->orderBy('fecha','desc')->get();
        $categorias = DB::table('categorias')->take(4)->get();
        $menu = array();
        $marcas = DB::table('marcas')
            ->orderBy('nombre','asc')
            ->get();
        foreach ($marcas as $marca){
            $marca->id = base64_encode($marca->id);
        }
        foreach ($categorias as $categoria){
            $productos = DB::table('productos')->take(9)->where('categoria_id',$categoria->id)->orderBy('vendidos',1)->get();
            $categoria->id = base64_encode($categoria->id);
            array_push($menu,[$categoria->id => $productos]);
        }
        return view('shop.index',['topselling'=>$topselling,
                                  'promociones'=>$promociones,
                                  'blogs' => $blogs,
                                  'categorias'=>$categorias,
                                  'marcas' => $marcas
        ]);
    }

    public function getCategorias(Request $request, $id){
        $id = base64_decode($id);
        $busqueda = $request->query();
        $marcas = DB::table('marcas')
            ->select(DB::raw("id, nombre,(
		                      SELECT COUNT(*)
		                      FROM [laravel_chocoburbujas].[dbo].[productos] p
		                      where p.marca_id = marcas.id AND p.categoria_id = $id
                             ) as total "))
            ->orderBy('nombre','asc')
            ->get();

        $categorias = DB::table('categorias')->take(10)->get();
        foreach ($marcas as $marca){
            $marca->id = base64_encode($marca->id);
        }
        foreach ($categorias as $categoria){
            $categoria->id = base64_encode($categoria->id);
        }
        /* ************************************************** */
        if(!array_key_exists('precio',$busqueda) && !array_key_exists('marca',$busqueda) ) { //no existen ambos filtros
            $resultado = DB::table('productos')->where('categoria_id',$id)->paginate(9);
        } else{
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
                            ->where('categoria_id',$id)
                            ->where('marca_id','=',$marca_id->id)
                            ->whereBetween('precio1',$precio)
                            ->paginate(9);

                    } else { // se tomará automaticamente +500
                        $resultado = DB::table('productos')
                            ->where('categoria_id',$id)
                            ->where('precio1','>=',500)
                            ->paginate(9);
                    }
                }catch(Exception $e){
                    //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                    $resultado = DB::table('productos')
                        ->where('categoria_id',$id)
                        ->where('precio1','>=',500)
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
                                ->where('categoria_id',$id)
                                ->whereBetween('precio1',$precio)
                                ->paginate(9);

                        } else { // se tomará automaticamente +500
                            $resultado = DB::table('productos')
                                ->where('categoria_id',$id)
                                ->where('precio1','>=',500)
                                ->paginate(9);
                        }
                    }catch(Exception $e){
                        //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                        $resultado = DB::table('productos')
                            ->where('categoria_id',$id)
                            ->where('precio1','>=',500)
                            ->paginate(9);
                    }
                }elseif (array_key_exists('marca', $busqueda)){
                    $marca_id = DB::table('marcas')->select('id')->where('nombre',$busqueda['marca'])->first(); //obtenemos el id de la marca que pasamos
                    $resultado = DB::table('productos')
                        ->where('categoria_id',$id)
                        ->where('marca_id','=',$marca_id->id)
                        ->paginate(9);
                }

            }
        }


        /* ************************************************** */
        return view('shop.categorias',['categorias'=>$categorias,'productos'=> $resultado, 'marcas' => $marcas]);
    }

    public function getMarcas(Request $request, $id){
        $id = base64_decode($id);
        $busqueda = $request->query();
        $marcas = DB::table('marcas')
            ->orderBy('nombre','asc')
            ->get();
            $categorias = DB::table('categorias')->take(10)->get();
        foreach ($marcas as $marca){
            $marca->id = base64_encode($marca->id);
        }
        foreach ($categorias as $categoria){
            $categoria->id = base64_encode($categoria->id);
        }

        /* ************************************************************* */
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
                        ->where('marca_id',$id)
                        ->whereBetween('precio1',$precio)
                        ->paginate(9);

                } else { // se tomará automaticamente +500
                    $resultado = DB::table('productos')
                        ->where('marca_id',$id)
                        ->where('precio1','>=',500)
                        ->paginate(9);
                }
            }catch(Exception $e){
                //ignoramos entonces el criterio de busqueda y lo tomamos a +500
                $resultado = DB::table('productos')
                    ->where('marca_id',$id)
                    ->where('precio1','>=',500)
                    ->paginate(9);
            }
        }else{
            $resultado = DB::table('productos')->where('marca_id',$id)->paginate(9);
        }

            /* ************************************************************* */

            return view('shop.marcas',['categorias'=>$categorias,'productos'=> $resultado,'marcas'=> $marcas]);
    }

    public function getFiltro(Request $request, $tipo){
        $precio=0;
        $marcas = DB::table('marcas')
            ->select(DB::raw("id, nombre,(
		                      SELECT COUNT(*)
		                      FROM [laravel_chocoburbujas].[dbo].[productos] p
		                      where p.marca_id = marcas.id 
                             ) as total "))
            ->orderBy('nombre','asc')
            ->get();
        switch($tipo){
            case 1:$precio = array(0,99.99);break;
            case 2:$precio = array(100,199.99);break;
            case 3:$precio = array(200,299.99);break;
            case 4:$precio = array(300,399.99);break;
            case 5:$precio = array(400,499.99);break;

        }
        $categorias = DB::table('categorias')->take(10)->get();
        $productos = DB::table('productos')->whereBetween('precio1',$precio)->paginate(9);
        return view('shop.busqueda',['categorias'=>$categorias,'productos'=> $productos,'marcas'=> $marcas]);
    }

    public function getRegister(Request $request){
        if($request->cookie('cliente') != null) {
            return redirect()->route('shop.index');
        }
        $marcas = DB::table('marcas')
            ->orderBy('nombre','asc')
            ->get();
        $categorias = DB::table('categorias')->take(10)->get();
        $estados = DB::table('estados')->get();

        return view('cliente.register',['categorias'=>$categorias, 'marcas' => $marcas,'estados'=>$estados,'error' => false,'msg' => '']);
    }

    public function logout(Request $request){

        if ($request->cookie('cliente') != null) {
            Cookie::forget('cliente');
            return redirect()->route('shop.index')->withCookie(Cookie::forget('cliente'));
        }
    }

    public function showLoginForm(){
        return view('cliente.login');
    }
    public function login(Request $request){
        try {
            $cookie = null;
            $users = Cliente::where('email', $request->email)->firstOrFail(); //buscamos con el email si es vacio entonces mensaje de error

            if (Hash::check($request->password, $users->password)) {
                $datos = [
                    'rol' => $users->rol,
                    'id' => base64_encode($users->id),
                ];

                    $cookie = Cookie::make('cliente', $datos, 180);


                $respuesta = [
                    'code' => 200,
                    'msg' => $datos,
                    'detail' => 'OK'
                ];
            } else {
                $respuesta = [
                    'code' => 500,
                    'msg' => "Las credenciales son incorrectas",
                    'detail' => 'Error'
                ];
            }
        }catch(Exception $exception){
            $respuesta = [
                'code' => 500,
                'msg' => $exception->getMessage(),
                'detail' => 'Error'
            ];

        }
        if ( $cookie != null )
            return Response::json($respuesta)->withCookie($cookie);
        else
            return Response::json($respuesta);
    }

    public function profile(Request $request){
        try {
            if($request->cookie('cliente') != null){
                $estados = DB::table('estados')->get();
                $cookie=Cookie::get('cliente');
                $cliente = Cliente::where('id','=',base64_decode($cookie['id']))->firstOrFail();
                $municipios = DB::table('municipios')->where('estado_id',$cliente->estado)->get();
                $categorias = DB::table('categorias')->take(4)->get();
                $menu = array();
                $marcas = DB::table('marcas')
                    ->orderBy('nombre', 'asc')
                    ->get();
                foreach ($categorias as $categoria) {
                    $productos = DB::table('productos')->take(9)->where('categoria_id', $categoria->id)->orderBy('vendidos', 1)->get();
                    array_push($menu, [$categoria->id => $productos]);
                }
                $cliente->id = base64_encode($cliente->id);

                return view('cliente.profile', ['municipios'=>$municipios,'estados'=>$estados,'categorias' => $categorias, 'marcas' => $marcas,'cliente' => $cliente]);
            }
        }catch (Exception $e){

        }
    }
    public function perup(Request $request){
        try{
            if($request->cookie('cliente') != null){
                $cookie = Cookie::get('cliente');
                $cliente = Cliente::where('id','=',base64_decode($cookie['id']))->firstOrFail();
                $cliente->nombre = $request->nombre;
                $cliente->ape_pat = $request->apellidop;
                $cliente->ape_mat = $request->apellidom;
                $cliente->save();
                $respuesta = ["code" => 200, "msg" => "Usuario actualizado", "detail" => "success"];
            }
        }catch (Exception $e){
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), "detail" => "error"];
        }
        return Response::json($respuesta);
    }
    public function contup(Request $request){
        try{
            if($request->cookie('cliente') != null){
                $cookie = Cookie::get('cliente');
                $cliente = Cliente::where('id','=',base64_decode($cookie['id']))->firstOrFail();
                $cliente->estado = $request->estado;
                $cliente->municipio = $request->municipio;
                $cliente->colonia = $request->colonia;
                $cliente->calle = $request->calle;
                $cliente->numero_ext = $request->noext;
                $cliente->numero_int = $request->noint;
                $cliente->cp = $request->cp;
                $cliente->telefono1 = $request->tel;
                $cliente->telefono2 = $request->tel2;
                $cliente->email = $request->email;
                $cliente->save();
                $respuesta = ["code" => 200, "msg" => "Usuario actualizado", "detail" => "success"];
            }
        }catch (Exception $e){
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), "detail" => "error"];
        }
        return Response::json($respuesta);
    }
    public function passup(Request $request)
    {
        try {
            if($request->cookie('cliente') != null) {
                $cookie = Cookie::get('cliente');
                $cliente = Cliente::findOrFail(base64_decode($cookie['id']));
                /*Hay una contraseña por tanto se puede actualizar*/
                if (Hash::check($request->actual, $cliente->password)) {

                    $cliente->password = bcrypt($request->nueva);
                } else {
                    throw  new Exception("La contraseña ingresada no coincide");
                }
                $cliente->save();
                $respuesta = ["code" => 200, "msg" => "Usuario actualizado", "detail" => "success"];
            }
        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), "detail" => "error"];
        }
        return Response::json($respuesta);
    }
    public function imgup(Request $request){
        try{
            if($request->cookie('cliente') != null) {
                $cookie = Cookie::get('cliente');
                $user = Cliente::findOrFail(base64_decode($cookie['id']));
                if ($request->file("foto") != null) {
                    $user->img = 'C' . $user->id . "." . $request->file("foto")->getClientOriginalExtension();
                    if ($user->img != "cliente.png") {
                        Storage::delete("/clientes/" . $user->img);
                    }
                    $file = $request->file("foto");
                    $nombre = "/clientes/C" . $user->id . "." . $file->getClientOriginalExtension();
                    Storage::disk('local')->put($nombre, File::get($file));
                }
                $user->save();
                $respuesta = ["code" => 200, "msg" => "Usuario actualizado", "detail" => "success"];
            }
            } catch (Exception $e) {
                $respuesta = ["code" => 500, "msg" => $e->getMessage(), "detail" => "error"];
            }
        return Response::json($respuesta);
    }
    public function register(Request $request)
    {
        try {
            if($request->cookie('cliente') != null) {
                return redirect()->route('shop.index');
            }
            $userid = DB::table("Clientes")->insertGetId([
                'nombre' => $request->input('nombre'),
                'ape_pat' => $request->input('ape_pat'),
                'ape_mat' => $request->input('ape_mat'),
                'telefono1' => $request->input('tele1'),
                'telefono2' => $request->input('tele2'),
                'calle' => $request->input('calle'),
                'numero_int' => $request->input('numero_int'),
                'numero_ext' => $request->input('numero_ext'),
                'colonia' => $request->input('colonia'),
                'cp' => $request->input('cp'),
                'estado' => $request->input('estado'),
                'municipio' => $request->input('municipio'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'suscrito' => $request->input('suscrito') ? 1 : 0,
                'img' => 'cliente.png'
            ]);

            if ($request->file("photo") != null) {
                $user = Cliente::findOrFail($userid);
                $user->fill([
                    "img" => 'C'.$userid . "." . $request->file("photo")->getClientOriginalExtension()
                ]);
                $user->save();
                $nombre = "/clientes/C"  . $userid . "." . $request->file("photo")->getClientOriginalExtension();
                Storage::disk('local')->put($nombre, File::get($request->file("photo")));
            }

            return $respuesta = ["code" => 200, "msg" => 'El usuario fue creado exitosamente', 'detail' => 'success'];

        } catch (Exception $e) {
            $respuesta = ["code" => 500, "msg" => $e->getMessage(), "detail" => "error"];
        }

    }
}
