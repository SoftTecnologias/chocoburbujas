@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',array('categorias'=>$categorias))
@endsection
@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <form action="{{route('checkout')}}" method="post" id="checkout-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Dirección: </label>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="card-name">Titular de la tarjeta</label>
                        <input type="text" id="card-name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="card-number">Numero de la tarjeta</label>
                        <input type="text" id="card-number" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="card-expiry-month">Mes de Expiración</label>
                                <input type="text" id="card-expiry-month" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="card-expiry-year">Año de Expiración</label>
                                <input type="text" id="card-expiry-year" class="form-control" required>
                            </div>
                        </div>
      p             </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="card-cvc">CVC</label>
                        <input type="text" id="card-cvc" class="form-control" required>
                    </div>
                </div>

            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-success">Pagar ahora ${{$total}}</button>
        </form>
        <hr>
    </div>
</div>
@endsection
@section('partials.footer')