  
{{ HTML::style('css/alertify.core.css') }}
{{ HTML::style('css/alertify.default.css') }}
{{ HTML::script('js/alertify.js') }}

<?php $text = AdminOptions::lang(150, Session::get('jezik.AdminOptions::server()'));
$izbor = 2; $pom = 1; $opcija = [0]; ?>
@include('pages.home')

{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::script('js/jquery-3.4.1.min.js') }}
{{ HTML::script('js/3.4.0.bootstrap.min.js') }}

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @if(!empty(Session::get('msg')))
        <script>
            alertify.error( "<?php echo Session::get('msg') ?>"  );
        </script>
        <?php Session::forget('msg');  ?>
    @endif

    @if(!empty(Session::get('veza')))
        <script>
            alertify.success( "<?php echo Session::get('veza') ?>"  );
        </script>
        <?php Session::forget('veza');  ?>
    @endif

<div class="sviRadnici">
	@if($radnici->radnik != 0)	
		{{ Radnici::find($radnici->radnik)->ime }}		
        {{ Radnici::find($radnici->radnik)->prezime }}      
		@foreach($proizvodi as $proizvod)
			@if($proizvod->kolicina > 0)
				<a href="/razduzenje_pom/{{ $proizvod->id }}" class="btn">
					{{ proizvodi::find($proizvod->proizvod)->naziv_proizvoda }}
                    @if($proizvod->pakovanje == 0)
                        <br>({{ $proizvod->kolicina }} kg)
                    @else
                        <br>({{ $proizvod->pakovanje }} {{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }})
                    @endif
				</a>			
			    <input type="hidden" name="radnik" value="{{ $radnici->radnik }}">
			@endif
		@endforeach	
	@endif
</div>
