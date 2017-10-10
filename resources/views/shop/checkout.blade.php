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
<div class="container">
    <div class="centered title"><h1>Formulario pago</h1></div>
</div>
<hr class="featurette-divider">
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="tab-content">
                <div id="stripe" class="tab-pane fade in active">
                    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                    <form accept-charset="UTF-8" action="/" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
                        <br>
                        <div class='form-row'>
                            <div class='form-group required'>
                                <div class='error form-group hide'>
                                    <div class='alert-danger alert'>
                                        Please correct the errors and try again.

                                    </div>
                                </div>
                                <label class='control-label'>Nombre en tarjeta</label>
                                <input class='form-control' size='4' type='text' id="nombre" name="nombre">
                            </div>

                        </div>
                        <div class='form-row'>
                            <div class='form-group card required'>
                                <label class='control-label'>Numero de tarjeta</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text' id="number" name="number">
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group card required'>
                                <label class='control-label'>Dirección de facturación</label>
                                <input autocomplete='off' class='form-control' size='20' type='text' id="direccion" name="direccion">
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' id="cvc" name="cvc" placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class='form-group expiration required'>
                                <label class='control-label'>Mes de expiración</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' id="mes" name="mes" type='text'>
                            </div>
                            <div class='form-group expiration required'>
                                <label class='control-label'>Año de expiración</label>
                                <input class='form-control card-expiry-year' placeholder='YY' name="año" id="año" size='4' type='text'>
                            </div>
                        </div>

                    </form>
                    <div class='form-row'>
                        <div class='form-group'>
                            <label class='control-label'></label>

                            <button class='form-control btn btn-primary' id="continuar" type='submit'> Continue →</button>

                </div>
            </div>

        </div>

        <div id="paypal" class="tab-pane fade">
            <form action="?" id="paypalForm" method="POST">
                <div class="paypalResult"><!-- content will load here --></div>
                <br>
                <input type="hidden" id="action" value="paypal"></input>
                <input type="hidden" id="token" value="token-supersecuretoken123123123"></input>
                <a href="#paypal"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="paypal" width="100%"></a>
                <br><br><br>
                <a class='btn btn-primary' id="continuar" name="continuar" type='submit'> Continuar →</a>
            </form>
        </div>
    </div>



</div>

<div class="col-sm-6">
    <label class='control-label'></label><!-- spacing -->

    <div class="alert alert-info">Por favor seleccione el metodo de pago que deseé.</div>
<br>
<div class="btn-group-vertical btn-block">
    <a class="btn btn-default" style="text-align: left;" data-toggle="tab" href="#stripe">Tarjeta de credito</a>
    <a class="btn btn-default" style="text-align: left;" data-toggle="tab" href="#paypal">PayPal</a>
</div>

<br><br><br>

<div class="jumbotron jumbotron-flat">
    <div class="center"><h2><i>Pago a realizar:</i></h2></div>
    <div class="paymentAmt"><h3>${{$total}}</h3></div>



</div>



<br><br><br>
</div>



</div>



</div>
</div>


</form>

@endsection
