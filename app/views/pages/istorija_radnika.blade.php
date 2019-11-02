<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

	<!-- Include Date Range Picker -->
	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script> -->
{{ HTML::script('js/datepicker1.js') }}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<?php $text = AdminOptions::lang(204, Session::get('jezik.AdminOptions::server()'));
$izbor = 2; $pom = 1; $opcija = [0]; ?>
@include('pages.home');
@if (Session::has('Message'))
	<br>
	<center>
		<div class="alert alert-danger" style="width: 500px; font-size: 15pt;">
			{{ Session::get('Message') }}
		</div>
	</center>
@endif
<br>
<div class="sviRadnici">
	@if(!empty($istorija))
		{{ Radnici::find($radnik->id)->ime }} {{ Radnici::find($radnik->id)->prezime }}
	@else
		@foreach($radnici as $radnik)	
			@if($radnik->aktivan == 0)
				<a href="/istorija_radnik1/{{ $radnik->id }}" class="btn " style="opacity: 0.3; color: red;">{{ Radnici::find($radnik->id)->ime }} {{ Radnici::find($radnik->id)->prezime }}</a>
			@else		
				<a href="/istorija_radnik1/{{ $radnik->id }}" class="btn ">{{ Radnici::find($radnik->id)->ime }} {{ Radnici::find($radnik->id)->prezime }}</a>
			@endif
		@endforeach
	@endif
</div>
@if(!empty($istorija))
	<div style="position: relative; margin-left: 276px; width: 214px;">		
		<form action="/istorija_datum" method="post">
			<div class="input-group" data-provide="fecha-default">
				<span class="input-group-addon"><i style="font-size: 1.5rem; height: 5px;" class="fa fa-calendar"></i></span>
				<input title="Fecha derivacion"  name="pocetni" id="datepicker" class="form-control input-sm datepicker" type="text" name="pocetni"  size="30" placeholder="{{ AdminOptions::lang(205, Session::get('jezik.AdminOptions::server()')) }}" required>
			</div>
			<div class="input-group" data-provide="fecha-default" style="position: relative; left: 250px; margin-top: -30px">
				<span class="input-group-addon"><i style="font-size: 1.5rem; height: 5px;" class="fa fa-calendar"></i></span>
				<input title="Fecha derivacion"  name="krajnji" id="fechasiniestro" class="form-control input-sm datepicker" type="text" name="krajnji" size="30" placeholder="{{ AdminOptions::lang(206, Session::get('jezik.AdminOptions::server()')) }}">
			</div><br>
			<input type="hidden" name="radnik" value="{{ $radnik->id }}">
			<input type="submit" class="btn btn-success" value="{{ AdminOptions::lang(167, Session::get('jezik.AdminOptions::server()')) }}">
		</form>
	</div>
@endif
<script type="text/javascript">
 $(document).ready(function(){
   
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            
            todayHighlight: true,
            autoclose: true,
        })


    $('#fechasiniestro').datepicker({
            format: 'D/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        })



    })
	
</script>
