@extends('layouts.panel',['user_info' => $datos])
<!-- Secciones -->
@section('content')
    <div class="content-wrapper">
        <!-- Todo el contenido irá aquí -->
        <!-- Migajas -->
        <section class="content-header">
            <h1>
                Información de la empresa
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-users"> Información de la empresa</i></a></li>
            </ol>
        </section>
        <!-- Formularios y mas -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                Información de la empresa
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="model-body">
                                <form class="form-horizontal">
                                    <fieldset>

                                        <!-- Form Name -->
                                        <legend>Redes sociales</legend>
                                        <input type="hidden" id="id" name="id">
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">facebook</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="https://www.facebook.com/..."
                                                       class="form-control input-md" value="{{$info->facebookUrl}}">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Twitter</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="https://twitter.com/.."
                                                       class="form-control input-md" value="{{$info->twitterUrl}}">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Google +</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="https://plus.google.com/..."
                                                       class="form-control input-md" value="{{$info->googleUrl}}">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Skype</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="https://www.skype.com/..."
                                                       class="form-control input-md" value="{{$info->skypeUrl}}">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Correo
                                                Electronico</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="correo@ejemplo.com"
                                                       class="form-control input-md" value="{{$info->email}}">

                                            </div>
                                        </div>
                                        <legend>Dirección</legend>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Dirección Linea
                                                1</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text"
                                                       placeholder="calle y numero" class="form-control input-md" value="{{$info->direccion1}}">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Dirección Linea
                                                2</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="Colonia"
                                                       class="form-control input-md" value="{{$info->direccion2}}">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textinput">Telefono 1</label>
                                            <div class="col-md-4">
                                                <input id="textinput" name="textinput" type="text" placeholder="111-111-11-11"
                                                       class="form-control input-md" value="{{$info->telefono1}}">

                                            </div>
                                        </div>

                                        <!-- Password input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="passwordinput">Telefono 2</label>
                                            <div class="col-md-4">
                                                <input id="passwordinput" name="passwordinput" type="password"
                                                       placeholder="111-111-11-11" class="form-control input-md" value="{{$info->telefono2}}">

                                            </div>
                                        </div>
                                        <legend>Acerca de nosotros</legend>
                                        <!-- Textarea -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="textarea">Acerca de
                                                Nosotros</label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" id="textarea" name="textarea">{{$info->nosotros}}</textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <a href="#" id=btn-save"  class="btn btn-primary" >Guardar Cambios</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/admin/secciones.js')}}"></script>
@endsection