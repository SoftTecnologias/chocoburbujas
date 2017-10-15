@extends('layouts.admin')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('styles')
    <style type="text/css">
        #statuserror {
            color: red;
            font-weight: bold;
            padding: 4px;
            text-transform: uppercase;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: xx-small;
        }
    </style>
    @endsection

@section('content')
    <div class="login-box" align="center">

            <img src="{{asset('images/logo.png')}}" alt="User Image" class="user-image"/>
        <div class="encabezado">
            <a href="">Panel Administrativo <b>Chocoburbujas</b> </a>

        </div><!-- /.login-logo -->
    </div>

        <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Iniciar sesión</div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="">
                                </div>
                                <div class="col-md-6 col-md-offset-4">
                                    <label id="statuserror" name="statuserror" ></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="test" name="test" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
    @endsection