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
                                    <img src="images/Banner/{{$b->image}}" alt="Los Angeles" style="width:100%;">
                                </div>
                                <?php
                                $firstimg = false;
                                ?>
                            @else
                                <div class="item">
                                    <img src="images/Banner/{{$b->image}}" alt="Chicago" style="width:100%;">
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
            <!-- Mas vendidos-->
                @endif
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
                            </div>
                            <?php $items++; ?>
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
                        TENEMOS SERVICIOS DE CONSULTAS, VACUNAS, DESPARASITACION, CIRUGIA, HOSPITALIZACION, ORTOPEDIA, ODONTOLOGIA, RAYOS X, ANALISIS CLINICOS, ULTRASONIDO. TODO LO TENEMOS EN NUESTRAS INSTALACIONES.
                        ALIMENTOS PREMIUM (ROYAL CANIN, DIAMOND, NUPEC). HOSPEDAJE, ROPA, ACCESORIOS, CAMAS, TRANSPORTADORAS, CASAS Y MUCHAS OTRAS COSAS PARA CONSENTIR A TUS MASCOTAS.
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