@extends('layouts.panel',['user_info' => $datos])
@section('styles')
    <link media="all" type="text/css" rel="stylesheet"
          href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("css/fileinput.min.css")}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<!-- Subcategorias -->
@section('content')
    <div class="content-wrapper" id="ContenidoPrincipal">
        <!-- Todo el contenido irá aquí -->
        <section class="content-header">
            <h1>
                Banner
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-paw"> Banner</i></a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 class="box-title">Banner</h3>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" id="btnNew"><i class="fa fa-plus"></i>Agregar Banner</a>
                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="product_wrapper" class="dataTables_wrapper form-inline dt-bootstrap table-layout:fixed">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="tblBanner" class="table table-bordered table-hover dataTable table-responsive"
                                               role="grid">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc col-sm-3" tabindex="0" aria-controls="brandTable"
                                                    aria-sort="ascending"
                                                    aria-label="logo: Imagen representativa del banner">
                                                </th>
                                                <th class="sorting" tabindex="1" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="titulo del banner">
                                                    Titulo
                                                </th>
                                                <th class="sorting_asc col-sm-3" tabindex="4" aria-controls="brandTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Acciones">
                                                    Acciones
                                                </th>
                                            </tr >
                                            </thead>
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
    </div>
    <!-- Modal Banner -->
    <div class="modal" id="modalBanner">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-times"></i></button>
                    <h3 id="titulo-modal"></h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="bannerForm" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Text input-->
                            {{csrf_field()}}
                            <input type="hidden" id="bannerid" name="serviceid"/>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="code">Titulo del Servicio</label>
                                <div class="col-md-5">
                                    <input id="title" name="title" placeholder="" class="form-control input-md"
                                           required="" type="text"/>

                                </div>
                            </div>

                            <!-- url imagen 1 -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="imgu">url imagen:</label>
                                <div class="col-md-5">
                                    <input id="imgu" name="imgu" placeholder="" class="form-control input-md"
                                           type="text">
                                    <img src="" alt="" class="image img-responsive hidden" id="im1">
                                </div>
                            </div>
                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="img1">Imagen</label>
                                <div class="col-md-4">
                                    <input id="img1" name="img1" class="input-file" type="file">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnAceptar" class="btn btn-sm btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/admin/banner.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fileinput.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

@endsection
