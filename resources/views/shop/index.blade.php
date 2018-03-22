@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
   @include('partials.menu',['categorias'=>$categorias, 'marcas' => $marcas])
@endsection
@section('content')
    <!-- Esta parte es la que siempre va a variar
      Pero por ahora dejaré el index fijo
 -->
    <div id="contenido">
        <div class="container">
            <div class="container">
                <div id="banner" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                            $firstli = true;
                            $firstimg = true;
                        ?>
                        @foreach($banner as $b)
                            @if($firstli == true)
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <?php
                                    $firstli = false;
                                    ?>
                                @else
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                @endif
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach($banner as $b)
                            @if($firstimg == true)
                                <div class="item active">
                                    <img src="images/banner/{{$b->image}}" alt="Los Angeles" style="width:100%;">
                                </div>
                                <?php
                                $firstimg = false;
                                ?>
                            @else
                                <div class="item">
                                    <img src="images/banner/{{$b->image}}" alt="Chicago" style="width:100%;">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>            <!--Banner -->

            @if ($secciones['promocionesM']->activo)
                <!-- Promociones del Mes (promocionesM)-->
                <div class="content_middle">
                        <div class="sellers_grid">
                            <ul class="sellers">
                                <i class="star"> </i>
                                <li class="sellers_desc">
                                    <h2>{{$secciones['promocionesM']->nombre}}</h2></li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                        <div id="carousel-productos" class="carousel slide grid_2" data-ride="carousel">
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <!-- Controls -->
                                    <div class="controls pull-right ">
                                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-productos"
                                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success"
                                                                href="#carousel-productos"
                                                                data-slide="next"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $items = 0;?>
                                @foreach($monthly as $promocion)      
                                    @foreach($promocion->productPromotion->chunk(4) as $chunk)
                                        <div class="item {{($items==0)? "active" : "" }}">
                                            <div class="row">
                                                @foreach($chunk as $product)
                                                    <div class="col-md-3 span_6">
                                                        <div class="box_inner">
                                                            <div class="col-md-offset-1 col-md-11"><img src="images/productos/{{$product->producto->img1}}" class="img-responsive"
                                                                                                style="height: 250px; width: 200px;"/></div>
                                                            <div class="sale-box"></div>
                                                            <div class="desc">
                                                                <h3>{{$product->producto->nombre}}</h3>
                                                                <h4>De <strike>$ {{$product->producto->precio1}}</strike> a $ {{$product->producto->precio1-(($promocion->descuento/100)*$product->producto->precio1)}}</h4>                                                                
                                                                <h4>$ {{$product->producto->precio1}}</h4>
                                                                <ul class="list2">
                                                                    <li class="list2_left"><span class="m_1"><a href="#"  onclick="addProducto('{{$product->producto->codigo}}')" class="link product addToCart">Añadir al carrito</a></span>
                                                                    </li>
                                                                    <li class="list2_right"><span class="m_2"><a href="#" class="link1 productdetail"
                                                                                                                data-toggle="modal"
                                                                                                                data-target="#promocionM_view{{$items+1}}">ver más</a></span>
                                                                    </li>
                                                                    <div class="clearfix"></div>
                                                                </ul>
                                                                <div class="heart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $items++; ?>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>  
                        </div>
                        <!-- Mas vendidos-->
                        <div class="clearfix"> </div>
                    </div>    
                </div>
            @endif
            <!-- Promociones-->
            @if ($secciones['promociones']->activo)
                <!-- Promociones (promociones)-->
                <div class="content_middle">
                        <div class="sellers_grid">
                            <ul class="sellers">
                                <i class="star"> </i>
                                <li class="sellers_desc">
                                    <h2>{{$secciones['promociones']->nombre}}</h2></li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                        <div id="carousel-productos" class="carousel slide grid_2" data-ride="carousel">
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <!-- Controls -->
                                    <div class="controls pull-right ">
                                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-productos"
                                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success"
                                                                href="#carousel-productos"
                                                                data-slide="next"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $items = 0;?>
                                @foreach($promociones as $promocion)      
                                    @foreach($promocion->productPromotion->chunk(4) as $chunk)
                                        <div class="item {{($items==0)? "active" : "" }}">
                                            <div class="row">
                                                @foreach($chunk as $product)
                                                    <div class="col-md-3 span_6">
                                                        <div class="box_inner">
                                                            <div class="col-md-offset-1 col-md-11"><img src="images/productos/{{$product->producto->img1}}" class="img-responsive"
                                                                                                style="height: 250px; width: 200px;"/></div>
                                                            <div class="sale-box"></div>
                                                            <div class="desc">
                                                                <h3>{{$product->producto->nombre}}</h3>
                                                                <h4>De <strike>$ {{$product->producto->precio1}}</strike> a $ {{$product->producto->precio1-(($promocion->descuento/100)*$product->producto->precio1)}}</h4>                                                                
                                                                <h4>$ {{$product->producto->precio1}}</h4>
                                                                <ul class="list2">
                                                                    <li class="list2_left"><span class="m_1"><a href="#"  onclick="addProducto('{{$product->producto->codigo}}')" class="link product addToCart">Añadir al carrito</a></span>
                                                                    </li>
                                                                    <li class="list2_right"><span class="m_2"><a href="#" class="link1 productdetail"
                                                                                                                data-toggle="modal"
                                                                                                                data-target="#promocion_view{{$items+1}}">ver más</a></span>
                                                                    </li>
                                                                    <div class="clearfix"></div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <?php $items++; ?>
                                    @endforeach
                                @endforeach
                            </div>  
                        </div>
                        <!-- Mas vendidos-->
                        <div class="clearfix"> </div>
                    </div>    
                </div>
            @endif
            <!-- Mas vendidos -->
            @if ($secciones['mVendidos']->activo)
                <div class="content_middle">
                    <div class="sellers_grid">
                        <ul class="sellers">
                            <i class="star"> </i>
                            <li class="sellers_desc">
                                <h2>{{$secciones['mVendidos']->nombre}}</h2></li>
                            <div class="clearfix"> </div>
                        </ul>
                    </div>
                    <div id="carousel-productos" class="carousel slide grid_2" data-ride="carousel">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-9">
                                <!-- Controls -->
                                <div class="controls pull-right ">
                                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-productos"
                                    data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success"
                                                            href="#carousel-productos"
                                                            data-slide="next"></a>
                                </div>
                            </div>
                        </div>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php $items = 0; $indice = 0?>
                            @foreach(array_chunk($topselling,4) as $chunk)
                                <div class="item {{($items==0)? "active" : "" }}">
                                    <div class="row">
                                        @foreach($chunk as $product)
                                            <div class="col-md-3 span_6">
                                                <div class="box_inner">
                                                    <div class="col-md-offset-1 col-md-11"><img src="images/productos/{{$product->img1}}" class="img-responsive"
                                                                                            style="height: 250px; width: 200px;"/></div>
                                                    @if($product->promo == 1)
                                                        <div class="sale-box"></div>
                                                    @endif
                                                    <div class="desc">
                                                        <h3>{{$product->nombre}}</h3>
                                                        @if($product->promo == 1)
                                                            <h4>De <strike>$ {{$product->precio1}}</strike> a $ {{$product->newprice}}</h4>
                                                        @else
                                                            <h4>$ {{$product->precio1}}</h4>
                                                        @endif
                                                        <ul class="list2">
                                                            <li class="list2_left"><span class="m_1"><a href="#"  onclick="addProducto('{{$product->codigo}}')" class="link product addToCart">Añadir al carrito</a></span>
                                                            </li>
                                                            <li class="list2_right"><span class="m_2"><a href="#" class="link1 productdetail"
                                                                                                         data-toggle="modal"
                                                                                                         data-target="#mVendidos_view{{$items+1}}">ver más</a></span>
                                                            </li>
                                                            <div class="clearfix"></div>
                                                        </ul>
                                                        <div class="heart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $items++; ?>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mas vendidos-->
                    <div class="clearfix"> </div>
                </div>
            @endif
            
            @if ($secciones['blog']->activo)
                <!-- Blog (blog)-->
                <div class="content_middle_bottom">
                <div class="col-md-12">
                    <ul class="spinner">
                        <i class="paperclip"> </i>
                        <li class="spinner_head">
                            <h3>{{$secciones['blog']->nombre}}</h3></li>
                        <div class="clearfix"> </div>
                    </ul>
                    @foreach($blogs as $blog)
                    <div class="a-top">
                        <div class="left-grid">
                            <img src="images/blogs/{{$blog->img}}" class="img-responsive" alt="" />
                        </div>
                        <div class="right-grid">
                            <h4><a href="#">{{$blog->titulo}}</a></h4>
                            <p>{{$blog->descripcion}}</p>
                        </div>
                        <div class="but">
                            <a class="arrow" href="#"> </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
            @endif
            @if ($secciones['informacion']->activo)
                <!-- Información (informacion)-->
                <div class="content_bottom">
                <div class="col-md-3 span_1">
                    <ul class="spinner">
                        <i class="box_icon"> </i>
                        <li class="spinner_head">
                            <h3>Nuestro logo</h3></li>
                        <div class="clearfix"> </div>
                    </ul>
                    <img src="images//logo.png" class="img-responsive" alt="" />
                </div>
                <div class="col-md-3 span_1">
                    <ul class="spinner">
                        <i class="bubble"> </i>
                        <li class="spinner_head">
                            <h4>Acerca de nosotros</h4></li>
                        <div class="clearfix"> </div>
                    </ul>
                    <p>
                       @if($info == null)

                           @else
                           {{$info->nosotros}}
                        @endif
                    </p>
                </div>
                <div class="col-md-3 span_1">
                    <ul class="spinner">
                        <i class="mail"> </i>
                        <li class="spinner_head">
                            <h3>Nuestras redes</h3></li>
                        <div class="clearfix"> </div>
                    </ul>
                    <ul class="social">
                        @if($info->facebookUrl == null)
                            @else
                            <li>
                                <a class="btn" href="{{$info->facebookUrl}}"><i class="fa fa-facebook fa-3x" aria-hidden="true"></i></a>
                            </li>
                        @endif
                            @if($info->twitterUrl == null)
                            @else
                                <li>
                                    <a class="btn" href="{{$info->twitterUrl}}"><i class="fa fa-twitter fa-3x" aria-hidden="true"></i></a>
                                </li>
                            @endif
                            @if($info->googleUrl == null)
                            @else
                                <li>
                                    <a class="btn" href="{{$info->googleUrl}}"><i class="fa fa-google fa-3x" aria-hidden="true"></i></a>
                                </li>
                            @endif
                            @if($info->skypeUrl == null)
                            @else
                                <li>
                                    <a class="btn" href="{{$info->skypeUrl}}"><i class="fa fa-skype fa-3x" aria-hidden="true"></i></a>
                                </li>
                            @endif
                    </ul>
                </div>
                <div class="col-md-3 span_1">
                    <ul class="spinner">
                        <i class="mail"> </i>
                        <li class="spinner_head">
                            <h3>Contactanos</h3></li>
                        <div class="clearfix"> </div>
                    </ul>
                    @if($info == null)
                        @else
                        <p>Nos encontramos ubicados en:</p>
                    <p>{{$info->direccion1}} </p>
                    <p>{{$info->direccion2}},</p>
                    <p> Telefono: {{$info->telefono1}}</p>
                    @if($info->telefono2 != null)
                            <p>o al Telefono: {{$info->telefono1}}</p>
                        @endif
                    <p>Correo: <a href="mailto:{{$info->email}}">{{$info->email}}</a></p>
                        @endif
                </div>
                <div class="clearfix"> </div>
            </div>
            @endif

            <!-- Modalers de productos -->
            
            <!-- Promociones Mensuales-->
            <?php $i=0;?>
            @foreach($monthly as $promocion)      
                @foreach($promocion->productPromotion as $productoPromotion)      
                    <div class="modal fade product_view " id="promocionM_view{{$i+1}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span
                                            class="glyphicon glyphicon-remove"></span></a>
                                    <h3 class="modal-title">{{$productoPromotion->producto->nombre}}</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 product_img">
                                            <div class="preview-pic tab-content ">
                                                <div class="tab-pane active" id="{{$i+1}}pic-1"><img src="{{asset('images/productos/'.$productoPromotion->producto->img1)}}" class="img-responsive" /></div>
                                                <div class="tab-pane" id="{{$i+1}}pic-2"><img src="{{asset('images/productos/'.$productoPromotion->producto->img2)}}" class="img-responsive"/></div>
                                                <div class="tab-pane" id="{{$i+1}}pic-3"><img src="{{asset('images/productos/'.$productoPromotion->producto->img3)}}"   class="img-responsive"/></div>
                                            </div>
                                            <ul class="preview-thumbnail nav nav-tabs">
                                                <li class="active" ><a data-target="#{{$i+1}}pic-1" data-toggle="tab"><img src="{{asset('images/productos/'.$productoPromotion->producto->img1)}}" class="img-responsive"/></a></li>
                                                <li ><a data-target="#{{$i+1}}pic-2" data-toggle="tab"><img src="{{asset('images/productos/'.$productoPromotion->producto->img2)}}" /></a></li>
                                                <li ><a data-target="#{{$i+1}}pic-3" data-toggle="tab"><img src="{{asset('images/productos/'.$productoPromotion->producto->img3)}}" /></a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12 product_content">
                                            <h4>Codigo del producto: <span>{{$productoPromotion->producto->codigo}}</span></h4>
                                            <p>{{$productoPromotion->producto->descripcion}}.</p>
                                            <h3 class="cost"> {{isset($productoPromotion->producto->precio1)?  "$ ".number_format($productoPromotion->producto->precio1, 2,".",",")." MXN" : "Inicia sesión para verlos precios"}}
                                            </h3>
                                            <div class="space-ten"></div>
                                            <div class="btn-ground">
                                                <button type="button" class="btn btn-primary" onclick="addProducto('{{$productoPromotion->producto->codigo}}')"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span>
                                                    Agregar al carrito
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;?>
                @endforeach
            @endforeach
            
            <!-- Promociones -->
            <?php $items = 0;?>
            @foreach($promociones as $promocion)      
                @foreach($promocion->productPromotion as $productoPromotion)
                    <div class="modal fade product_view " id="promocion_view{{$i+1}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span
                                            class="glyphicon glyphicon-remove"></span></a>
                                    <h3 class="modal-title">{{$productoPromotion->producto->nombre}}</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 product_img">
                                            <div class="preview-pic tab-content ">
                                                <div class="tab-pane active" id="{{$i+1}}pic-1"><img src="{{asset('images/productos/'.$productoPromotion->producto->img1)}}" class="img-responsive" /></div>
                                                <div class="tab-pane" id="{{$i+1}}pic-2"><img src="{{asset('images/productos/'.$productoPromotion->producto->img2)}}" class="img-responsive"/></div>
                                                <div class="tab-pane" id="{{$i+1}}pic-3"><img src="{{asset('images/productos/'.$productoPromotion->producto->img3)}}"   class="img-responsive"/></div>
                                            </div>
                                            <ul class="preview-thumbnail nav nav-tabs">
                                                <li class="active" ><a data-target="#{{$i+1}}pic-1" data-toggle="tab"><img src="{{asset('images/productos/'.$productoPromotion->producto->img1)}}" class="img-responsive"/></a></li>
                                                <li ><a data-target="#{{$i+1}}pic-2" data-toggle="tab"><img src="{{asset('images/productos/'.$productoPromotion->producto->img2)}}" /></a></li>
                                                <li ><a data-target="#{{$i+1}}pic-3" data-toggle="tab"><img src="{{asset('images/productos/'.$productoPromotion->producto->img3)}}" /></a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12 product_content">
                                            <h4>Codigo del producto: <span>{{$productoPromotion->producto->codigo}}</span></h4>
                                            <p>{{$productoPromotion->producto->descripcion}}.</p>
                                            <h3 class="cost"> {{isset($productoPromotion->producto->precio1)?  "$ ".number_format($productoPromotion->producto->precio1, 2,".",",")." MXN" : "Inicia sesión para verlos precios"}}
                                            </h3>
                                            <div class="space-ten"></div>
                                            <div class="btn-ground">
                                                <button type="button" class="btn btn-primary" onclick="addProducto('{{$productoPromotion->producto->codigo}}')"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span>
                                                    Agregar al carrito
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;?>
                @endforeach
            @endforeach    
           
            <!-- Mas Vendidos -->
            <?php $i=0;?>
            @foreach($topselling as $producto)
                <div class="modal fade product_view " id="mVendidos_view{{$i+1}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <a href="#" data-dismiss="modal" class="class pull-right"><span
                                        class="glyphicon glyphicon-remove"></span></a>
                                <h3 class="modal-title">{{$producto->nombre}}</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 product_img">
                                        <div class="preview-pic tab-content ">
                                            <div class="tab-pane active" id="{{$i+1}}pic-1"><img src="{{asset('images/productos/'.$producto->img1)}}" class="img-responsive" /></div>
                                            <div class="tab-pane" id="{{$i+1}}pic-2"><img src="{{asset('images/productos/'.$producto->img2)}}" class="img-responsive"/></div>
                                            <div class="tab-pane" id="{{$i+1}}pic-3"><img src="{{asset('images/productos/'.$producto->img3)}}"   class="img-responsive"/></div>
                                        </div>
                                        <ul class="preview-thumbnail nav nav-tabs">
                                            <li class="active" ><a data-target="#{{$i+1}}pic-1" data-toggle="tab"><img src="{{asset('images/productos/'.$producto->img1)}}" class="img-responsive"/></a></li>
                                            <li ><a data-target="#{{$i+1}}pic-2" data-toggle="tab"><img src="{{asset('images/productos/'.$producto->img2)}}" /></a></li>
                                            <li ><a data-target="#{{$i+1}}pic-3" data-toggle="tab"><img src="{{asset('images/productos/'.$producto->img3)}}" /></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 product_content">
                                        <h4>Codigo del producto: <span>{{$producto->codigo}}</span></h4>
                                        <p>{{$producto->descripcion}}.</p>
                                        <h3 class="cost"> {{isset($producto->precio1)?  "$ ".number_format($producto->precio1, 2,".",",")." MXN" : "Inicia sesión para verlos precios"}}
                                        </h3>
                                        <div class="space-ten"></div>
                                        <div class="btn-ground">
                                            <button type="button" class="btn btn-primary" onclick="addProducto('{{$product->codigo}}')"><span
                                                    class="glyphicon glyphicon-shopping-cart"></span>
                                                Agregar al carrito
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;?>
            @endforeach 
        </div>
    </div>
@endsection
<style>
    .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column; }
    @media screen and (max-width: 996px) {
        .preview {
            margin-bottom: 20px; } }

    .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;

    }

    .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 15px; }
    .preview-thumbnail.nav-tabs li {
        width: 20%;
        margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block; }
    .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0; }


</style>
@section('scripts')
    <script type="text/javascript" src="js/plugins/jquery.flexisel.js"></script>
    {{Html::script('js/shop/index.js')}}
@endsection
@section('partials.footer')