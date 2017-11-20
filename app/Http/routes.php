<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// La aplicación de middleware se hará a nivel de rutas no sobre las funciones
/*Para Los administradores */
Route::group(['prefix'=>'panel'],function (){

    Route::get('/login',[
        'uses'=>'UsersController@showLoginForm',
        'as' => 'user.login',
    ]);
    Route::post('login/user',[
        'uses'=>'UsersController@doLogin',
        'as' => 'user.panel.login'
    ]);
    Route::get('/registro',[
        'uses'=>'UsersController@showRegistrationForm',
        'as' => 'user.register'
    ]);
    Route::post('/registro',[
        'uses'=>'UsersController@register',
        'as'=> 'user.register'
        ]);
    Route::get('/logout',[
        'uses'=>'UsersController@logout',
        'as' =>'user.logout',
    ]);
    Route::get('/area', [
        'uses'=>'UsersController@index',
        'as' =>'panel.area'
    ]);
    Route::get('/brands',['uses'=>'UsersController@showBrandForm',
        'as' =>'panel.brand'
    ]);
    Route::get('/categories',['uses'=>'UsersController@showCategoryForm',
        'as' =>'panel.category',
    ]);
    Route::get('/products',['uses'=>'UsersController@showProductForm',
        'as' =>'panel.product',
    ]);

    Route::post('/products/precioenvio',['uses'=>'UsersController@precioenvio',
        'as' =>'panel.product.precioenvio',
    ]);

    Route::get('/providers',['uses'=>'UsersController@showProviderForm',
        'as' =>'panel.provider',
    ]);
    Route::get('/profile',['uses'=>'UsersController@showProfileForm',
        'as' =>'user.profile',
    ]);
    Route::get('/users',['uses'=>'UsersController@showUserForm',
        'as' =>'panel.user',
    ]);
    Route::get('/movements',['uses'=>'UsersController@showMovementForm',
        'as' =>'panel.movements',
    ]);
    Route::get('/blogs',['uses'=>'UsersController@showBlogForm',
        'as' =>'panel.blogs',
    ]);
    Route::get('/secciones',[
        'uses'=>'UsersController@showSeccionForm',
        'as' =>'panel.secciones',
    ]);
    /*Peticiones con un retorno json*/
    /*CRUD*/
    Route::resource('/api/categorias','CategoriasController');
    Route::resource('/api/marcas', 'MarcasController');
    Route::resource('/api/productos',"ProductosController");
    Route::resource('/api/usuarios',"UsuariosController");
    Route::resource('/api/proveedores','ProveedoresController');
    Route::resource('/api/blogs','BlogsController');
    Route::get("/api/usuarios/email/{email}","UsersController@email");
    Route::get("/api/usuarios/username/{username}","UsersController@username");
    Route::post("/api/usuarios/{id}","UsuariosController@update");
    Route::post("/api/marcas/{id}","MarcasController@update");
    Route::post("/api/productos/{id}","ProductosController@update");
    Route::get("/api/municipios/{id}", 'ProveedoresController@municipios');
    Route::post("/api/municipios/{id}", 'ProveedoresController@update');
    Route::post('/api/blogs/{id}','BlogsController@update');
    Route::post('/api/configuraciones/{id}',"UsersController@updateSection");
    //Movimientos y sus detalles
    //mostrar movimientos con detalles
    Route::get("/api/movimientos",[
        'uses'=>'MovimientosController@index',
        'as' => 'panel.api.movimientos.index'
    ]);
    Route::get('/api/movimientos/{id}/detalle',[
        'uses' => 'MovimientosController@detailIndex',
        'as' => 'panel.api.movimientos.indexdetalle'
    ]);
    //crear movimiento y detalle
    //Movimiento
    Route::post('/api/movimientos',[
        'uses'=>'MovimientosController@store',
        'as' => 'panel.api.movimientos.store'
    ]);
    //Detalle movimiento
    Route::post('/api/movimientos/{movimiento}/create',[
        'uses'=>'MovimientosController@create',
        'as' => 'panel.api.movimientos.detalle'
    ]);
    //Eliminar Movimiento y detalle
    //Eliminar Movimiento (se tiene que eliminar en cascada)
    Route::delete('/api/movimientos/{movmiento}',[
        'uses'=>'MovimientosController@cancelMovement',
        'as' => 'panel.api.movimientos.destroy'
    ]);
    //Eliminar Detalle
    Route::delete('/api/movimientos/detail/{id}',[
        'uses'=>'MovimientosController@removeDetail',
        'as' => 'panel.api.movimientos.remove'
    ]);
});


/*Grupo de rutas para clientes*/
Route::group(['middleware'=>['web','cors'],'prefix'=>'/'],function() {
    Route::get('', [
        'uses' => 'ClientesController@index',
        'as'   => 'shop.index'
    ]);
    /*Para el cliente*/
    Route::get('/login', [
        'uses' => 'ClientesController@getLoginForm',
        'as' => 'cliente.login'
    ]);
    Route::post('/login', [
        'uses' => 'ClientesController@doLogin',
        'as' => 'cliente.dologin'
    ]);
    Route::get('/logout', [
        'uses' => 'ClientesController@logout',
        'as' => 'cliente.logout'
    ]);
    Route::get('/registro', [
        'uses' => 'ClientesController@getRegister',
        'as' => 'cliente.register'
    ]);
    Route::post('/registro', [
        'uses' => 'ClientesController@register',
        'as' => 'cliente.register.client'
    ]);
    Route::get('perfil', [
        'uses' => 'ClientesController@profile',
        'as' => 'cliente.profile'
    ]);
    Route::get('/perfil/infocompra/{id}',[
       'uses' => 'ClientesController@infoCompra'
    ]);
    Route::post('perfil/perup',[
        'uses' => 'ClientesController@perup',
        'as' => 'cliente.perup'
        ]);
    Route::post('/perfil/contup',[
        'uses' => 'ClientesController@contup',
        'as' => 'cliente.perup'
    ]);
    Route::post('/perfil/passup',[
        'uses' => 'ClientesController@passup',
        'as' => 'cliente.passup'
    ]);
    Route::post('/perfil/imgup',[
        'uses' => 'ClientesController@imgup',
        'as' => 'cliente.imgup'
    ]);
    Route::get('/categorias/{id}',[
        'uses' => 'ClientesController@getCategorias',
        'as' => 'shop.categoria'
    ]);
    Route::get('/marcas/{id}',[
        'uses' => 'ClientesController@getMarcas',
        'as' => 'shop.marca'
    ]);
    Route::get('/productos/{id}',[
        'uses' => 'ClientesController@getCategorias',
        'as' => 'shop.detalle'
    ]);

    Route::get('/shoppingCart',[
        'uses' => 'ProductosController@getCarrito',
        'as' => 'shop.carrito'
    ]);

    Route::post('/shoppingCart',[
        'uses' => 'ProductosController@postCarrito',
        'as' => 'shop.post.carrito'
    ]);
    Route::get('/checkout',[
        'uses' => 'ProductosController@Checkout',
        'as' => 'shop.checkout'
    ]);
    Route::post('/checkout',[
        'uses' => 'ProductosController@postpayment',
        'as' => 'payment'
    ]);

    Route::get('/makeOrder',[
        'uses' => "ProductosController@makeOrder",
        'as' => 'shop.makeOrder'
    ]);
    Route::get('/cancelOrder',[
        'uses' => "ProductosController@cancelOrder",
        'as' => 'shop.cancelOrder'
    ]);
    Route::get('/addProduct/{id}',[
        'uses' => 'ProductosController@addCarrito',
        'as' => 'Producto.addCarrito'
    ]); //llamada directa (proxima a eliminar)
    Route::post('/addToCart',[
        'uses' => 'ProductosController@addToCart',
        'as' => 'Producto.Ajax.addCart'
    ]); //llamada Ajax
    Route::get('/removeProduct/{id}',[
        'uses' => 'ProductosController@removeCarrito',
        'as' => 'Producto.removeCarrito'
    ]);
    Route::post('/updateCart',[
        'uses'=>'ProductosController@updateCart',
        'as' =>'carrito.updateCart'
    ]);
    Route::delete('/removeCart',[
        'uses' => 'ProductosController@removeCart',
        'as' => 'Producto.Ajax.removerCarrito'
    ]); //llamada ajax
    Route::get('/showItems',[
        'uses' => 'ProductosController@getItems',
        'as' => 'Producto.showCarrito'
    ]);
    Route::get('/search',[
        'uses'=>'ProductosController@search',
        'as' => 'Producto.search'
    ]);
    Route::get('/getMunicipios/{id}',[
        'uses' => 'ProductosController@getMunicipios',
        'as' => 'Municipios.get'
    ]);

    Route::get('/getMunicipiosfitro/{id}',[
        'uses' => 'ProductosController@Municipiosfiltroprecio',
        'as' => 'Municipios.get'
    ]);
});




