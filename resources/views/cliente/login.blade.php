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
				 <a class="acount-btn" href="#">Crear una cuenta</a>
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
				<form action="{{route('cliente.login')}}" method="post">
					{!! csrf_field()!!}
					<div>
					<span>Correo Electronico<label>*</label></span>
					<input type="email" name="email" id="email">
				  </div>
				  <div>
					<span>Contraseña<label>*</label></span>
					<input type="password" name="password" id="password">
				  </div>
				  <a class="forgot" href="#">¿Olvidaste tu contraseña?</a>
					<br>
				  <input type="submit" value="Iniciar Sesion">

					</form>
			   </div>	
			   <div class="clearfix"> </div>
		</div>
	 </div>
</div>
@endsection