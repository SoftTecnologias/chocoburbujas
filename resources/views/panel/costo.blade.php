@extends('layouts.panel',['user_info' => $datos])
<!-- Costos -->
@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Todo el contenido irá aquí -->
        <!-- Migajas -->
        <section class="content-header">
            <h1>
                Costos de Envio
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-users"> Costo de Envio</i></a></li>
            </ol>
        </section>
        <!-- Formularios y mas -->
        <section class="content">
            <div class="class-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h3 class="box-title">Costos de envio</h3>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" id="btnNew"><i class="fa fa-plus"></i>Agregar nuevo costo</a>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="cost_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="costTable" class="display nowrap table table-bordered table-hover dataTable table-responsive "
                                           role="grid" aria-describedby="cost_info" width="100%" >
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc " tabindex="0"
                                                aria-controls="costTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Estado">
                                                Estado
                                            </th>
                                            <th class="sorting_asc " tabindex="0"
                                                aria-controls="costTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Muncipio">
                                                Municipio
                                            </th>
                                            <th class="sorting_asc " tabindex="0"
                                                aria-controls="costTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Costo Envio">
                                                Costo Envio
                                            </th>
                                            <th class="sorting_asc " tabindex="0" aria-controls="costTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Acciones">
                                                Acciones
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="{{asset('js/admin/costos.js')}}"></script>
@endsection