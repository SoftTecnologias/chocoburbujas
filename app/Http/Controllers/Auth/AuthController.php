<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //controlador del cliente
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';
    protected $loginView = 'cliente.login';
    protected $registerView = 'cliente.register';
    protected  $guard='cliente';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',['only' =>'showLoginForm']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre'        => 'required|min:3|max:100|string',
            'ape_pat'       =>  'min:2|max:100|string',
            'ape_mat'       =>  'min:2|max:100|string',
            'telefono1'     =>  'required|min:7|max:20',
            'telefono2'     =>  'min:7|max:20',
            'calle'         =>  'required|string|min:3|max:200',
            'numero_int'    =>  'min:1|max:10',
            'numero_ext'    =>  'min:1|max:10',
            'colonia'       =>  'required|min:3|max:200',
            'cp'            =>  'required',
            'estado'        =>  'required|max:200',
            'municipio'     =>  'required|max:200',
            'username'      =>  'min:4|required|unique:clientes|max:32',
            'email'         =>  'email|required|unique:clientes',
            'password'      =>  'required|min:4|confirmed'
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre'     => $data['nombre'],
            'ape_pat'    => $data['ape_pat'],
            'ape_mat'    => $data['ape_mat'],
            'telefono1'  => $data['telefono1'],
            'telefono2'  => $data['telefono2'],
            'calle'      => $data['calle'],
            'numero_int' => $data['numero_int'],
            'numero_ext' => $data['numero_ext'],
            'colonia'    => $data['colonia'],
            'cp'         => $data['cp'],
            'estado'     => $data['estado'],
            'municipio' => $data['municipio'],
            'username'  => $data['username'],
            'email'      => $data['email'],
            'password'   => bcrypt($data['password']),
            'suscrito'   => $data['suscrito'] ?  1 :  0
        ]);
    }

}
