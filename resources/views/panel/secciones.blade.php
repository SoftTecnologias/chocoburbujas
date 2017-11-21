@extends('layouts.panel',['user_info' => $datos])
<!-- Secciones -->
@section('content')
    <div class="content-wrapper">
        <!-- Todo el contenido irá aquí -->
        <!-- Migajas -->
        <section class="content-header">
            <h1>
                Secciones
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="#"><i class="fa fa-users"> Secciones</i></a></li>
            </ol>
        </section>
        <!-- Formularios y mas -->
        <section class="content">
            <div class="class-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            Configuración de secciones
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="model-body">
                            <form class="form-horizontal">
                                <fieldset>
                                  @foreach($secciones as $seccion)
                                      <!-- Form Name -->
                                          <legend id="{{trim($seccion->seccion)}}-title">{{$seccion->nombre}}</legend>
                                          <input id="{{trim($seccion->seccion)}}-id" type="text" class="hidden" value="{{$seccion->id}}">
                                          <div class="alert hidden" id="{{trim($seccion->sesion)}}-msg">
                                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                              <strong id="{{trim($seccion->seccion)}}-strong"></strong><p id="{{trim($seccion->seccion)}}-content"></p>
                                          </div>
                                          <!-- Text input-->
                                          <div class="form-group">
                                              <label class="col-md-4 control-label" for="{{trim($seccion->seccion)}}-nombre">Nombre de la seccion</label>
                                              <div class="col-md-4">
                                                  <input id="{{trim($seccion->seccion)}}-nombre" name="{{trim($seccion->seccion)}}-nombre" type="text" class="form-control input-md" value="{{$seccion->nombre}}">

                                              </div>
                                          </div>
                                          <!-- Multiple Radios -->
                                          <div class="form-group">
                                              <label class="col-md-4 control-label" for="activo">Sección Activa</label>
                                              <div class="col-md-4">
                                                 <label for="activo-0">
                                                    <input type="checkbox" name="{{trim($seccion->seccion)}}-activo" id="{{trim($seccion->seccion)}}-activo" {{($seccion->activo)? 'checked="checked"' : ''}}>
                                                 </label>


                                              </div>
                                          </div>

                                          <!-- Prepended checkbox -->
                                          <div class="form-group">
                                              <label class="col-md-4 control-label" for="">Tamaño de la sección</label>
                                              <div class="col-md-4">
                                                  <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" {{ ($seccion->setHeight) ? "checked='checked'":'' }} id="{{trim($seccion->seccion)}}-setHeight" name="{{trim($seccion->seccion)}}-setHeight">
                                                </span>
                                                      <input id="{{trim($seccion->seccion)}}-height" name="{{trim($seccion->seccion)}}-height" class="form-control" type="number" min="1"placeholder="" value="{{$seccion->height}}">
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- Button -->
                                          <div class="form-group">
                                              <div class="col-md-4">
                                                  <a href="#" id="{{trim($seccion->seccion)}}-boton" name="{{trim($seccion->seccion)}}-boton" class="btn btn-primary Btn-seccion" data-val="{{trim($seccion->seccion)}}">Guardar Cambios</a>
                                              </div>
                                          </div>

                                  @endforeach
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')

    <script src="{{asset('js/admin/secciones.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
@endsection