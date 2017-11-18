@extends('layouts.panel',['user_info' => $datos])
<!-- Blogs -->
@section('styles')

@endsection
@section('content')
    <!-- Modal de los blogs -->
    <div id="app" class="content-wrapper">
        <section class="content-header">
            <h1> Banner </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-desktop"> Banner</i></a></li>
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
                                <a class="btn btn-success" id="btnNew"><i class="fa fa-plus"></i>Agregar Imagen</a>
                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="brand_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="blogTable" class="table table-bordered table-hover dataTable table-responsive"
                                               role="grid" aria-describedby="Marcas_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc col-sm-3" tabindex="0" aria-controls="brandTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="logo: Imagen representativa de la marca">
                                                    Imagen
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Nombre: Nombre de la marca">
                                                    Titulo
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Nombre: Nombre de la marca">
                                                    Contenido
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Nombre: Nombre de la marca">
                                                    Fecha
                                                </th>
                                                <th class="sorting_asc col-sm-3" tabindex="0" aria-controls="brandTable"
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
        <!-- formulario Blog -->
        <div class="modal" id="modalBlog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reset()"><i class="fa fa-times"></i></button>
                        <h3 id="titulo-modal"></h3>
                    </div>
                    <div class="model-body">
                        <form class="form-horizontal" enctype="multipart/form-data" id="blogForm">
                            <fieldset>
                                <!-- Text input-->
                                <input type="hidden" id="id" name="id">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="title">Titulo de la entrada:</label>
                                    <div class="col-md-5">
                                        <input id="title" name="title" placeholder="" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="description">Contenido de la entrada:</label>
                                    <div class="col-md-5">
                                        <textarea id="description" name="description" placeholder="" class="form-control input-md" required="" ></textarea>
                                    </div>
                                </div>
                                <!-- url imagen 1 -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="imgu1">url imagen :</label>
                                    <div class="col-md-5">
                                        <input id="imgu" name="imgu" placeholder="" class="form-control input-md"  type="text">
                                        <img src="" alt="" class="image img-responsive hidden" id="im1">
                                    </div>
                                </div>
                                <!-- File Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="img">Imagen Principal</label>
                                    <div class="col-md-5">
                                        <input id="img" name="img" class="file" type="file" >
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnBlog" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/admin/banner.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fileinput.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

@endsection