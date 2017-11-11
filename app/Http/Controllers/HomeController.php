<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Exception;

class HomeController extends Controller
{
    /******************************************************************************************************************
     *  Este controlador se encargará de la redirección a todas las vistas de la pagina                               *
     * ****************************************************************************************************************/

    public function index(){
        try{
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
        }catch(Exception $exception){
            dd($exception);
        }
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
        try {
            //parte de los filtros
            $url = base64_decode($id);
            $precioUsuario = "";
            $consultaPrecios = '';
            $consultaCategorias = null;
            $consultaSubcategorias = null;
            $consultaMarcas = null;
            if ($precioUsuario != "") {
                array_push($select, $precioUsuario . " as precio1");
            }
            if (strpos($url, "/")) { //Existe al menos un parametro a parte del id
                $partes = explode("/", $url); //Separamos el id y los parametros
                $urlid = $partes[0]; //ID en cuestion
                $parametros = explode('&', $partes[1]); //Separamos los parametros con &
                foreach ($parametros as $parametro) { //Recorremos los parametros enviados ("precio", "categorias", "subcategorias")
                    $filtro = explode('=', $parametro); //Separamos filtros[0] y valor[1]

                    switch ($filtro[0]) {
                        case 'precio': //Revisamos los valores que podria tener
                            $valores = explode(',', $filtro[1]); //Valores a filtrar
                            $consultaPrecios = "(";
                            if (sizeof($valores) > 1) {
                                $i = 0;
                                foreach ($valores as $valor) { //Recorremos los valores del filtro
                                    if (strpos($valor, '-')) { //Existe un rango
                                        $precios = explode('-', $valor);
                                        if ($i == 0) {
                                            $consultaPrecios .= "(" . (($precioUsuario == "") ? "productos.precio1" : $precioUsuario) . " between " . $precios[0] . " AND " . $precios[1] . ") ";
                                        } else {
                                            $consultaPrecios .= " OR (" . (($precioUsuario == "") ? "productos.precio1" : $precioUsuario) . " between " . $precios[0] . " AND " . $precios[1] . ") ";
                                        }
                                    } else { //no existe el rango
                                        if ($i == 0) {
                                            $consultaPrecios .= "( " . (($precioUsuario == "") ? "productos.precio1" : $precioUsuario) . "> $valor )";
                                        } else {
                                            $consultaPrecios .= " OR ( " . (($precioUsuario == "") ? "productos.precio1" : $precioUsuario) . "> $valor )";
                                        }
                                    }
                                    $i++;
                                }
                            } else { //Solo hay un filtro
                                if (strpos($valores[0], '-')) { //Existe un rango
                                    $rango = explode('-', $valores[0]);
                                    $consultaPrecios .= "(" . (($precioUsuario == "") ? "productos.precio1" : $precioUsuario) . " between " . $rango[0] . " AND " . $rango[1] . ") ";
                                } else {
                                    $consultaPrecios .= " ( " . (($precioUsuario == "") ? "productos.precio1" : $precioUsuario) . "> $valores[0] )";
                                }
                            }
                            $consultaPrecios .= ")";
                            break;
                        case 'categoria':
                            $valores = explode(',', $filtro[1]); //Valores a filtrar
                            $consultaCategorias = "(";
                            if (sizeof($valores) > 1) {
                                $consultaCategorias .= " productos.categoria_id IN( ";
                                $i = 0;
                                foreach ($valores as $valor) { //Recorremos los valores del filtro
                                    if ($i == 0) {
                                        $consultaCategorias .= $valor;
                                        $i++;
                                    } else {
                                        $consultaCategorias .= ", $valor";
                                    }
                                }
                                $consultaCategorias .= " ) ";

                            } else { //Solo hay un filtro
                                $consultaCategorias .= "( productos.categoria_id = $valores[0] ) ";
                            }
                            $consultaCategorias .= " )";
                            break;
                    }
                }
            }
            else {
                $urlid = $url;
            }
            $filtromarcas = [];
            $filtrobusqueda = DB::table('productos')
                ->select("*")
                ->where('img1', 'not like', 'minilogo.png')
                ->where('nombre', 'like', '%' . $urlid . '%');
            /*Aplicacion de los filtros con o sin precios ... */
            if ($consultaPrecios != null) {
                $filtrobusqueda->whereRaw($consultaPrecios);
                /* Parte de los filtros con precios */
                $todasCategorias = DB::table('categorias')
                    ->select('categorias.id',
                        'categorias.nombre')
                    ->orderBy('nombre', 'asc')
                    ->get();
                //Filtro  de categorias y subcategorias
                foreach ($todasCategorias as $categoria)
                    $filtroCategorias = [];
                array_push($filtroCategorias, ['id' => base64_encode($categoria->id), 'nombre' => $categoria->nombre]);

            }

            /* Aplicacion Recuperación de los productos con o sin filtros*/
            if ($consultaCategorias != null) {
                $filtrobusqueda->whereRaw($consultaCategorias);
            }
            if ($consultaSubcategorias != null) {
                $filtrobusqueda->whereRaw($consultaSubcategorias);
            }
            if ($consultaMarcas != null) {
                $filtrobusqueda->whereRaw($consultaMarcas);
            }
            $filtrobusqueda = $filtrobusqueda->paginate();
            // Parte del menu


            //Menu de marcas
        } catch (Exception $e){

        }

        /* ************************************************************* */

        return view('shop.marcas',['categorias'=>$categorias,'productos'=> $filtrobusqueda,'marcas'=> $marcas]);
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
}
