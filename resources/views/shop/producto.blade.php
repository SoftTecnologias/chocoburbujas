@extends('layouts.master')
@section('title')
    Chocoburbujas: Estetica Canina, Boutique y Veterinaria
@endsection
@section('menu')
    @include('partials.menu',['categorias'=>$categorias,'marcas'=> $marcas])
@endsection
@section('content')

@endsection
@section('scripts')

@endsection
@section('partials.footer')