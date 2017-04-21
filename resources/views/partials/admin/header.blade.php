<!-- Parte de la sesion (Idioma, moneda, lista de deseos, <<iniciar sesion, nombre>>, registro)-->
<div class="header_top">
    <div class="container">
        <div class="header_top-box">
            <div class="header-top-left">
                <div class="box1">
                    <select tabindex="4" id="idioma" class="dropdown">
                        <option value="" class="label" value="">Español:</option>
                        <option value="1">Español</option>
                        <option value="2">Ingles</option>
                    </select>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="cssmenu">
             @if(!auth()->guard('web')->guest())
                <ul id="sesionOpc">
                    <li><a href="{{route('user.profile')}}">{{auth()->guard('web')->user()->username}}</a></li>
                    <li><a href="{{route('user.logout')}}">Logout</a></li>
                </ul>
             @endif
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>
