<?php
$cookie = \Illuminate\Support\Facades\Cookie::get("cliente");
#dd($cookie);
?>
<!-- Parte de la sesion (Idioma, moneda, lista de deseos, <<iniciar sesion, nombre>>, registro)-->
<div class="header_top">
    <div class="container">
        <div class="header_top-box">
            <div class="header-top-left">
                <div class="box">
                    <select tabindex="4" id="divisa" class="dropdown drop">
                        <option value="" class="label" value="">Pesos:</option>
                        <option value="1">MXN</option>
                        <option value="2">USD</option>
                    </select>
                </div>
                <div class="box1">
                    <select tabindex="4" id="idioma" class="dropdown">
                        <option value="" class="label" value="">Español:</option>
                        <option value="1">Español</option>
                        <option value="2">Ingles</option>
                    </select>
                </div>
                <div class="clearfix" align="right"><label  style="color: white; font-size: 20px;">Hora actual:  </label> <label id="time" style="color: white; font-size: 20px;"></label></div>
            </div>

            <div class="box" align="center"></div>

            <div class="cssmenu">

                   @if( $cookie != null )
                        <ul id="sesionOpc">
                            <li><a href="{{route('cliente.profile')}}">{{$user}}</a>
                            </li>
                            <li><a href="{{route('cliente.logout')}}" id="logout">Logout</a></li>

                        </ul>
                   @else
                    <ul id="sesionOpc">
                        <div class="login">
                            <li><a href="{{route('cliente.login')}}"><i class="fa fa-sign-in"></i>
                                    <span class="hidden-xs text-uppercase">Iniciar Sesión</span></a></li>
                            <li><a href="{{route('cliente.register')}}"><i class="fa fa-user"></i> <span
                                            class="hidden-xs text-uppercase">Registrarse</span></a></li>
                        </div>
                    </ul>
                   @endif
                       <div class="" align="right">
                           <div></div>
                       </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Logo, busqueda, y carrito de compra-->
<div class="header_bottom">
    <div class="container">

        <div class="header_bottom-box">
            <div class="header_bottom_left">
                <div class="logo">
                    <a href="{{route('shop.index')}}">
                        {{ HTML::image('images/logo.png', "Logo", array('class' => 'logo')) }}
                    </a>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="header_bottom_right">
                <div class="search">
                    <form action="{{route('Producto.search')}}" method="get">
                        <input type="text" name="search" placeholder="Busca por nombre, descripcion o codigo ">
                        <input type="submit" id="busqueda" value="">
                    </form>
                </div>
                <ul class="bag">
                    <a href="#" id="cart">
                        <i class="bag_left "> <span
                                    class="badge badge-info" id="totalCart">  {{isset($cookie) ? $cookie['carrito']->cantidadProductos : '0'}}  </span></i>
                    </a>
                    <a href="{{route('shop.carrito')}}" id="cartLink">
                        <li class="bag_right">
                            <p id="tMCart">$ {{isset($cookie) ? $cookie['carrito']->total : '0.00'}} </p>
                        </li>
                    </a>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal" id="modalCart">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="cartTitle">{{isset($cookie) ? "Tu carrito de compra está vacio :( " : 'Tu carrito de compras'}}</h4>
                    </div>
                    <div class="modal-body" id="filasDetalle">
                        <ul id="detalles" class="shopping-cart-items">
                            @if(isset($cookie) )
                                <li>No hay productos disponibles</li>
                            @endif
                        </ul>

                    </div>
                    <div class="modal-footer">
                        <a href="{{route('shop.carrito')}}" class="btn btn-primary" id="checkB">checkout ( <span id="check"></span> ) </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="{{asset('/js/shop/reloj.js')}}"></script>
