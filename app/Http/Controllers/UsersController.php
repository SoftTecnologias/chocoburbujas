<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Estado;
use App\Marca;
use App\Movimiento;
use App\Proveedor;
use App\Unidad;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    //controlador del administrador
    protected $loginView = 'user.login';
    protected $redirectAfterLogout = '/panel/login';
    protected  $registerView = 'user.register';
    protected $guard='web';


    public function authenticated(){
      return redirect('/panel/area');
    }



    function __construct()
    {

        $this->middleware('auth',['only'=>['index']]);
    }

    public function index(){
        return view('panel.area');
    }
    public function showBrandForm(){
        return view('panel.brand');
    }
    public function showCategoryForm(){
        return view('panel.category');
    }
    public function showProductForm(){
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
        return view('panel.product',$respuesta);
    }
    public function showProviderForm(){
        $estados = Estado::all();

        return view('panel.provider',[
            'estados' => $estados
         ]);
    }
    public function showProfileForm(){
        return view('user.profile');
    }
    public function showUserForm(){
        return view('panel.user');
    }
    public function showMovementForm(){
        $productos = DB::table('productos')->select('id','nombre')->get();
        $proveedores =DB::table('proveedores')->select('id','nombre')->get();
        return view('panel.movement',['proveedores' => $proveedores, 'productos' => $productos]);
    }
    public function showBlogForm(){
        return view('panel.blog');
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
