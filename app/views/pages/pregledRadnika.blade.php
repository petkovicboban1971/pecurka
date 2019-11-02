<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php $text = AdminOptions::lang(140, Session::get('jezik.AdminOptions::server()')) ?>
@include('pages.home')
@if (Session::has('Message'))
	<br>
	<center>
		<div class="alert alert-danger" style="width: 500px; font-size: 15pt;">{{ Session::get('Message') }}</div>
	</center>
@endif
<br>
<div id="main-pregRad">
	<div style="margin-top: 70px;">
	    {{ AdminOptions::lang(60, Session::get('jezik.AdminOptions::server()')) }}
	    <br><br>
		@foreach(Radnici::radnik() as $radnik)		
			<form action="/zaduzeni-radnik">
				<button  class="btn btn-danger" style="width: 200px; padding: 5px; margin: 5px; font-size: 14pt;"> {{ $radnik->ime }} {{ $radnik->prezime }}</button><br>
				<input type="hidden" name="radnik" value="{{ $radnik->id }}">
			</form>
		@endforeach
	</div>
</div>	
</body>
</html>