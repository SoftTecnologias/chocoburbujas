@extends('layouts.panel',['user_info' => $datos])
<!-- Usuarios -->
@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Todo el contenido irá aquí -->
        <!-- Migajas -->
        <section class="content-header">
            <h1>
                Usuarios
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-users"> Usuarios</i></a></li>
            </ol>
        </section>
        <!-- Formularios y mas -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 class="box-title">Usuarios</h3>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" id="btnNew"><i class="fa fa-plus"></i>Agregar Usuario</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="user_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="userTable" class="table table-bordered table-hover dataTable table-responsive"
                                               role="grid" aria-describedby="User_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc col-sm-2" tabindex="0" aria-controls="userTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Foto del usuario">
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="userTable" rowspan="1"
                                                    colspan="1" aria-label="Nombre: Nombre del usuario">
                                                    Nombre
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="userTable" rowspan="1"
                                                    colspan="1" aria-label="Apellido Paterno: apellido paterno del usuario">
                                                    Apellido Paterno
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="userTable" rowspan="1"
                                                    colspan="1" aria-label="Apellido Materno: apellido materno del usuario">
                                                    Apellido Materno
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="userTable" rowspan="1"
                                                    colspan="1" aria-label="Email: Correo del usuario">
                                                    Correo Electronico
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="userTable" rowspan="1"
                                                    colspan="1" aria-label="rol de permisos: permisos del usuario">
                                                    Rol
                                                </th>
                                                <th class="sorting_asc col-sm-3" tabindex="0" aria-controls="userTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Acciones">
                                                    Acciones
                                                </th>
                                            </tr >
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1"></th>
                                                <th rowspan="1" colspan="1">Nombre</th>
                                                <th rowspan="1" colspan="1">Apellido Paterno</th>
                                                <th rowspan="1" colspan="1">Apellido Materno</th>
                                                <th rowspan="1" colspan="1">Correo Electronico</th>
                                                <th rowspan="1" colspan="1">Rol</th>
                                                <th rowspan="1" colspan="1">Acciones</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- Formulario de usuarios-->
        <div class="modal" id="modalUser">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reset()"><i class="fa fa-times"></i></button>
                        <h3 id="titulo-modal"></h3>
                    </div>
                    <div class="model-body">
                        <form class="form-horizontal" enctype="multipart/form-data" id="userForm">
                            <fieldset>
                                <input id="id" name="id" type="hidden">
                                <!-- Text input nombre-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nombre">Nombre:</label>
                                    <div class="col-md-5">
                                        <input id="nombre" name="nombre" placeholder="" class="form-control input-md"  type="text">
                                    </div>
                                </div>
                                <!-- Text input apellido paterno-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="ape_pat">Apellido Paterno:</label>
                                    <div class="col-md-5">
                                        <input id="ape_pat" name="ape_pat" placeholder="" class="form-control input-md"  type="text">
                                    </div>
                                </div>
                                <!-- Text input apellido materno-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="ape_mat">Apellido Materno:</label>
                                    <div class="col-md-5">
                                        <input id="ape_mat" name="ape_mat" placeholder="" class="form-control input-md"  type="text">

                                    </div>
                                </div>
                                <!-- Text input email -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Correo Electronico:</label>
                                    <div class="col-md-5">
                                        <input id="email" name="email" placeholder="" class="form-control input-md"  type="email">
                                    </div>
                                </div>
                                <!-- Select Basic rol-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="rol">Rol</label>
                                    <div class="col-md-5">
                                        <select id="rol" name="rol" class="form-control">
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuario estandar</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Text input username-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="username">Nombre de Usuario:</label>
                                    <div class="col-md-5">
                                        <input id="username" name="username" placeholder="" class="form-control input-md"  type="text">
                                    </div>
                                </div>
                                <!-- Text input password-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password" >Contraseña:</label>
                                    <div class="col-md-5">
                                        <input id="password" name="password" placeholder="" class="form-control input-md"  type="password">
                                    </div>
                                </div>
                                <!-- Text input Nueva password-->
                                <div class="form-group hidden" id="npass">
                                    <label class="col-md-4 control-label" for="password" >Nueva Contraseña:</label>
                                    <div class="col-md-5">
                                        <input id="npassword" name="npassword" placeholder="" class="form-control input-md"  type="password">
                                    </div>
                                </div>
                                <!-- Text input confirmar password-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="cpassword">Confirme la contraseña:</label>
                                    <div class="col-md-5">
                                        <input id="cpassword" name="cpassword" placeholder="" class="form-control input-md" type="password">
                                    </div>
                                </div>
                                <!-- File Button imagen-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="img">Foto:</label>
                                    <div class="col-md-4">
                                        <input id="img" name="img" class="input-file" type="file">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnUser" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/admin/usuarios.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
@endsection