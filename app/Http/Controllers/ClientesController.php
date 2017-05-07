<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * @return $this
     */
    public function index(){
        $topselling = DB::table('productos')->take(4)->orderBy('vendidos', 'asc')->get();
        $promociones = DB::table('productos')->take(10)->where('promocion',1)->orderBy('precio1', 'asc')->get();
        $blogs = DB::table('blog')->take(4)->orderBy('fecha','asc')->get();
        $categorias = DB::table('categorias')->take(4)->get();
        $menu = array();
        foreach ($categorias as $categoria){
            $productos = DB::table('productos')->take(9)->where('categoria_id',$categoria->id)->orderBy('vendidos',1)->get();
            array_push($menu,[$categoria->id => $productos]);
        }
        return view('shop.index',['topselling'=>$topselling,
                                  'promociones'=>$promociones,
                                  'blogs' => $blogs,
                                  'categorias'=>$categorias
        ]);
    }

    public function getCategorias(Request $request, $id){
        $categorias = DB::table('categorias')->take(10)->get();
        $productos = DB::table('productos')->where('categoria_id',$id)->paginate(9);
        return view('shop.categorias',['categorias'=>$categorias,'productos'=> $productos]);
    }



}
