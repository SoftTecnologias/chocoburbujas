@extends('layouts.panel',['user_info' => $datos])
@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("css/fileinput.min.css")}}" />
@endsection
<!-- Productos -->
@section('content')
    <div class="content-wrapper" id="ContenidoPrincipal">
        <!-- Todo el contenido irá aquí -->
        <section class="content-header">
            <h1>
                Promociones
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-paw"> Promociones</i></a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 class="box-title">Promociones</h3>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" id="newPromo"><i class="fa fa-plus"></i>Agregar Promocion</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="product_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="promotionTable" class="display nowrap table table-bordered table-hover dataTable table-responsive "
                                               role="grid" aria-describedby="promotion_info" width="100%" >
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc " tabindex="0"
                                                        aria-controls="productTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Nombre">
                                                        Nombre
                                                    </th>
            
                                                    <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="descipcion">
                                                        Descripción
                                                    </th>
                                                
                                                    <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="descuento">
                                                        % Descuento
                                                    </th>

                                                    <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="descipcion">
                                                        Fecha Inicial
                                                    </th>

                                                    <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="descipcion">
                                                        Fecha Final
                                                    </th>

                                                    <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Acciones">
                                                        Acciones
                                                    </th>
                                                   
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- Formulario de productos-->
    </div>

    <div class="modal" id="modalPromotion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-times"></i></button>
                    <h3 id="titulo-modal">Promocion</h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="promotionForm" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Text input-->
                            {{csrf_field()}}
                            <input type="hidden" id="promotionid" name="promotionid"/>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="namepromo">Nombre Promocion</label>
                                <div class="col-md-5">
                                    <input id="namepromo" name="namepromo" placeholder="Promocion" class="form-control input-md"
                                           required="" type="text"/>

                                </div>
                            </div>

                            <!-- url imagen 1 -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descripcionpromo">Descripcion</label>
                                <div class="col-md-5">
                                    <textarea id="descripcionpromo" name="descripcionpromo" placeholder="" class="form-control input-md"></textarea>
                                </div>
                            </div>
                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descuentopromo">Descuento</label>
                                <div class="col-md-5">
                                    <input id="descuentopromo" name="descuentopromo" placeholder="" class="form-control input-md"
                                           type="number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="fechaIpromo">Fecha Inicio</label>
                                <div class="col-md-5">
                                    <input id="fechaIpromo" name="fechaIpromo" placeholder="" class="form-control input-md"
                                           type="date">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="fechaFpromo">Fecha Vigencia</label>
                                <div class="col-md-5">
                                    <input id="fechaFpromo" name="fechaFpromo" placeholder="" class="form-control input-md"
                                           type="date">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="checkboxes">Es Promoción del mes</label>
                                <div class="col-md-4">
                                  <label class="checkbox-inline" for="is_promotion_month">
                                    <input type="checkbox" name="is_promotion_month" id="is_promotion_month" value="1">
                                    
                                  </label>
                                </div>
                              </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnAceptarPromo" class="btn btn-sm btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fileinput.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script src="{{asset('js/admin/promotion.js')}}"></script>
@endsection