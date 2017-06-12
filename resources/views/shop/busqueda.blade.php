@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas'=> $marcas])
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
                <h1>Se encontraron {{sizeof($productos->getCollection()->all())}} productos</h1>
                <div class="mens-toolbar">
                    <div class="clearfix"></div>
                </div>
                @foreach(array_chunk($productos->getCollection()->all(),3) as $row)
                    <div class="span_2">
                        @foreach($row as $item)
                            <div class="col_1_of_single1 span_1_of_single1 row">

                                <img src="{{asset('images/productos/'.$item->img1)}}" class="img-responsive" alt="" style="height: 250px; width: 200px;"/>
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
                    <?php
                        $link = array('search' => $_GET['search']);
                        if(isset($_GET['precio']))
                            $link['precio'] = $_GET['precio'];
                    if(isset($_GET['marca']))
                        $link['marca'] = $_GET['marca'];

                    ?>
                    {{$productos->appends($link)->links()}}
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    {{Html::script('js/shop/search.js')}}
@endsection
@section('partials.footer')
@endsection



<div class="container">
    @if(Session::has('carrito'))
        <div class="row">
            <div class="col-sm-11 col-md-offset-1">
                <table id="productTable"
                       class=" table table-bordered table-hover table-striped table-condensed table-responsive "
                       role="grid" aria-describedby="productos_info" width="100%">
                    <thead>
                    <tr role="row">
                        <th class="sorting " tabindex="0" aria-controls="productTable"
                            rowspan="1" colspan="1" aria-sort="ascending" aria-label="Muestra: Imagen del producto">
                            Imagen del producto
                        </th>
                        <th class="sorting_asc" tabindex="0"
                            aria-controls="productTable"
                            rowspan="1" colspan="1" aria-sort="ascending"
                            aria-label="codigo">
                            Nombre
                        </th>
                        <th class="sorting_asc " tabindex="0"
                            aria-controls="productTable"
                            rowspan="1" colspan="1" aria-sort="ascending"
                            aria-label="Nombre">
                            Cantidad
                        </th>
                        <th class="sorting_asc " tabindex="0"
                            aria-controls="productTable"
                            rowspan="1" colspan="1" aria-sort="ascending"
                            aria-label="Nombre">
                            Precio
                        </th>
                        <th class="sorting_asc " tabindex="0"
                            aria-controls="productTable"
                            rowspan="1" colspan="1" aria-sort="ascending"
                            aria-label="Marca">
                            Importe
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="col-md-3">
                                <img src="images/productos/{{$product['item']['img1']}}" class="img-responsive"
                                     style="height: 100px; width: 75px;"/>
                            </td>
                            <td class="col-md-3">
                                {{$product['item']['nombre']}}
                            </td>
                            <td class="col-md-2">
                                <div class="col-md-12">
                                    <input type="number" value="{{$product['cantidad']}}" >
                                </div>
                            </td>
                            <td>
                                $ {{$product['item']['precio1']}}
                            </td>
                            <td>
                                $ {{$product['total']}}
                            </td>
                            <td>
                                <a  class="close" data-dismiss="modal" href="{{route('Producto.removeCarrito',['id'=> $product['item']['id']])}}">&times;</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6 pull-left">
                        <h1> <strong>Total: $ {{$total}}</strong></h1>
                    </div>
                    <div class="col-md-6 pull-right">
                        <a type="button " href="{{route('checkout')}}" class="btn btn-success">CheckOut</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6">
            <h2>No hay items en el carrito!</h2>
        </div>

    @endif

</div>