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
        'middleware' => 'guest:web'
    ]);
    Route::post('/login',[
        'uses'=>'UsersController@login',
        'as' => 'user.login',
        'middleware' => 'guest:web'
    ]);
    Route::get('/registro',[
        'uses'=>'UsersController@showRegistrationForm',
        'as' => 'user.register',
            'middleware' => 'auth:web'
    ]);
    Route::post('/registro',[
        'uses'=>'UsersController@register',
        'as'=> 'user.register',
        'middleware' => 'auth'
        ]);
    Route::get('/logout',[
        'uses'=>'UsersController@logout',
        'as' =>'user.logout',
        'middleware'=>['auth','is_admin']
    ]);
    Route::get('/area',['uses'=>'UsersController@index',
        'as' =>'panel.area',
        'middleware'=>'auth:web']);
    Route::get('/brands',['uses'=>'UsersController@showBrandForm',
        'as' =>'panel.brand',
        'middleware'=>'auth:web']);
    Route::get('/categories',['uses'=>'UsersController@showCategoryForm',
        'as' =>'panel.category',
        'middleware'=>'auth:web']);
    Route::get('/products',['uses'=>'UsersController@showProductForm',
        'as' =>'panel.product',
        'middleware'=>'auth:web']);
    Route::get('/providers',['uses'=>'UsersController@showProviderForm',
        'as' =>'panel.provider',
        'middleware'=>'auth:web']);
    Route::get('/profile',['uses'=>'UsersController@showProfileForm',
        'as' =>'user.profile',
        'middleware'=>'auth:web']);
    Route::get('/users',['uses'=>'UsersController@showUserForm',
        'as' =>'panel.user',
        'middleware'=>['auth:web','is_admin']]);
    Route::get('/movements',['uses'=>'UsersController@showMovementForm',
        'as' =>'panel.movements',
        'middleware'=>['auth:web','is_admin']]);
    Route::get('/blogs',['uses'=>'UsersController@showBlogForm',
        'as' =>'panel.blogs',
        'middleware'=>['auth:web','is_admin']]);
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
Route::group(['middleware'=>'web','prefix'=>'/'],function() {

    Route::get('', [
        'uses' => 'ClientesController@index',
        'as'   => 'shop.index'
    ]);
    /*Para el cliente*/
    Route::get('/login', [
        'uses' => 'Auth\AuthController@showLoginForm',
        'as' => 'cliente.login'
    ]);

    Route::post('login', [
        'uses' => 'Auth\AuthController@login',
        'as' => 'cliente.login'
    ]);

    Route::get('logout', [
        'uses' => 'Auth\AuthController@logout',
        'as' => 'cliente.logout'
    ]);

    Route::get('registro', [
        'uses' => 'Auth\AuthController@showRegistrationForm',
        'as' => 'cliente.register'
    ]);

    Route::post('registro', [
        'uses' => 'Auth\AuthController@register',
        'as' => 'cliente.register'
    ]);

    Route::get('perfil', [
        'uses' => 'ClientesController@index',
        'as' => 'cliente.profile',
        'middleware'=>'auth:cliente'
    ]);

    Route::get('/categorias/{id}',[
        'uses' => 'ClientesController@getCategorias',
        'as' => 'shop.categoria'
    ]);
    Route::get('/productos/{id}',[
        'uses' => 'ClientesController@getCategorias',
        'as' => 'shop.detalle'
    ]);
    Route::get('/shoppingCart',[
        'uses' => 'ProductosController@getCarrito',
        'as' => 'shop.carrito'
    ]);

    Route::get('/checkout',[
        'uses' => 'ProductosController@Checkout',
        'as' => 'checkout'
    ]);
    Route::post('/checkout',[
        'uses' => 'ProductosController@postCheckout',
        'as' => 'checkout'
    ]);
    Route::get('/addProduct/{id}',[
        'uses' => 'ProductosController@addCarrito',
        'as' => 'Producto.addCarrito'
    ]);
    Route::get('/removeProduct/{id}',[
        'uses' => 'ProductosController@removeCarrito',
        'as' => 'Producto.removeCarrito'
    ]);
    Route::get('/showItems',[
        'uses' => 'ProductosController@getItems',
        'as' => 'Producto.showCarrito'
    ]);

});




