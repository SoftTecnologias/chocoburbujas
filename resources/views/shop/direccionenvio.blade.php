@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas' => $marcas])
@endsection
@section('content')
    <!-- Esta parte es la que siempre va a variar
      Pero por ahora dejaré el index fijo-->
<div id="contenido">
    <div class="container">
        <form>
            <div class="row">
                <div class="clearfix form-group"><a class="news-letter" href="#">
                        <label class="checkbox"><input type="checkbox" name="direccion" id="direccion" checked><i> </i>Usar mi dirección</label></a>
                </div>
            </div>
            <!-- Dirección del cliente-->
            <div class="row">
                <!-- Calle -->
                <div class="form-group col-md-6">
                    <span>Calle </span>
                    <input type="text" id="calle" class="form-control" name="calle" value="{{$direccion->calle}}">
                </div>
                <!-- Numero interior y/o exterior -->
                <div class="form-group col-md-3">
                    <span>Numero interior </span>
                    <input type="text" id="numero_int" class="form-control" name="numero_int" value="{{$direccion->numero_int}}">
                </div>
                <div class="form-group col-md-3">
                    <span>Numero Exterior </span>
                    <input type="text" id="numero_ext" class="form-control" name="numero_ext" value="{{$direccion->numero_ext}}">
                </div>
            </div>
            <div class="row">
                <!-- Colonia -->
                <div class="form-group col-md-9">
                    <span>Colonia </span>
                    <input type="text" id="colonia" class="form-control" name="colonia" value="{{$direccion->colonia}}">
                </div>
                <!-- Codigo Postal -->
                <div class="form-group col-md-3">
                    <span>Codigo Postal </span>
                    <input type="text" id="cp" class="form-control" name="cp" value="{{$direccion->cp}}">
                </div>
            </div>
            <div class="row">
                <!-- Estado -->
                <div class="form-group col-md-6">
                    <span>Estado </span>
                    <select id="estado" name="estado" class="form-control">
                        <option value="00">Seleccione un Estado</option>
                        @foreach($estados as $estado)
                            @if($estado->id == $direccion->estado)
                                <option value="{{$estado->id}}" selected> {{$estado->nombre}}</option>
                            @else
                                <option value="{{$estado->id}}" > {{$estado->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- Municipio -->
                <div class="form-group col-md-6">
                    <span>Municipio </span>
                    <select id="municipio" name="municipio" class="form-control">
                        <option value="00"> Seleccione un Municipio</option>
                        @foreach($municipios as $municipio)
                            @if($municipio->id == $direccion->municipio)
                                <option value="{{$municipio->id}}" selected> {{$municipio->nombre}}</option>
                            @else
                                <option value="{{$municipio->id}}" > {{$municipio->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            {{csrf_field()}}
        </form>
        <div class="box-footer">
            <div class="pull-left">
                <a href="{{ route('shop.checkout')}}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Regresar</a>
            </div>
            <div class="pull-right">
                <a href="{{ route('shop.checkout')}}" class="btn btn-success" id="next">Continuar con el metodo de pago <i class="fa fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {{Html::script('js/shop/shoppingCart.js')}}
@endsection
@section('partials.footer')