 <!-- Parte de la sesion (Idioma, moneda, lista de deseos, <<iniciar sesion, nombre>>, registro)-->
    <div class="header_top">
        <div class="container">
            <div class="header_top-box">
                <div class="header-top-left">
                    <div class="box">
                        <select tabindex="4" id="divisa" class="dropdown drop">
					                 <option value="" class="label" value="">Pesos: </option>
				                   <option value="1">MXN</option>
				                   <option value="2">USD</option>
					              </select>
                    </div>
                    <div class="box1">
                        <select tabindex="4" id="idioma" class="dropdown">
							             <option value="" class="label" value="">Español: </option>
							             <option value="1">Español</option>
							             <option value="2">Ingles</option>
					              </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="cssmenu">

                  @if(!auth()->guard('cliente')->guest())
                        <ul id="sesionOpc">
                            <li><a href="#">Mi lista de deseos</a></li>
                            <li><a href="{{route('cliente.profile')}}">{{auth()->guard('cliente')->user()->username}} </a></li>
                            <li><a href="{{route('cliente.logout')}}">Logout</a></li>
                        </ul>
                  @else
                        <ul id="sesionOpc">
                            <li><a href="{{route('cliente.login')}}">Iniciar Sesión</a></li>
                            <li><a href="{{route('cliente.register')}}">Registrar</a></li>
                        </ul>

                    @endif
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
                        <a href="index.html"><img src="images/logo.png" class="logo" /></a>
                    </div>
                    <ul class="clock">
                        <i class="clock_icon"> </i>
                        <li class="clock_desc">Justo 24/h</li>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
                <div class="header_bottom_right">
                    <div class="search">
                      <form class="" action="index.html" method="post">
                        <input type="text" value="Busca tus productos favoritos aquí!" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Busca tus productos favoritos aquí!';}">
                        <input type="submit" value="">
                      </form>
                    </div>
                    <ul class="bag">
                        <a href="#"><i class="bag_left "> </i></a>
                        <a href="#">
                            <li class="bag_right">
                                <p>0.00 $</p>
                            </li>
                        </a>
                        <div class="clearfix"> </div>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
