<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('/css/fileinput.min.css')}}" />
    <title>@yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		 crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.4.4/sweetalert2.min.css" />

    {{ Html::style('css/style.css') }}
    {{ Html::style('css/jquery.countdown.css') }}
    {{ Html::script('js/plugins/jquery.easydropdown.js') }}
    {{ Html::style('css/megamenu.css') }}
    {{ Html::style('css/stylecart.css') }}
    {{ Html::script('js/plugins/megamenu.js') }}
    {{ Html::script('js/plugins/responsiveslides.min.js') }}
    {{ Html::script('js/plugins/jquery.countdown.js') }}
    {{ Html::script('js/script.js') }}
    @yield('styles')
</head>
<body>
    @include('partials.header')
    @yield('menu')
    @yield('content')
    <!-- *** LOGIN MODAL ***
_________________________________________________________ -->

    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-sm">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="Login">Inicio de Sesión</h4>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group">
                            <input type="text" class="form-control" id="modalemail" placeholder="Correo Electronico">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="modalpassword" placeholder="Contraseña">
                        </div>

                        <p class="text-center">
                            <a class="btn btn-primary" id="btnLogin"><i class="fa fa-sign-in"></i> Iniciar Sesión</a>
                        </p>

                    </form>

                    <p class="text-center text-muted">¿Aun no estás registrado?</p>
                    <p class="text-center text-muted"><a href="{{route('cliente.register')}}"><strong>Registrarse ahora</strong></a>!
                        Con un registro rapido, puedes iniciar a comprar de inmediato!
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- *** LOGIN MODAL END *** -->
    @include('partials.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.4.4/sweetalert2.min.js" type="text/javascript"></script>
    <script src="{{asset('/js/loginC.js')}}" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>