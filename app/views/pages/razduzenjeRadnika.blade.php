
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php $text = AdminOptions::lang(150, Session::get('jezik.AdminOptions::server()'));
$izbor = 2; $pom = 1; $opcija = [0]; ?>
@include('pages.home');
@if (Session::has('Message'))
	<br>
	<center>
		<div class="alert alert-danger" style="width: 500px; font-size: 15pt;">{{ Session::get('Message') }}</div>
	</center>
@endif
<br>
<div class="sviRadnici">
	@foreach($data as $radnik)
		@if($radnik->radnik != 0)
			<?php $pom = DB::table('upisaniproizvod')->where('parent_id', $radnik->id)
														->where('kolicina', '!=', 0)
														->get();
			?>
				@if(count($pom) > 0)
					<a href="/razduzeniRadnik/{{ $radnik->radnik }}" class="btn ">{{ Radnici::find($radnik->radnik)->ime }} {{ Radnici::find($radnik->radnik)->prezime }}</a>
				@endif
		@endif	
	@endforeach
</div>	
