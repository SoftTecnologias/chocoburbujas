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
            @if ($secciones['banner']->activo)
                <!--Banner (banner)-->
                <div class="index_slider" style="{{ ($secciones['banner']->setHeight)? 'height:'.$secciones['banner']->height.'px' : '' }}">
                <div class="callbacks_container">
                    <ul class="rslides" id="slider">
                        <li><img src="images/accesorios.png" class="img-responsive" alt="" /></li>
                        <li><img src="images/alimento.png" class="img-responsive" alt="" /></li>
                        <li><img src="images/pug.png" class="img-responsive" alt="" /></li>
                    </ul>
                </div>
            </div>
            @endif
            @if ($secciones['anuncios']->activo)
                <!-- anuncios (anuncios)-->
                <div class="content_top">
                <div class="grid_1">
                    <div class="col-md-3">
                        <div class="box2">
                            <ul class="list1">
                                <i class="lock"> </i>
                                <li class="list1_right">
                                    <p>Hasta 5% en productos para perros</p>
                                </li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box3">
                            <ul class="list1">
                                <i class="clock1"> </i>
                                <li class="list1_right">
                                    <p>abierto de 8 am a 8 pm</p>
                                </li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box4">
                            <ul class="list1">
                                <i class="vehicle"> </i>
                                <li class="list1_right">
                                    <p>Servicio de recoleccion y entrega</p>
                                </li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box5">
                            <ul class="list1">
                                <i class="dollar"> </i>
                                <li class="list1_right">
                                    <p>Los mejores productos y servicios al mejor precio</p>
                                </li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            @endif
            @if ($secciones['promocionesM']->activo)
                <!-- Promociones del Mes (promocionesM)-->
                <div class="content_middle">
                <ul class="promote">
                <i class="promote_icon"> </i>
                <li class="promote_head">
                    <h3>{{$secciones['promocionesM']->nombre}}</h3></li>
                </ul>
                    <!-- Promociones -->
                    @if(sizeof($promociones)> 0)
                        <ul id="flexiselDemo3" >

                    @foreach($promociones as $promocion)
                        <li >
                            <div class="col-md-offset-1 col-md-11"><img src="images/productos/{{$promocion->img1}}" class="img-responsive" style=" height: 200px; width: 150px;" /></div>
                            <div class="grid-flex"><h4> {{$promocion->nombre}} </h4>
                                <p> $ {{$promocion->precio1}} </p>
                                <div class="m_3"><a href="#" class="link1" onclick="verProducto({{$promocion->codigo}})">ver más detalles</a></div>
                                <div class="ticket"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                    @else
                        <div class="container">
                    <div class="callbacks_container">
                        <ul class="rslides" id="slider">
                            <li><img src="images/proximamente.png" class="img-responsive" alt="" style="height: 180px; widht: 888px"/></li>
                        </ul>
                    </div>
                </div>
                    @endif
                    <script type="text/javascript" src="js/plugins/jquery.flexisel.js"></script>
            </div>
            @endif
            @if ($secciones['promociones']->activo)
                <!-- Promociones (promociones)-->
                <div class="content_middle">
                <ul class="promote">
                <i class="promote_icon"> </i>
                <li class="promote_head">
                    <h3>{{$secciones['promociones']->nombre}}</h3></li>
            </ul>
                <!-- Promociones -->
                @if(sizeof($promociones)> 0)
                    <ul id="flexiselDemo3" >

                        @foreach($promociones as $promocion)
                            <li >
                                <div class="col-md-offset-1 col-md-11"><img src="images/productos/{{$promocion->img1}}" class="img-responsive" style=" height: 200px; width: 150px;" /></div>
                                <div class="grid-flex"><h4> {{$promocion->nombre}} </h4>
                                    <p> $ {{$promocion->precio1}} </p>
                                    <div class="m_3"><a href="#" class="link1" onclick="verProducto({{$promocion->codigo}})">ver más detalles</a></div>
                                    <div class="ticket"></div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else

                    <div class="container">
                        <div class="callbacks_container">
                            <ul class="rslides" id="slider">
                                <li><img src="images/proximamente.png" class="img-responsive" alt="" style="height: 180px; widht: 888px"/></li>
                            </ul>
                        </div>
                    </div>
                @endif
                <script type="text/javascript" src="js/plugins/jquery.flexisel.js"></script>
            </div>
            @endif
            @if ($secciones['mVendidos']->activo)
                <!-- Mas Vendidos (mVendidos)-->
                <div class="content_middle">
                <div class="sellers_grid">
                    <ul class="sellers">
                        <i class="star"> </i>
                        <li class="sellers_desc">
                            <h2>{{$secciones['mVendidos']->nombre}}</h2></li>
                        <div class="clearfix"> </div>
                    </ul>
                </div>
                <!-- Mas vendidos-->
                <div class="grid_2">
                @foreach($topselling as $product)
                    <div class="col-md-3 span_6">
                        <div class="box_inner">
                            <div class="col-md-offset-1 col-md-11"><img src="images/productos/{{$product->img1}}" class="img-responsive"
                                                                        style="height: 250px; width: 200px;"/></div>
                            <div class="sale-box"></div>
                            <div class="desc">
                                <h3>{{$product->nombre}}</h3>
                                <h4>$ {{$product->precio1}}</h4>
                                <ul class="list2">
                                    <li class="list2_left"><span class="m_1"><a href="#"  onclick="addProducto('{{$product->codigo}}')" class="link product addToCart">Añadir al carrito</a></span>
                                    </li>
                                    <li class="list2_right"><span class="m_2"><a href="#" class="link1 productdetail"
                                                                                 onclick="verProducto({{$product->codigo}})">ver más</a></span>
                                    </li>
                                    <div class="clearfix"></div>
                                </ul>
                                <div class="heart"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
                        TENEMOS SERVICIOS DE CONSULTAS, VACUNAS, DESPARASITACION, CIRUGIA, HOSPITALIZACION, ORTOPEDIA,
                        ODONTOLOGIA, RAYOS X, ANALISIS CLINICOS, ULTRASONIDO. TODO LO TENEMOS EN NUESTRAS INSTALACIONES.
                        ALIMENTOS PREMIUM (ROYAL CANIN, DIAMOND, NUPEC).
                        HOSPEDAJE, ROPA, ACCESORIOS, CAMAS, TRANSPORTADORAS, CASAS Y MUCHAS OTRAS COSAS PARA CONSENTIR A TUS MASCOTAS.
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
                        <li>
                            <a href="https://www.facebook.com/Veterinariaboutiqueyesteticachocoburbujas/"> <i class="fb"> </i> </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 span_1">
                    <ul class="spinner">
                        <i class="mail"> </i>
                        <li class="spinner_head">
                            <h3>Contactanos</h3></li>
                        <div class="clearfix"> </div>
                    </ul>
                    <p>Avenida de los insurgentes poniente </p>
                    <p>Colonia Las Brisas,</p>
                    <p> Telefono: 311 169 5037</p>
                    <p><a href="mailto:chocovetyest@hotmail.com"> Mas informacion </a></p>
                </div>
                <div class="clearfix"> </div>
            </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    {{Html::script('js/shop/index.js')}}
@endsection
@section('partials.footer')