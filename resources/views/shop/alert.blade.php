@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas' => $marcas])
@endsection
@section('content')
    <div class="contenido">
        <div class="container">
            <div class="jumbotron">
                <h1>¡UPS!</h1>
                <p>
                    Por el momento no contamos con envio para tu ciudad,
                    en breves momentos nos pondremos en contacto con usted,
                    para determinar los detalles del envio.
                    Lamentamos las molestias y estamos trabajando para ofrecerle un mejor servicio
                </p>
                <p>¿ Desea continuar con su pedido ?</p>
                <a href="{{route('shop.makeOrder')}}" class="btn btn-primary">Si, Espero el contacto</a>
                <a herf="{{route('shop.cancelOrder')}}" class="btn btn-danger">No, cancelar envio</a>
            </div>
        </div>
    </div>


@endsection
@section('partials.footer')