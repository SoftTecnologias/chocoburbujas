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
    <?php
        $cookie = \Illuminate\Support\Facades\Cookie::get('cliente');
        $total = 0; $i=0; $subtotal=0;
    ?>
    <div id="contenido">
        <div class="container">
            <div class="row">
                <h3>Tu carrito de compras contiene: <span id="canP">{{$cookie != null ? $cookie['carrito']->cantidadProductos : '0'}} Productos</span></h3>
                <hr>
            </div>

            <div class="container" style="background-color: #fbfbfb">
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
                        @foreach($products as $product)
                            <tr id="row{{$i}}" data-qty="{{$product['cantidad']}}" data-id="{{$product['item']['id']}}">
                                <td data-th="Producto" >
                                    <div class="row">
                                        <div class="col-sm-2 hidden-xs"><a href="#" id="codigo{{$i}}" data-value="{{$product['item']['codigo']}}"><img src="{{asset("images/productos/".$product['item']['img1'])}}" alt="Producto{{$product['item']['id']}}" class="img-responsive"/></a></div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin">{{$product['item']['nombre']}}</h4>
                                                @if($product['item']['discount'] != 0)
                                                    <p>${{$product['item']['price']}} con {{$product['item']['discount']}}% de Descuento</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div
                                </td>
                                <td data-th="Price">$<span id="pr{{$i}}">{{$product['item']['precio1']}}</span></td>
                                <td data-th="Quantity" id="qty{{base64_decode($product['item']['id'])}}">
                                    <input type="number" class="form-control text-center" value="{{$product['cantidad']}}" id="ca{{$i}}" onchange="updateCart('{{$i}}')">
                                </td>
                                <td data-th="Subtotal" class="text-center" >
                                    <div class="row">
                                        $<span id="sb{{$i}}">{{$product['total']}}</span>
                                        <br>
                                        @if($product['item']['discount'] != 0)
                                            <span>Usted Ahorra: {{round(($product['item']['price']*$product['cantidad'])-$product['total'],2)}}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-danger btn-sm " onclick="removeCarrito('{{$product['item']['codigo']}}','{{$i}}')"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                            <?php $total += $product['total']; $i++; $subtotal+= round($product['item']['price']*$product['cantidad'],2);?>
                        @endforeach
                    @else
                      <tr> No tienes ningun item en el carrito de compras </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    @if($products !=null)    
                        <tr class="visible-xs">
                            <td class="text-center" ><strong>{{$total}}</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="hidden-xs"></td>
                            <td>Subtotal</td>
                            <td class="hidden-xs text-center" ><strong><span id="">${{$subtotal}}</span></strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="hidden-xs"></td>
                            <td>Descuentos</td>
                            <td class="hidden-xs text-center" ><strong><span id="">${{$subtotal-$total}}</span></strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="hidden-xs"></td>
                            <td>Total</td>
                            <td class="hidden-xs text-center" ><strong><span id="gTotal">${{$total}}</span></strong></td>
                        </tr>
                    @endif
                    </tfoot>
                </table>
                <br>
                <div class="box-footer">
                    <div class="pull-left">
                        <a href="{{ route('shop.index')}}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Continuar Comprando</a>
                    </div>
                    @if($products != null)
                        <div class="pull-right">
                            <a class="btn btn-primary" id="updateCart"><i class="fa fa-refresh"></i>Actualizar Carrito</a>
                            <a href="#" data-val="{{ route('shop.checkout')}}" class="btn btn-success" id="next">Continuar con el pago <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif    
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection
@section('scripts')
{{Html::script('js/shop/shoppingCart.js')}}
@endsection
@section('partials.footer')
    @endsection