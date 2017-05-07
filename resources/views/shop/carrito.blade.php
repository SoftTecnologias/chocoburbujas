@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',array('categorias'=>$categorias))
@endsection
@section('content')
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
                @else
                    <div class="col-md-6">
                        <h2>No hay items en el carrito!</h2>
                    </div>

                @endif
            </div>
    </div>
<hr>
@endsection
@section('partials.footer')