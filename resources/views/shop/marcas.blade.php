@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias])
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

                        <div>
                            <div class="panel panel-default sidebar-menu">

                                <div class="panel-heading">
                                    <h3 class="panel-title clearfix">Precios</h3>
                                        <span class="hidden-sm">Limpiar filtros</span></a>
                                </div>

                                <div class="panel-body">
                                    <ul class="nav nav-pills nav-stacked price">
                                        <li data-val="MC0zOTk="><a href="#"  class="fprice" data-val="MC0zOTk=">$ 0.00 - $ 399.00 </a>
                                        </li>
                                        <li data-val="NDAwLTc5OQ=="><a href="#"  class="fprice" data-val="NDAwLTc5OQ==">$ 400.00 - $ 799.00 </a>
                                        </li>
                                        <li data-val="ODAwLTExOTk=" ><a href="#" class="fprice" data-val="ODAwLTExOTk=">$ 800.00 - $ 1199.00 </a>
                                        </li>
                                        <li data-val="MTIwMC0xNTk5"><a href="#"  class="fprice" data-val="MTIwMC0xNTk5">$ 1200.00 - $ 1599.00 </a>
                                        </li>
                                        <li data-val="MTYwMC0xOTk5"><a href="#" class="fprice" data-val="MTYwMC0xOTk5">$ 1600.00 - $ 1999.00 </a>
                                        </li>
                                        <li data-val="MjAwMA=="><a href="#"  class="fprice" data-val="MjAwMA==">$ 2000.00 + </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel panel-default sidebar-menu">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Categorias</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="nav nav-pills nav-stacked category">
                                        @foreach($categorias as $categoria)
                                            <li data-val="{{$categoria->id}}">
                                                <a   data-val="{{$categoria->id}}" href="#" class="fcategory">{{$categoria->nombre}}<span class="badge pull-right"></span></a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>

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
                <h1>Se encontraron {{sizeof($productos)}} productos</h1>
                <div class="mens-toolbar">
                    <div class="clearfix"></div>
                </div>
                @foreach(array_chunk($productos->getCollection()->all(),3) as $row)
                    <div class="span_2">
                        @foreach($row as $item)
                            <div class="col_1_of_single1 span_1_of_single1 row">

                                <img src="../images/productos/{{$item->img1}}" class="img-responsive" alt="" style="height: 250px; width: 200px;"/>

                                <h3>{{$item->nombre}}</h3>
                                <p>{{$item->descripcion}}</p>
                                @if($item->promo == 1)
                                    <h4>De <strike>$ {{$item->precio1}}</strike> a $ {{$item->newprice}}</h4>
                                @else
                                    <h4>$ {{$item->precio1}}</h4>
                                @endif
                                <ul class="list2">
                                    <li class="list2_left"><span class="m_1"><a href="#" onclick="addProducto('{{$item->codigo}}')" class="link addToCart"
                                                                                >Añadir al carrito</a></span>
                                    </li>
                                    <li class="list2_right"><span class="m_2"><a href="#" class="link1"
                                                                                 onclick="verProducto({{$item->codigo}})">ver más</a></span>
                                    </li>
                                    <div class="clearfix"></div>
                                </ul>

                            </div>

                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                @endforeach
                <div class="row center">
                    <?php
                    $link = [];
                    if(isset($_GET['precio']))
                        $link['precio'] = $_GET['precio'];
                    ?>
                    {{$productos->appends($link)->links()}}
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    {{Html::script('js/shop/marcas.js')}}
@endsection
@section('partials.footer')