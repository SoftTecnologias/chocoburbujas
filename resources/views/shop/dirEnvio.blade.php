@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas' => $marcas])
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script src="{{asset('/js/shop/envio.js')}}" type="text/javascript"></script>
@endsection
@section('content')
<form class="form-horizontal" id="formdats">
    <fieldset>
        <!-- Form Name -->
        <!--<legend>Pre-Inscripción | Doctorado en Derecho y Ciencias Políticas </legend>-->
        <div class="alert alert-info">
            <h2 align="center">Direccion de envio</h2>
            <h5 align="center"><strong>Info!!:</strong> favor de verificar que los datos sean correctos antes de proceder</h5>
        </div>
        <div class="col-md-3"></div>

        <div class="col-md-8" align="center">

        <!-- Text input-->

        <div class="form-group col-md-12" align="center">

            <div class="col-md-4">
                <p align="left"><strong>Nombres:</strong></p>
                <input id="textNombres" name="textNombres" type="text" placeholder="Nombre" class="form-control" value="{{$cliente->nombre}}" readonly>
            </div>
            <div class="col-md-3">
                <p align="left"><strong>Apellido Paterno:</strong></p>
                <input id="txtApepat" name="txtApepat" type="text" placeholder="Apellido Paterno" class="form-control" value="{{$cliente->ape_pat}}" readonly>
            </div>
            <div class="col-md-3">
                <p align="left"><strong>Apellido Materno:</strong></p>
                <input id="txtApemat" name="txtApemat" type="text" placeholder="Apellido Materno" class="form-control" value="{{$cliente->ape_mat}}" readonly>
            </div>
            <a class="btn btn-warning" id="editar"><span class="glyphicon glyphicon-edit"></span>  Editar</a>
        </div>

        <!-- Text input-->
        <div class="form-group col-md-12">
            <div class="col-md-4">
                <p align="left"><strong>Estado:</strong></p>
                <select id="estado" name="estado" class="form-control" readonly>
                    <option value="00">Seleccione un Estado</option>
                    @foreach($estados as $estado)
                        <?php
                        if($cliente->estado == $estado->id){
                        ?>
                        <option value="{{$estado->id}}" selected>{{$estado->nombre}}</option>
                        <?php }else{?>
                        <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                        <?php } ?>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <p align="left"><strong>Municipio:</strong></p>
                <select id="municipio" name="municipio" class="form-control" readonly>
                    <option value="00"> Seleccione un Municipio</option>
                    @foreach($municipios as $municipio)
                        <?php
                        if($cliente->municipio == $municipio->id){
                        ?>
                        <option value="{{$municipio->id}}" selected>{{$municipio->nombre}}</option>
                        <?php }else{?>
                        <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
                        <?php } ?>
                    @endforeach

                </select>
            </div>
        </div>

            <div class="form-group col-md-12" align="center">
                <div class="col-md-4">
                    <p align="left"><strong>Colonia:</strong></p>
                    <input id="txtColonia" name="txtColonia" type="text" placeholder="Colonia" class="form-control" value="{{$cliente->colonia}}" readonly>
                </div>
                <div class="col-md-3">
                    <p align="left"><strong>Calle:</strong></p>
                    <input id="txtCalle" name="txtCalle" type="text" placeholder="Calle" class="form-control" value="{{$cliente->calle}}" readonly>
                </div>
            </div>
            <div class="form-group col-md-12" align="center">
                <div class="col-md-4">
                    <p align="left"><strong>Codigo Postal:</strong></p>
                    <input id="txtCp" name="txtCp" type="text" placeholder="C.P." class="form-control" value="{{$cliente->cp}}" readonly>
                </div>
                <div class="col-md-3">
                    <p align="left"><strong>Numero Interior:</strong></p>
                    <input id="txtNumInt" name="txtNumInt" type="text" placeholder="Numero Interior" class="form-control" value="{{$cliente->numero_int}}" readonly>
                </div>
                <div class="col-md-3">
                    <p align="left"><strong>Numero Exterior:</strong></p>
                    <input id="txtNumExt" name="txtNumExt" type="text" placeholder="Numero Exterior" class="form-control" value="{{$cliente->numero_ext}}" readonly>
                </div>
            </div>
            <div class="form-group col-md-12" align="center">
                <div class="col-md-4">
                    <p align="left"><strong>Correo:</strong></p>
                    <input id="txtCorreo" name="txtCorreo" type="text" placeholder="Email" class="form-control" value="{{$cliente->email}}" readonly>
                </div>
                <div class="col-md-3">
                    <p align="left"><strong>Telefono:</strong></p>
                    <input id="txtTel" name="txtTel" type="text" placeholder="Telefono" class="form-control" value="{{$cliente->telefono1}}" readonly>
                </div>
            </div>
            <div class="form-group col-md-12" align="left">
                <input type="checkbox" id="fact" name="fact" value="0"><label for="check">facturar</label>
            </div>
            <div class="form-group col-md-12 alert alert-success row" id="facturacion" align="center" hidden >
                <div class="col-md-12"><h2>Informacion de Facturacion</h2></div>
                <div class="col-md-4">
                    <p align="left"><strong>Factura a nombre de:</strong></p>
                    <input id="factnombre" name="factnombre" type="text" placeholder="Nombre Factura" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>RFC:</strong></p>
                    <input id="txtRFC" name="txtRFC" type="text" placeholder="RFC" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Pais:</strong></p>
                    <input id="factpais" name="factpais" type="text" placeholder="Pais" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Estado:</strong></p>
                    <input id="factestado" name="factestado" type="text" placeholder="Estado" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Municipio:</strong></p>
                    <input id="factmunicipio" name="factmunicipio" type="text" placeholder="Municipio" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Ciudad:</strong></p>
                    <input id="factciudad" name="factciudad" type="text" placeholder="Ciudad" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Colonia:</strong></p>
                    <input id="factcolonia" name="factcolonia" type="text" placeholder="Colonia" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Calle:</strong></p>
                    <input id="factcalle" name="factcalle" type="text" placeholder="Calle" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Numero Exterior:</strong></p>
                    <input id="factnume" name="factnume" type="text" placeholder="Numero Exterior" class="form-control" >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Numero Interior:</strong></p>
                    <input id="factnumi" name="factnumi" type="text" placeholder="Numero Interior" class="form-control" >
                </div>
                <div class="col-md-3">
                    <p align="left"><strong>Codigo Postal:</strong></p>
                    <input id="factcp" name="factcp" type="text" placeholder="C.P." class="form-control" >
                </div>
                <div class="col-md-3">
                    <p align="left"><strong>Celular:</strong></p>
                    <input id="factcelular" name="factcelular" type="text" placeholder="Celular" class="form-control" >
                </div>

                <div class="col-md-3">
                    <p align="left"><strong>Telefono fijo:</strong></p>
                    <input id="txtTel2" name="txtTel2" type="text" placeholder="Telefono fijo" class="form-control"  >
                </div>
                <div class="col-md-4">
                    <p align="left"><strong>Correo:</strong></p>
                    <input id="factcorreo" name="factcorreo" type="text" placeholder="Correo" class="form-control" >
                </div>
            </div>

            <div class="form-group " align="right">
                <a class="btn btn-success" id="continue">Continuar</a>
            </div>


        </div>


    </fieldset>
</form>
@endsection
