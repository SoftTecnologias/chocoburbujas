@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas'=>$marcas])
@endsection
<script>
    $(".megamenu").megamenu();
</script>
@section('content')
    <div class="men">
        <div class="container">
            <div class="col-md-3 sidebar">
                <div class="block block-layered-nav">
                    <div class="block-title">
                        <strong><span>Comprar por</span></strong>
                    </div>
                    <div class="block-content">
                        <dl id="narrow-by-list">
                            <dt class="odd">Precios</dt>
                            <dd class="odd">
                                <ol>
                                    <li>
                                        <a href="#" data-val="1" class="fprice"><span class="price1">$&nbsp;0,00</span> - <span class="price1">$&nbsp;99,99</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-val="2" class="fprice"><span class="price1">$&nbsp;100,00</span> - <span class="price1">$&nbsp;199,99</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-val="3" class="fprice"><span class="price1">$&nbsp;200,00</span> - <span class="price1">$&nbsp;299,99</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-val="4" class="fprice"><span class="price1">$&nbsp;300,00</span> - <span class="price1">$&nbsp;399,99</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-val="5" class="fprice"><span class="price1">$&nbsp;400,00</span> - <span class="price1">$&nbsp;499,99</span></a>
                                    </li>
                                    <li>
                                        <a href="#" data-val="6" class="fprice"><span class="price1">+ $&nbsp;500,00</span></a>
                                    </li>
                                </ol>
                            </dd>
                            <dt class="even">Marcas</dt>
                            <dd class="even">
                                <ol>
                                    @foreach($marcas as $marca)
                                        @if($marca->total > 0)
                                            <li>
                                                <a href="#" data-val="{{$marca->nombre}}" class="fbrand">{{"$marca->nombre ($marca->total)"}}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                </ol>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="block block-cart">
                    <div class="block-title">
                        <strong><span>Carrito</span></strong>
                    </div>
                    <div class="block-content">
                        <p class="empty">No tienes productos en tu carrito de compra </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h1>Se encontraron {{$productos->total()}} productos</h1>
                <div class="mens-toolbar">
                    <div class="clearfix"></div>
                </div>
                <?php $i=0;?>
                @foreach(array_chunk($productos->getCollection()->all(),3) as $row)
                <div class="span_2">
                    @foreach($row as $item)
                    <div class="col_1_of_single1 span_1_of_single1 row">

                            <img src="../images/productos/{{$item->img1}}" class="img-responsive" alt="" style="height: 250px; width: 200px;"/>
                            <h3>{{$item->nombre}}</h3>
                            <p>{{$item->descripcion}}</p>
                            <h4>${{$item->precio1}}</h4>
                            <ul class="list2">
                                <li class="list2_left"><span class="m_1"><a href="#" onclick="addProducto('{{$item->codigo}}')" class="link addToCart"
                                                                            >Añadir al carrito</a></span>
                                </li>
                                <li class="list2_right"><span class="m_2"><a href="#" class="link1"
                                    data-toggle="modal"
                                    data-target="#producto_view{{$i+1}}">ver más</a></span>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                    </div>
                    <?php $i++;?>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
                @endforeach
                <div class="row center">
                    <?php
                    $link = [];
                    if(isset($_GET['precio']))
                        $link['precio'] = $_GET['precio'];
                    if(isset($_GET['marca']))
                        $link['marca'] = $_GET['marca'];

                    ?>
                    {{$productos->appends($link)->links()}}
                    <?php $i=0;?>
                    @foreach ($productos->getCollection()->all() as $item)
                        <div class="modal fade product_view " id="producto_view{{$i+1}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="#" data-dismiss="modal" class="class pull-right"><span
                                                class="glyphicon glyphicon-remove"></span></a>
                                        <h3 class="modal-title">{{$item->nombre}}</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 product_img">
                                                <div class="preview-pic tab-content ">
                                                    <div class="tab-pane active" id="{{$i+1}}pic-1"><img src="{{asset('images/productos/'.$item->img1)}}" class="img-responsive" /></div>
                                                    <div class="tab-pane" id="{{$i+1}}pic-2"><img src="{{asset('images/productos/'.$item->img2)}}" class="img-responsive"/></div>
                                                    <div class="tab-pane" id="{{$i+1}}pic-3"><img src="{{asset('images/productos/'.$item->img3)}}"   class="img-responsive"/></div>
                                                </div>
                                                <ul class="preview-thumbnail nav nav-tabs">
                                                    <li class="active" ><a data-target="#{{$i+1}}pic-1" data-toggle="tab"><img src="{{asset('images/productos/'.$item->img1)}}" class="img-responsive"/></a></li>
                                                    <li ><a data-target="#{{$i+1}}pic-2" data-toggle="tab"><img src="{{asset('images/productos/'.$item->img2)}}" /></a></li>
                                                    <li ><a data-target="#{{$i+1}}pic-3" data-toggle="tab"><img src="{{asset('images/productos/'.$item->img3)}}" /></a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12 product_content">
                                                <h4>Codigo del producto: <span>{{$item->codigo}}</span></h4>
                                                <p>{{$item->descripcion}}.</p>
                                                <h3 class="cost"> {{isset($item->precio1)?  "$ ".number_format($item->precio1, 2,".",",")." MXN" : "Inicia sesión para verlos precios"}}
                                                </h3>
                                                <div class="space-ten"></div>
                                                <div class="btn-ground">
                                                    <button type="button" class="btn btn-primary" onclick="addProducto('{{$item->codigo}}')"><span
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

        </div>
    </div>
    <!-- Modales de productos-->

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
    {{Html::script('js/shop/categorias.js')}}
@endsection
@section('partials.footer')