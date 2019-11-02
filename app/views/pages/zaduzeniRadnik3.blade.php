@include('pages.home')


{{ HTML::style('css/alertify.core.css') }}
{{ HTML::style('css/alertify.default.css') }}
{{ HTML::script('js/alertify.js') }}
{{ HTML::script('js/jquery-1.11.3.min.js') }}
{{ HTML::script('js/jquery-3.4.1.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/bootstrap-select.min.js') }}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

@if(!empty(Session::get('Success')))
    <script>
        alertify.success( "<?php echo Session::get('Success') ?>"  );
    </script>
    <?php Session::forget('Success');  ?>
@endif
@if(!empty(Session::get('Message')))
    <script>
        alertify.error( "<?php echo Session::get('Message') ?>"  );
    </script>
    <?php Session::forget('Message');  ?>
@endif

<div id="ram">
	@foreach($grupe_proizvoda as $grupa_proizvoda)
		<b>{{ $grupa_proizvoda->naziv_grupe }}</b><br>
		@foreach($proizvodi as $proizvod)
			@if($grupa_proizvoda->grupa_id == $proizvod->grupa_proizvoda)
				<button class="upisKolicine" data-id="{{ $radnik }}" data-product="{{ $proizvod->id }}" data-target="#KolicinaModal" data-toggle="modal" >
					{{ $proizvod->naziv_proizvoda }}<br>
                    @if($proizvod->tezina_pakovanja == 0)
                        ({{ proizvodi::find($proizvod->id)->kolicina_proizvoda }} kg)
                    @else
                        ({{ proizvodi::find($proizvod->id)->pakovanje }} {{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }})
                    @endif
                </button>
                <div id="KolicinaModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
                    @include('pages.KolicinaModal')
                </div> 
			@endif
		@endforeach <br>
		<hr>
	@endforeach
	<center>
        <button class="krajZaduzenja" style="width: 220px; text-align: center;">{{ AdminOptions::lang(173, Session::get('jezik.AdminOptions::server()')) }}</button>
    </center>
</div>	

<script type="text/javascript">      
    $(document).ready(function() {
        $(".upisKolicine").on('click', function(){
            $.post('/zaduzeniRadnik4', {
                Id : $(this).data('id'), 
                Product : $(this).data('product')
            });     
            $("#KolicinaModal").modal('show');
        });
        $('.krajZaduzenja').on('click', function(){
            location.href = '/krajZaduzenja';
        });
    });
</script>