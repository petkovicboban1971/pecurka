<!DOCTYPE html>
<html>
	<head>
		@include('partials/header')
		<link href="{{ AdminOptions::base_url()}}css/foundation.min.css" rel="stylesheet" type="text/css" />
		<link href="{{ AdminOptions::base_url()}}css/admin.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<script src="{{ AdminOptions::base_url()}}js/jquery-1.11.2.min.js" type="text/javascript"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	</head>

	<body class="body-login">

	@if(!Session::get('jezik.AdminOptions::server()'))
	    <div class="modal fade" id="overlay" data-backdrop="static" data-keyboard="false">
	      	<div class="modal-dialog">
	        	<div class="modal-content">
	          		<div class="modal-header">
	            		<h4 class="modal-title"><center><h2><b>Izaberite jezik / Choise a language</center></h4>
	          		</div>
		          	<div class="modal-body">
		          		<form action="/pre-Welcome"  method="post">
			          		<center>
			          			<button type="submit" name="jezik" value="sr" class="btn">SRPSKI</button>
			          			<button type="submit" name="jezik" value="en" class="btn">ENGLISH</button>
			          			<button type="submit" name="jezik" value="cr" class="btn">ЋИРИЛИЦА</button>
			          		</center>
		          		</form>
		          	</div>
		       </div>
		    </div>
		</div>

	  	<script type="text/javascript">
	      	$('#overlay').modal('show');
	  	</script>
	@endif


		<div class="color-overlay-image"></div>
		<div class="login-form-wrapper">
			<div class="login-form-wrapper__box">
				<div class="form-avatar">
					<a class="logo" href="https:/www.google.com" title="Bexter Design"><img src="{{ AdminOptions::base_url()}}images\Logo1.png" alt="Bexter Design"></a>
				</div>
				<form action="{{ AdminOptions::base_url() }}admin-login-store" method="post" class="" autocomplete="off">
					<?php if (Session::get('jezik.AdminOptions::server()')) {?>
					<div class="field-group">
						<input class="login-form__input input_placeholder" placeholder="{{ AdminOptions::lang(41, Session::get('jezik.AdminOptions::server()')) }}" name="username" type="text" value="{{ Input::old('username') ? Input::old('username') : '' }}" >
					</div>
					<div class="field-group">
						<input class="login-form__input input_placeholder" id="login-pass1" placeholder="{{ AdminOptions::lang(42, Session::get('jezik.AdminOptions::server()')) }}" name="password" type="password" value="{{ Input::old('password') ? Input::old('password') : '' }}">
					</div>
						<button type="submit" class="login-form-button admin-login">{{ AdminOptions::lang(43, Session::get('jezik.AdminOptions::server()')) }}</button>
					<?php }
						else {?>
						<div class="field-group">
							<input class="login-form__input input_placeholder" type="text" >
						</div>
						<div class="field-group">
							<input class="login-form__input input_placeholder" type="text" >
						</div>

					<?php }
					?>
				</form>
				<div class="field-group error-login">
				<?php
					if($errors->first('username')){
						echo $errors->first('username');
					}elseif($errors->first('password')){
						echo $errors->first('password');
					} ?>
				</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="base_url" value="{{ AdminOptions::base_url() }}" />
	<script type="text/javascript">
		$('#login-pass2').hide();
		$("#show-pass").click(function(){
			$('#login-pass2').val($('#login-pass1').val());
			$('#login-pass2').toggle();
			$('#login-pass1').toggle();
		});
	</script>
</body>
</html>
