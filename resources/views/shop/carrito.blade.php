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
            <div class="row">
                <h3>Tu carrito de compras contiene: <span id="canP">{{Session::has('carrito') ? Session::get('carrito')->cantidadProductos : '0'}} Productos</span></h3>
                <hr>
            </div>
            <div class="container">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th style="width:50%">Producto</th>
                        <th style="width:10%">Precio</th>
                        <th style="width:8%">Cantidad</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products != null)
                    <?php $total = 0; $i=0;  ?>
                    @foreach($products as $product)
                    <tr id="row{{$i}}">
                        <td data-th="Producto">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><a href="#" id="codigo{{$i}}" data-value="{{$product['item']['codigo']}}"><img src="{{asset("images/productos/".$product['item']['img1'])}}" alt="Producto{{$product['item']['id']}}" class="img-responsive"/></a></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{$product['item']['nombre']}}</h4>
                                    <p>{{$product['item']['descripcion']}}</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">$<span id="pr{{$i}}">{{$product['item']['precio1']}}</span></td>
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center" value="{{$product['cantidad']}}" id="ca{{$i}}" onchange="updateCart('{{$i}}')">
                        </td>
                        <td data-th="Subtotal" class="text-center" >$<span id="sb{{$i}}">{{$product['total']}}</span></td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm " onclick="removeCarrito('{{$product['item']['codigo']}}','{{$i}}')"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                        <?php $total += $product['total']; $i++;?>
                    @endforeach
                    @else
                      <tr> No tienes ningun item en el carrito de compras </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    <tr class="visible-xs">
                        <td class="text-center" ><strong>Total: {{$total}}</strong></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('shop.index')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuar comprando</a></td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center" ><strong><span id="gTotal">Total ${{$total}}</span></strong></td>
                        <td><a href="#" class="btn btn-success btn-block" {{($products!=null)? 'onclick=checkout()' : ""}} {{($products!=null)? '' : 'disabled'}} id="Ncheck">Checkout <i class="fa fa-angle-right"></i></a></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{Html::script('js/shop/shoppingCart.js')}}
@endsection
@section('partials.footer')