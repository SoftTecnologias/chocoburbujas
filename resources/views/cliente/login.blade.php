@extends('layouts.master')

@section('title')
 Chocoburbujas: Estetica Canina, Boutique y Veterinaria 
@endsection
@section('content')
<!--Esta pantalla es de login-->
<div class="men">
	<div class="container">
	    <div class="register">
			   <div class="col-md-6 login-left">
			  	 <h3>Nuevos Clientes</h3>
				 <p>Para que pueda comprar nuestros productos. Por favor rellene nuestro formulario y ¡afiliese con nostros!  </p>
				 <a class="acount-btn" href="{{route('cliente.register')}}">Crear una cuenta</a>
			   </div>
			   <div class="col-md-6 login-right">
			  	<h3>Clientes Registrados</h3>
				<p>Si tienes una cuenta con nostros, inicia sesión.</p>
				@if(count($errors)>0)
						<div class="alert alert-danger">
								@foreach($errors-> all() as $error)
										<p>{{$error}}</p>
								@endforeach
						</div>
				@endif
				<form>
					{!! csrf_field()!!}
					<div>
					<span>Correo Electronico o Usuario<label>*</label></span>
					<input type="email" name="email" id="email">
				  </div>
				  <div>
					<span>Contraseña<label>*</label></span>
					<input type="password" name="password" id="password">
				  </div>
				  <a class="forgot" href="#">¿Olvidaste tu contraseña?</a>
					<br>


					</form>
                   <a href="#" class="acount-btn" id="btnLogin">Iniciar Sesión</a>
			   </div>	
			   <div class="clearfix"> </div>
		</div>
	 </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{asset('js/loginC.js')}}"></script>
@endsection