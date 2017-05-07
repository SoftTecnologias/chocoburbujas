@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',array('categorias'=>$categorias))
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
                                        <a href="#"><span class="price1">$&nbsp;0,00</span> - <span class="price1">$&nbsp;99,99</span></a>

                                    </li>
                                    <li>
                                        <a href="#"><span class="price1">$&nbsp;100,00</span> - <span class="price1">$&nbsp;199,99</span></a>

                                    </li>
                                    <li>
                                        <a href="#"><span class="price1">$&nbsp;200,00</span> - <span class="price1">$&nbsp;299,99</span></a>

                                    </li>
                                    <li>
                                        <a href="#"><span class="price1">$&nbsp;400,00</span> - <span class="price1">$&nbsp;499,99</span></a>

                                    </li>
                                    <li>
                                        <a href="#"><span class="price1">+ $&nbsp;800,00</span></a>
                                    </li>
                                </ol>
                            </dd>
                            <dt class="even">Marcas</dt>
                            <dd class="even">
                                <ol>
                                    <li>
                                        <a href="#">Calvin Klein</a>
                                        (2)
                                    </li>
                                    <li>
                                        <a href="#">Diesel</a>
                                        (1)
                                    </li>
                                    <li>
                                        <a href="#">Polo</a>
                                        (1)
                                    </li>
                                    <li>
                                        <a href="#">Tommy Hilfiger</a>
                                        (1)
                                    </li>
                                    <li>
                                        <a href="#">Versace</a>
                                        (1)
                                    </li>
                                </ol>
                            </dd>
                            <dt class="last odd">Color</dt>
                            <dd class="last odd">
                                <ol>
                                    <li>
                                        Black                        (0)
                                    </li>
                                    <li>
                                        <a href="#">Blue</a>
                                        (2)
                                    </li>
                                    <li>
                                        <a href="#">Green</a>
                                        (1)
                                    </li>
                                    <li>
                                        <a href="#">Grey</a>
                                        (1)
                                    </li>
                                    <li>
                                        <a href="#">Red</a>
                                        (1)
                                    </li>
                                    <li>
                                        <a href="#">White</a>
                                        (1)
                                    </li>
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
                            <h4>${{$item->precio1}}</h4>
                            <ul class="list2">
                                <li class="list2_left"><span class="m_1"><a href="{{route('Producto.addCarrito',['id'=> $item->id,'ref'=>2])}}" class="link"
                                                                            data-value="{{$item->id}}">Añadir al carrito</a></span>
                                </li>
                                <li class="list2_right"><span class="m_2"><a href="#" class="link1"
                                                                             onclick="verProducto({{$item->id}})">ver más</a></span>
                                </li>
                                <div class="clearfix"></div>
                            </ul>

                    </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
                @endforeach
                <div class="row center">
                    {{$productos->links()}}
                </div>
            </div>

        </div>
    </div>

@endsection
@section('partials.footer')