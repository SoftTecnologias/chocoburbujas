@extends('layouts.master')
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas' => $marcas])
@endsection
<?php
  $est=null;
  $mun=null;
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css"
          integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/shop/profile.css')}}" type="text/css"/>

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="profile-head">
            <!--col-md-4 col-sm-4 col-xs-12 close-->
            <div class="col-md- col-sm-4 col-xs-12">
                <input type="hidden" value="{{$cliente->id}}" id="userid">
                <img src="{{asset('images/clientes/'.$cliente->img)}}" class="img-responsive"/>
                <h6>{{$cliente->nombre." ".$cliente->ape_pat.' '.$cliente->ape_mat}}</h6>
                <form id="passform">
                    <div class="form-group"style="margin-left: 90px;">
                <span class="btn btn-warning uplod-file">
                        Actualizar Foto <input type="file" id="foto" name="foto" class="input-file" accept=".jpg, .jpeg, .png"/>
                </span>
                    </div>
                </form>
            </div>
            <!--col-md-4 col-sm-4 col-xs-12 close-->

            <div class="col-md-5 col-sm-5 col-xs-12">
                <h5>{{$cliente->nombre." ".$cliente->ape_pat.' '.$cliente->ape_mat}}</h5>
                <p>Perfil del Cliente</p>
                <ul>
                    @foreach($estados as $estado)
                        <?php
                        if($cliente->estado == $estado->id){
                        $est = $estado->nombre;
                        }   ?>
                    @endforeach
                        @foreach($municipios as $municipio)
                            <?php
                            if($cliente->municipio == $municipio->id){
                           $mun = $municipio->nombre;
                            } ?>
                        @endforeach
                    <li><span class="glyphicon glyphicon-map-marker"></span> {{$est.', '.$mun}}</li>
                    <li><span class="glyphicon glyphicon-home"></span>{{'Colonia: '.$cliente->colonia.', Calle: '.$cliente->calle}}</li>
                    <li><span class="glyphicon glyphicon-asterisk"></span>{{'No Ext: '.$cliente->numero_ext}}</li>
                    <li><span class="glyphicon glyphicon-phone"></span> <a href="#" title="call">{{$cliente->telefono1}}</a></li>
                    <li><span class="glyphicon glyphicon-envelope"></span><a href="#" title="mail">{{$cliente->email}}</a></li>
                </ul>
            </div>
        </div>
        <!--profile-head close-->
    </div>
    <!--container close-->


    <br/>
    <br/>

    <div class="container">
        <div class="col-sm-8">
            <div data-spy="scroll" class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_default_1" data-toggle="tab" id="iu">Informacion de Usuario </a>
                        </li>
                        <li>
                            <a href="#tab_default_2" data-toggle="tab" id="ic">Informacion de Contacto</a>
                        </li>
                        <li>
                            <a href="#tab_default_3" data-toggle="tab" id="seg">Seguridad</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="well well-sm">
                                <h4>Informacion Perosnal</h4>
                            </div>
                            <p align="right">
                                <button type="button" class="btn btn-primary btn-sm" id="editper">
                                    <span class="glyphicon glyphicon-edit"></span> Editar</button>
                            </p>
                            <table class="table bio-table">
                                <tbody>
                                <form id="formPersonal">
                                    <tr>
                                        <td width="300">Nombre</td>
                                        <td><input type="text" value="{{$cliente->nombre}}" disabled id="nombre" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Apellido Paterno</td>
                                        <td> <input type="text" value="{{$cliente->ape_pat}}" disabled id="apellidop" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Apellido Materno</td>
                                        <td> <input type="text" value="{{$cliente->ape_mat}}" disabled id="apellidom" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td> {{$cliente->username}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tipo de Usuario</td>
                                        <td> Cliente</td>
                                    </tr>
                                </form>
                                <tr>
                                    <td width="300" hidden id="acciones"><button type="submit" class="btn btn-primary" id="guardarper">Guardar Cambios</button>
                                        <button type="submit" class="btn btn-danger" id="cancelar">Cancelar</button></td>
                                    <td></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_default_2">
                            <div class="well well-sm">
                                <h4>Informacion de Contacto</h4>
                            </div>
                            <p align="right">
                                <button type="button" class="btn btn-primary btn-sm" id="editcontact">
                                    <span class="glyphicon glyphicon-edit"></span> Editar</button>
                            </p>
                            <table class="table bio-table">
                                <tbody>
                                <form id="formContacto">
                                    <tr>
                                        <td>Estado</td>
                                        <td>  <select id="estado" name="estado" class="form-control" disabled>
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
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td>Municipio</td>
                                        <td> <select id="municipio" name="municipio" class="form-control" disabled>
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

                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Colonia</td>
                                        <td> <input type="text" value="{{$cliente->colonia}}" disabled id="colonia" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Calle</td>
                                        <td> <input type="text" value="{{$cliente->calle}}" disabled id="calle" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Numero Exterior</td>
                                        <td> <input type="text" value="{{$cliente->numero_ext}}" disabled id="noext" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Numero Interior</td>
                                        <td> <input type="text" value="{{$cliente->numero_int}}" disabled id="noint" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Codigo Postal</td>
                                        <td> <input type="text" value="{{$cliente->cp}}" disabled id="cp" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Telefono pricipal</td>
                                        <td> <input type="text" value="{{$cliente->telefono1}}" disabled id="tel" class="form-control input-md"></td>
                                    </tr>
                                    <tr>
                                        <td>Telefono secundario</td>
                                        <td> <input type="text" value="{{$cliente->telefono2}}" disabled id="tel2" class="form-control input-md"></td>
                                    </tr>

                                    <tr>
                                        <td>Email</td>
                                        <td> <input type="text" value="{{$cliente->email}}" disabled id="mail" class="form-control input-md"></td>
                                    </tr>
                                </form>
                                <tr>
                                    <td width="300" hidden id="accionesc"><button type="submit" class="btn btn-primary" id="guardarcontact">Guardar Cambios</button>
                                        <button type="submit" class="btn btn-danger" id="cancelarc">Cancelar</button></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_default_3">
                            <div class="well well-sm">
                                <h4>Seguridad</h4>
                            </div>
                            <p align="right">
                                <button type="button" class="btn btn-primary btn-sm" id='edpas'>
                                    <span class="glyphicon glyphicon-edit"></span> Editar</button>
                            </p>
                            <table class="table bio-table">
                                <tbody>
                                <form id="passwordForm">
                                    <tr>
                                        <td width="300">Contraseña Actual</td>
                                        <td><input type="password" placeholder="Contraseña Actual" id="passactual" disabled class="form-control input-md"> </td>
                                    </tr>
                                    <tr>
                                        <td>Nueva Contraseña</td>
                                        <td><input type="password" placeholder="Nueva Contraseña" id="newpass" disabled class="form-control input-md"> </td>
                                    </tr>
                                    <tr>
                                        <td>Confirmar Contraseña</td>
                                        <td><input type="password" placeholder="Confirmar Contraseña" id="confirmpass" disabled class="form-control input-md"></td>
                                    </tr>
                                </form>
                                </tbody>
                                <tfoot><tr>
                                    <td><a class="btn btn-primary" id="changepass">Cambiar Contraseña</a></td>
                                </tr></tfoot>
                            </table>
                            <br/>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="panel ">
                <div class="menu_title">
                    <h3>Compras</h3>
                    <table class="table">
                        <thead>
                        <trow>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Total</th>
                        </trow>
                        </thead>
                        <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td>{{$compra->id}}</td>
                                <td>{{$compra->fecha_venta}}</td>
                                <td>{{$compra->total}}</td>
                                <td>
                                    <a class="btn btn-warning" onclick="infocompra('{{$compra->id}}')" id="info{{$compra->id}}">Info</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class = "modal" id="modalinfo">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad" id="datos">


                    <div class="panel panel-info">
                        <div class="panel-heading">
                        <span>
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                         class="fa fa-times"></i></button>
                            <h3 class="panel-title">Info Compra</h3>
                        </span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class=" col-md-12 col-lg-12 ">
                                    <table class="table table-user-information">
                                        <thead>
                                        <tr class="active">
                                            <th>Producto</th>
                                            <th>Marca</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Total</th>
                                            <th>Moneda</th>
                                        </tr>
                                        </thead>
                                        <tbody id="info">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/shop/profile.js')}}"></script>
@endsection
