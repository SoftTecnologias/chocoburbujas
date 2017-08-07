<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Estado;
use App\Marca;
use App\Movimiento;
use App\Proveedor;
use App\Unidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{

    public function doLogin(Request $request){
        try {
            $cookie = null;
            $users = User::where('email', $request->email)->firstOrFail(); //buscamos con el email si es vacio entonces mensaje de error
            if (Hash::check($request->password, $users->password)) {
                $datos = [
                    'rol' => $users->rol,
                    'apikey' => $users->apikey,
                ];

                if($users->rol == "1") {
                    $cookie = Cookie::make('admin', $datos, 180);
                }else{
                    $datos['userprice']= $users->userprice;
                    //revisaremos que exista el carrito y lo agregamos a la cookie
                    $cookie = Cookie::make('cliente', $datos, 180);
                }

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
        }catch(\Exception $exception){
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



    public function index(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            $user = User::where('apikey', $cookie['apikey'])->first();
            $fecha = explode("-", substr($user->signindate, 0, 10));
            return view('panel.area',['datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                'photo' => $user->img,
                'username' => $user->username,
                'permiso' => 'Administrador']]);
        }else{
            return view('user.login');}

    }
    public function showBrandForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            $user = User::where('apikey', $cookie['apikey'])->first();
            $marcas = Marca::all();
            $fecha = explode("-", substr($user->signindate, 0, 10));
            return view('panel.brand',['marcas' => $marcas,'datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                'photo' => $user->img,
                'username' => $user->username,
                'permiso' => 'Administrador']]);
        }else{
            return view('user.login');}
    }
    public function showLoginForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            $user = User::where('apikey', $cookie['apikey'])->first();
            $fecha = explode("-", substr($user->signindate, 0, 10));
            return view('panel.area',['datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                'photo' => $user->img,
                'username' => $user->username,
                'permiso' => 'Administrador']]);
        }else{
            if($request->cookie('cliente') != null){
                return redirect()->action('ClientesController@index')->withCookie(Cookie::forget('cliente'));
            }else{
                return view('user.login');
            }
        }
    }
    public function showCategoryForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            $user = User::where('apikey', $cookie['apikey'])->first();
            $fecha = explode("-", substr($user->signindate, 0, 10));
            return view('panel.category',['datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                'photo' => $user->img,
                'username' => $user->username,
                'permiso' => 'Administrador']]);
        }else{
            return view('user.login');}
    }
    public function showProductForm(Request $request){
        if($request->cookie('admin') != null){
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        $unidades = Unidad::all();
        $respuesta =[
            'marcas' => $marcas,
            'proveedores' => $proveedores,
            'categorias' => $categorias,
            'unidades'  => $unidades
        ];
                    $cookie = Cookie::get('admin');
                    $user = User::where('apikey', $cookie['apikey'])->first();
                    $fecha = explode("-", substr($user->signindate, 0, 10));
                    return view('panel.product',['marcas' => $marcas,
                        'categorias' => $categorias, 'proveedores' => $proveedores, 'unidades' => $unidades,
                        'datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                        'photo' => $user->img,
                        'username' => $user->username,
                        'permiso' => 'Administrador']]);
                }else{
                    return view('user.login');}
    }
    public function showProviderForm(Request $request){
        if($request->cookie('admin') != null) {
                $estados = Estado::all();
                $cookie = Cookie::get('admin');
                $user = User::where('apikey', $cookie['apikey'])->first();
                $fecha = explode("-", substr($user->signindate, 0, 10));
                return view('panel.provider',['estados' => $estados,'datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                    'photo' => $user->img,
                    'username' => $user->username,
                    'permiso' => 'Administrador']]);
            }else{
                return view('user.login');}
    }
    public function showProfileForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            if ($cookie['rol'] == 1) {
                return view('user.profile');
            }
        }else{

        }
    }
    public function showUserForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            $user = User::where('apikey', $cookie['apikey'])->first();
            $fecha = explode("-", substr($user->signindate, 0, 10));
            return view('panel.user',['datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                'photo' => $user->img,
                'username' => $user->username,
                'permiso' => 'Administrador']]);
        }else{
            return view('user.login');}
    }
    public function showMovementForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            if ($cookie['rol'] == 1) {
                $cookie = Cookie::get('admin');
                $user = User::where('apikey', $cookie['apikey'])->first();
                $fecha = explode("-", substr($user->signindate, 0, 10));
                $productos = DB::table('productos')->select('id', 'nombre')->get();
                $proveedores = DB::table('proveedores')->select('id', 'nombre')->get();
                return view('panel.movement', ['proveedores' => $proveedores, 'productos' => $productos,'datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                    'photo' => $user->img,
                    'username' => $user->username,
                    'permiso' => 'Administrador']]);
            }
        }else{
            return view('user.login');}
    }
    public function showBlogForm(Request $request){
        if($request->cookie('admin') != null) {
            $cookie = Cookie::get('admin');
            $user = User::where('apikey', $cookie['apikey'])->first();
            $fecha = explode("-", substr($user->signindate, 0, 10));
            return view('panel.blog',['datos' => ['name' => $user->nombre . ' ' . $user->ape_pat,
                'photo' => $user->img,
                'username' => $user->username,
                'permiso' => 'Administrador']]);
        }else{
            return view('user.login');}
    }
    public function logout(Request $request){
        if ($request->cookie('admin') != null) {
            Cookie::forget('admin');
            return redirect()->route('user.login')->withCookie(Cookie::forget('admin'));
        }
    }

    public function email($email){
        $em=DB::table('users')->select("email")->where("email","=",$email);
        if(empty($em->get())){
            return "true";
        }else{
            return "false";
        }
    }

    public function username($username){
        $user=DB::table('users')->select("username")->where("username","=",$username);
        if(empty($user->get())){
            return "true";
        }else{
            return "false";
        }
    }
}
