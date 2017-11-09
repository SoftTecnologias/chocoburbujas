@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias, 'marcas' => $marcas])
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    {{Html::script('js/shop/checkout.js')}}
    <script type="text/javascript" src="{{asset('/js/shop/checkout.js')}}"></script>
@endsection
@section('content')
    <div class="contenido">
        <div class="container">
            <br>
            <div class="col-md-7">
                <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                <form accept-charset="UTF-8" action="{{route('payment')}}" class="require-validation"
                      data-cc-on-file="false"
                      data-stripe-publishable-key="{{config('services.stripe.key')}}"
                      id="payment-form" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$orden->id}}" name="orderid" id="orderid">
                    <div class='form-row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Nombre en Tarjeta</label> <input
                                    class='form-control' name="card_name" id="card_name" size='4' type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Numero de tarjeta</label> <input
                                    autocomplete='off' class='form-control card-number' name="card_number" id="card_number" size='20'
                                    type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                            type='text'>
                        </div>
                        <div class='col-xs-4 form-group expiration required'>
                            <label class='control-label'>Expiración</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                        </div>
                        <div class='col-xs-4 form-group expiration required'>
                            <label class='control-label'> </label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12'>
                            <div class='form-control total btn btn-info'>
                                Total: <span class='amount'>${{$orden->total}}</span>
                            </div>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <button class='form-control btn btn-primary submit-button'
                                    type='submit' style="margin-top: 10px;">Pay »</button>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Por favor corrija los errores para continuar
                                again.</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
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
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    {{Html::script('js/shop/checkout.js')}}
@endsection
