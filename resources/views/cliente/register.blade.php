@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias,'marcas'=> $marcas])
@endsection
@section('content')
    <!--Esta pantalla es de registro-->
    <div class="men">
        <div class="container">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            <div class="col-md-8 col-xs-offset-2">
                <form action="{{route('cliente.register')}}" method="post">
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
                        <!--Telefonos -->
                        <div class="form-group col-md-6">
                            <span>Telefono Celular </span>
                            <input type="text" id="telefono1" class="form-control" name="telefono1">
                        </div>
                        <div class="form-group col-md-6">
                            <span>Telefono Casa / Oficina </span>
                            <input type="text" id="telefono2" class="form-control" name="telefono2">
                        </div>
                        <br>
                    </div>
                    <div class="row"><br></div>
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
                        <!-- Estado -->
                        <div class="form-group col-md-6">
                            <span>Estado </span>
                            <select id="estado" name="estado" class="form-control">
                                <option value="00">Seleccione un Estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{$estado->cve_ent}}">{{$estado->nom_ent}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Municipio -->
                        <div class="form-group col-md-6">
                            <span>Municipio </span>
                            <select id="municipio" name="municipio" class="form-control">
                                <option value=""> Seleccione un estado</option>
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
                        <div class="clearfix form-group"><a class="news-letter" href="#">
                                <label class="checkbox"><input type="checkbox" name="suscrito" id="suscrito" checked=""><i> </i>Recibir
                                    notificaciones</label>
                        </div>
                    </div>
                    <div class="register-but">
                        <button type="submit" class="btn btn-success" value="submit">Concluir con el registro</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{Html::script('js/shop/registro.js')}}
@endsection
@section('partials.footer')