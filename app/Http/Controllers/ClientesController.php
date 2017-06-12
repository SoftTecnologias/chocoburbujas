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

    public function getCategorias(Request $request, $id){
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
        $busqueda = $request->query();
        $marcas = DB::table('marcas')
            ->orderBy('nombre','asc')
            ->get();
            $categorias = DB::table('categorias')->take(10)->get();
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



}
