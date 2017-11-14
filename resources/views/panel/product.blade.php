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
                Productos
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-paw"> Productos</i></a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <h3 class="box-title">Productos</h3>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-warning" id="btnEnvio"><i class="fa fa-plus"></i>Costos de Envio</a>
                                <a class="btn btn-success" id="btnNew"><i class="fa fa-plus"></i>Agregar Producto</a>
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
                                        <table id="productTable" class="display nowrap table table-bordered table-hover dataTable table-responsive "
                                               role="grid" aria-describedby="productos_info" width="100%" >
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting " tabindex="0" aria-controls="productTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending" aria-label="Muestra: Imagen del producto">
                                                    Imagen Principal
                                                </th>
                                                <th class="sorting_asc" tabindex="0"
                                                    aria-controls="productTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="codigo">
                                                    Codigo
                                                </th>
                                                <th class="sorting_asc " tabindex="0"
                                                    aria-controls="productTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Nombre">
                                                    Nombre
                                                </th>
                                                <th class="sorting_asc " tabindex="0"
                                                    aria-controls="productTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Nombre">
                                                    Descripción
                                                </th>
                                                <th class="sorting_asc " tabindex="0"
                                                    aria-controls="productTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Marca">
                                                    Marca
                                                </th>
                                                <th class="sorting_asc " tabindex="0"
                                                    aria-controls="productTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Categoria">
                                                    Categoria
                                                </th>

                                                <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Precio 1">
                                                    Precio 1
                                                </th>
                                                <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Stock actual">
                                                    Existencia
                                                </th>

                                                <th class="sorting_asc " tabindex="0" aria-controls="brandTable"
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
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- Formulario de productos-->
        <div class="modal" id="modalProduct">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reset()"><i class="fa fa-times"></i></button>
                        <h3 id="titulo-modal"></h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="productForm" enctype="multipart/form-data">
                            <fieldset>
                                <!-- Text input-->
                                <input type="hidden" id="id" name="id"/>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="code">Codigo del producto:</label>
                                    <div class="col-md-5">
                                        <input id="codigo" name="codigo" placeholder="" class="form-control input-md" type="text">
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nombre">Nombre:</label>
                                    <div class="col-md-5">
                                        <input id="nombre" name="nombre" placeholder="" class="form-control input-md" type="text">
                                    </div>
                                </div>
                                <!-- Textarea -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="descripcion">Descripcion: </label>
                                    <div class="col-md-5">
                                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="brand_id">Marca:</label>
                                    <div class="col-md-5">
                                        <select id="marca_id" name="marca_id" class="form-control">
                                            <option value="">Seleccione una marca</option>
                                            @foreach($marcas as $marca)
                                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="category_id">Categoria:</label>
                                    <div class="col-md-5">
                                        <select id="categoria_id" name="categoria_id" class="form-control">
                                            <option value="">Seleccione una categoria</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="proveedor_id">Proveedor:</label>
                                    <div class="col-md-5">
                                        <select id="proveedor_id" name="proveedor_id" class="form-control">
                                            <option value="">Seleccione un proveedor</option>
                                            @foreach($proveedores as $proveedor)
                                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Precios -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="precio1">Precio 1:</label>
                                    <div class="col-md-5">
                                        <input id="precio1" name="precio1" placeholder="" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="precio2">Precio 2:</label>
                                    <div class="col-md-5">
                                        <input id="precio2" name="precio2" placeholder="" class="form-control input-md" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="unidad_id">Unidad:</label>
                                    <div class="col-md-5">
                                        <select id="unidad_id" name="unidad_id" class="form-control">
                                            <option value="">Seleccione una unidad</option>
                                            @foreach($unidades as $unidad)
                                                <option value="{{$unidad->id}}">{{$unidad->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="minimo">Stock minimo:</label>
                                    <div class="col-md-5">
                                        <input id="minimo" name="minimo" placeholder="" class="form-control input-md"  type="number" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="maximo">Stock maximo:</label>
                                    <div class="col-md-5">
                                        <input id="maximo" name="maximo" placeholder="" class="form-control input-md"  type="number" value="2">
                                    </div>
                                </div>
                                <!-- url imagen 1 -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="imgu1">url imagen 1:</label>
                                    <div class="col-md-5">
                                        <input id="imgu1" name="imgu1" placeholder="" class="form-control input-md"  type="text">
                                        <img src="" alt="" class="image img-responsive hidden" id="im1">
                                    </div>
                                </div>
                                <!-- File Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="img">Imagen Principal</label>
                                    <div class="col-md-5">
                                        <input id="img1" name="img1" class="file" type="file" >
                                    </div>
                                </div>
                                <!-- url imagen 2 -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="imgu2">url imagen 2:</label>
                                    <div class="col-md-5">
                                        <input id="imgu2" name="imgu2" placeholder="" class="form-control input-md"  type="text">
                                        <img src="" alt="" class="image img-responsive hidden" id="im2">
                                    </div>
                                </div>
                                <!-- File Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="img">Imagen 2</label>
                                    <div class="col-md-5">
                                        <input id="img2" name="img2" class="file" type="file">
                                        <img src="" alt="" class="image img-responsive hidden" id="im2">
                                    </div>
                                </div>
                                <!-- url imagen 3 -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="imgu1">url imagen 3:</label>
                                    <div class="col-md-5">
                                        <input id="imgu3" name="imgu3" placeholder="" class="form-control input-md"  type="text">
                                        <img src="" alt="" class="image img-responsive hidden" id="im3">
                                    </div>
                                </div>
                                <!-- File Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="img">Imagen 3</label>
                                    <div class="col-md-5">
                                        <input id="img3" name="img3" class="file" type="file" >
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnProduct" class="btn btn-sm btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modprecio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-times"></i></button>
                    <h3 id="titulo-modal">Precios de envio</h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="prenform" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-6" align="left">
                                    <label for="estado">Estado:</label>
                                    <div class="col-md-12"></div>
                                    <select class="selectpicker col-md-12" data-live-search="true" id="estado">
                                        <option value="00">Seleccione un Estado</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                        @endforeach
                                    </select>

                                    <br/>
                                    <label for="muni">Municipio</label>
                                    <select class="selectpicker col-md-12" data-live-search="true" id="muni">
                                        <option value="00">Seleccione un Municipio</option>
                                    </select>
                                    <br/>
                                    <label for="prenvio">Precio Envio</label> <a href="http://www.google.com.mx" target="_blank">consultar</a>
                                    <input type="text" class="form-control col-md-12" id="prenvio" name="prenvio" placeholder="Precio Envio">

                                </div>

                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnAgregar" class="btn btn-sm btn-primary" onclick="AgregarCosto()">Agregar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
    <script src="{{asset('js/admin/productos.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fileinput.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
@endsection