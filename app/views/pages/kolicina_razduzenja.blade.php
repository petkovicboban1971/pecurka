  
{{ HTML::style('css/alertify.core.css') }}
{{ HTML::style('css/alertify.default.css') }}
{{ HTML::script('js/alertify.js') }}

<?php $text = AdminOptions::lang(150, Session::get('jezik.AdminOptions::server()'));
$izbor = 2; $pom = 1; $opcija = [0]; ?>
@include('pages.home')

<!-- 
{{ HTML::style('css/bootstrap.min.css') }}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
{{ HTML::script('js/jquery-3.4.1.min.js') }}
{{ HTML::script('js/3.4.0.bootstrap.min.js') }} -->


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @if(!empty(Session::get('msg')))
        <script>
            alertify.error( "<?php echo Session::get('msg') ?>"  );
        </script>
        <?php Session::forget('msg');  ?>
    @endif

<div class="sviRadnici">
<br>
	<form method="post" action="/razduzenjeRadnika2">
	<div class="container">
		<div class="row">
		    <div class="col-8 col-md-4">
				<select class="kupac custom-select" name="kupac" id="gender1">	
					<option value="0" selected disabled>
						{{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}
					</option>       			
					<option value="-1">
						{{ AdminOptions::lang(183, Session::get('jezik.AdminOptions::server()')) }}
					</option>
					<option value="-2">
						{{ AdminOptions::lang(184, Session::get('jezik.AdminOptions::server()')) }}
					</option>
					@foreach(DB::table('kupci')->get() as $kupac)
						<option value="{{ $kupac->id }}">
							{{ $kupac->naziv }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="col-8 col-md-4">
				<select class="nacin custom-select" name="nacin" id="gender1" required disabled>
					<option value="0" selected disabled>{{ AdminOptions::lang(180, Session::get('jezik.AdminOptions::server()')) }}</option>
					<option value="1">{{ AdminOptions::lang(181, Session::get('jezik.AdminOptions::server()')) }}</option>
					<option value="2">{{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}</option>
					<option value="3">{{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}</option>
					<option value="-1">{{ AdminOptions::lang(201, Session::get('jezik.AdminOptions::server()')) }}</option>    		
				</select>
			</div>
			<div class="col-8 col-md-4">
				<input type="text" id="gender1" class="kolicina" name="novaKolicina"  placeholder="{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}" required disabled>
				<input type="hidden" name="izbor" value="{{ $novi->id }}">
				<input type="hidden" name="proizvod" value="{{ $novi->proizvod }}">
				<input type="hidden" name="radnik" value="{{ $novi->radnik_id }}">
			</div>
		</div>
	</div>
	<center>
    	<button type="submit" class="btn btn-success btn1" disabled>{{ AdminOptions::lang(185, Session::get('jezik.AdminOptions::server()')) }}</button>
    </center>		
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
/*
		$('#razduzenjeModal').on('show.bs.modal', function(e) {
		    var kolicina = $(e.relatedTarget).data('kolicina');
		    $(e.currentTarget).find('input[name="novaKolicina"]').val(kolicina);

		    var proizvod = $(e.relatedTarget).data('proizvod');
		    $(e.currentTarget).find('input[name="proizvod"]').val(proizvod);
		});
*/
		$(".kupac").change(function(e){ 
			e.preventDefault();
			if($(this).val()!="-1" || $(this).val()!="-2"){      	
				$(".nacin").removeAttr("disabled");
				$(".kolicina").removeAttr("disabled");
				$(".btn1").removeAttr("disabled");
			} 
			if($(this).val()=="-1" || $(this).val()=="-2"){      	
				$(".nacin").prop("disabled", true);
				$(".kolicina").removeAttr("disabled");
				$(".btn1").removeAttr("disabled");
			}     
		});

		/*$('.btn1').click(function(e){
			$.post('/razduzenjeRadnika2', {
				radnik: $(this).data('radnik'),
				proizvod: $(this).data('proizvod'),
				novaKolicina: $(this).data('novaKolicina'),
				kupac: $(this).val(),
				nacin: $(this).val(),
				kolicina: $(this).val()
			}, function(response){reload(true)});
		});*/

	})
</script>