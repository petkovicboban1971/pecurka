<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
@include('pages.home')
<div class="sviRadnici">
	@if(empty($data))
		<form method="post" action="/zaduzenje_radnika23">
			<div style="display: inline-flex;">
			<select class="radnik" name="radnik">
				<option selected disabled>
					{{ AdminOptions::lang(60, Session::get('jezik.AdminOptions::server()')) }}
				</option>
				@foreach($radnici as $radnik)
					<option value="{{$radnik->id}}">
						{{ $radnik->prezime }} {{ $radnik->ime }}
					</option>
				@endforeach
			</select>
			<select class="magacin" name="magacin" disabled>	
				<option selected disabled>
					{{ AdminOptions::lang(252, Session::get('jezik.AdminOptions::server()')) }}:
				</option>
				@foreach($magacini as $magacin)
					<option value="{{$magacin->id}}">
						{{ $magacin->naziv }}
					</option>
				@endforeach
			</select>
			</div>
		</form>
	@endif
	<select class="proizvod" name="proizvod" disabled>	
		<option selected disabled>
			{{ AdminOptions::lang(122, Session::get('jezik.AdminOptions::server()')) }}:
		</option>
		@foreach($proizvodi as $proizvod)
			<option value="{{$proizvod->id}}">
				{{ $proizvod->naziv_proizvoda }}
			</option>
		@endforeach
	</select>
	<input class="kolicina" type="number" min="0.001" name="kolicina" placeholder="{{ AdminOptions::lang(123, Session::get('jezik.AdminOptions::server()')) }}" disabled />
	<button class="btn btn-success dugme" disabled>{{ AdminOptions::lang(167, Session::get('jezik.AdminOptions::server()')) }}</button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		/*$('.radnik').on('change', function(e){ 
            e.preventDefault(); 
            $(".magacin").removeAttr("disabled");
		});*/
		$('.magacin').on('change', function(e){ 
            e.preventDefault(); 
            $(".proizvod").removeAttr("disabled");
		});
		$('.proizvod').on('change', function(e){ 
            e.preventDefault(); 
            $(".kolicina").removeAttr("disabled");
		});
		$('.kolicina').on('keyup', function(e){ 
            e.preventDefault(); 
            $(".dugme").removeAttr("disabled");
		});

		$('.radnik').on('change', function(e){
            e.preventDefault();
            $(".magacin").removeAttr("disabled");
            $(".radnik").prop("disabled", true);
			var radnik = $('.radnik').val();
            $.ajax({
			    type: "post",
			    url: "/zaduzenje_radnika3",
			    data: {
			        radnik: radnik
			    },
			    success: function(data) {/*										location.reload(true);*/
			    }
			})
		});

		$('button').click(function(e){ 
            e.preventDefault(); 
			var magacin = $('.magacin').val();
			var proizvod = $('.proizvod').val();
			var kolicina = $('.kolicina').val();
			$.ajax({
			    type: "post",
			    url: "/zaduzenje_radnika3",
			    data: {
			        radnik: radnik,
			        magacin: magacin,
			        proizvod: proizvod,
			        kolicina: kolicina
			    },
			    success: function(data) {										location.reload(true);
			    }
			})
		});
	/*window.onbeforeunload = function(){
	    return 'Are you sure you want to leave?';
	};*/
	function goodbye(e) {
	    if(!e) e = window.event;
	    //e.cancelBubble is supported by IE - this will kill the bubbling process.
	    e.cancelBubble = true;
	    e.returnValue = 'You sure you want to leave?'; //This is displayed on the dialog

	    //e.stopPropagation works in Firefox.
	    if (e.stopPropagation) {
	        e.stopPropagation();
	        e.preventDefault();
	    }
	}
	window.onbeforeunload=goodbye; 
});

</script>
</body>
</html>