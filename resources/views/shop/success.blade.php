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
            <br>
            <h1>Pago Procesado</h1>
            <p>Tu pago ha sido procesado con un numero de: {{$orden->id}}</p>
            <hr>
            <div class="col-md-7 col-md-offset-1">
                <div  id="order-summary">
                    <div class="box-header">
                        <h3>Resumen de orden</h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="summary">
                            <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <th id="subtotal">$ {{number_format($orden->subtotal, 2,".",",")}} MXN</th>
                            </tr>
                            <tr>
                                <td>Envio y entrega</td>
                                <th>$ {{number_format($orden->costo_envio, 2,".",",")}} MXN</th>
                            </tr>
                            <tr class="total">
                                <td>Total</td>
                                <th id="total">${{number_format($orden->total  , 2,".",",")}} MXN</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <a href="{{route('shop.index')}}" class="btn btn-primary">Seguir Comprando</a>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
@endsection
@section('partials.footer')