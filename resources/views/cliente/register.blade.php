@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias,'marcas'=> $marcas])
@endsection
@section('styles')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--Esta pantalla es de registro-->
    <div class="men">
        <div class="container">
            @if ($error==true)
                <div class="alert alert-info">{{$msg['mensage']}}</div>
            @endif
                <a href="{{route('shop.index')}}" id="redireccion" hidden></a>
            <div class="col-md-8 col-xs-offset-2">
                <form id="formReg">
                    <!-- información del usuario -->

                    <div class="row">
                        <!-- Nombre de usuario -->
                        <div class="form-group col-md-4">
                            <span>Nombre:</span>
                            <input type="text" id="nombre" class="form-control" name="nombre">
                        </div>
                        <!-- Apellidos -->
                        <div class="form-group col-md-4">
                            <span>Apellido Paterno </span>
                            <input type="text" id="ape_pat" class="form-control" name="ape_pat">
                        </div>
                        <div class="form-group col-md-4">
                            <span>Apellido Materno </span>
                            <input type="text" id="ape_mat" class="form-control" name="ape_mat">
                        </div>
                    </div>
                        <!--Telefonos -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span>Telefono Celular </span>
                            <input type="text" id="telefono1" class="form-control" name="tele1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <span>Telefono Casa / Oficina </span>
                            <input type="text" id="telefono2" class="form-control" name="tele2">
                        </div>
                    </div>

                    <!-- Dirección del cliente-->
                    <div class="row">
                        <!-- Calle -->
                        <div class="form-group col-md-6">
                            <span>Calle </span>
                            <input type="text" id="calle" class="form-control" name="calle">
                        </div>
                        <!-- Numero interior y/o exterior -->
                        <div class="form-group col-md-3">
                            <span>Numero interior </span>
                            <input type="text" id="numero_int" class="form-control" name="numero_int">
                        </div>
                        <div class="form-group col-md-3">
                            <span>Numero Exterior </span>
                            <input type="text" id="numero_ext" class="form-control" name="numero_ext">
                        </div>
                    </div>
                    <div class="row">
                        <!-- Colonia -->
                        <div class="form-group col-md-9">
                            <span>Colonia </span>
                            <input type="text" id="colonia" class="form-control" name="colonia">
                        </div>
                        <!-- Codigo Postal -->
                        <div class="form-group col-md-3">
                            <span>Codigo Postal </span>
                            <input type="text" id="cp" class="form-control" name="cp">
                        </div>
                    </div>
                    <div class="row">
                        <!-- Estado -->
                        <div class="form-group col-md-6">
                            <span>Estado </span>
                            <select id="estado" name="estado" class="form-control">
                                <option value="00">Seleccione un Estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Municipio -->
                        <div class="form-group col-md-6">
                            <span>Municipio </span>
                            <select id="municipio" name="municipio" class="form-control">
                                <option value="00"> Seleccione un Municipio</option>
                            </select>
                        </div>
                    </div>
                    <!-- Informacion de la cuenta -->
                    <div class="row">
                        <!-- Nombre de usuario -->
                        <div class="form-group col-md-6">
                            <span>Nombre de Usuario </span>
                            <input type="text" id="username" class="form-control" name="username">
                        </div>
                        <!-- Correo Electronico -->
                        <div class="form-group col-md-6">
                            <span>Correo Electronico<label>*</label></span>
                            <input type="text" id="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="row">
                        <!--confirmación de la contraseña -->
                        <div class="form-group col-md-8">
                            <span>Contraseña<label>*</label></span>
                            <input type="password" id="password" class="form-control" name="password">
                        </div>
                        <div class="form-group col-md-8">
                            <span>Confirme la contraseña <label>*</label></span>
                            <input type="password" id="password_confirmation" class="form-control"
                                   name="password_confirmation">
                        </div>
                        <form id="imagen">
                        <div class="form-group col-md-8">
                            <label for="photo">Foto:</label>
                            <input id="photo" name="photo" type="file" class="file" value="test">
                        </div>
                        </form>
                        <div class="clearfix form-group"><a class="news-letter" href="#">
                                <label class="checkbox"><input type="checkbox" name="suscrito" id="suscrito" checked=""><i> </i>Recibir
                                    notificaciones</label></a>
                        </div>

                    </div>

                    {{csrf_field()}}

                </form>
                <div>
                    <a class="btn btn-success" id="guardarcli">Concluir con el registro</a>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script src="{{asset('/js/fileinput.min.js')}}" type="text/javascript"></script>
    {{Html::script('js/shop/registro.js')}}
@endsection
