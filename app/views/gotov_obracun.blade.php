<style type="text/css">
	@media print{
		#printableArea{
			background-color: #fff;
			color: #000;
			padding: 30px;
		}
	}
</style>
<script type="text/javascript">
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>
<div style="float: right;">
	<button onclick="printDiv('printableArea')"><i class="fa fa-print fa-2x" aria-hidden="true"></i></button>
</div>
<br>
<div id="printableArea">
	<div style="border: 1px solid gray; padding: 5px; width: 600px; border-radius: 7px;">
		<b>{{ radnici::find($radnik)->ime }} {{ radnici::find($radnik)->prezime }}</b> &nbsp; 
		{{ AdminOptions::lang(207, Session::get('jezik.AdminOptions::server()')) }} 
		{{ date_format(date_create($pocetni), "d.m.Y.") }} - 
		{{ date_format(date_create($krajnji), "d.m.Y.") }}  
		<div style="position: relative;">
			{{ AdminOptions::lang(145, Session::get('jezik.AdminOptions::server()')) }}: 
			{{ number_format(radnici::find($radnik)->nacin_zarade,2,",",".") }} {{ Firma::valuta() }} + {{ radnici::find($radnik)->nacin_zarade1 }}%
		</div>
		@if(!null == $poslednja_isplata)
			{{ AdminOptions::lang(232, Session::get('jezik.AdminOptions::server()')) }} 
			{{ AdminOptions::lang(207, Session::get('jezik.AdminOptions::server()')) }}: 
			{{ date_format(date_create($poslednja_isplata->period_od), "d.m.Y.") }} - 
			{{ date_format(date_create($poslednja_isplata->period_do), "d.m.Y.") }} 
			{{ AdminOptions::lang(233, Session::get('jezik.AdminOptions::server()')) }} 
			{{ date_format(date_create($poslednja_isplata->created_at), "d.m.Y.") }}
		@endif
	</div>
	<div style="float: right; margin-right: 20px; ">
		{{ AdminOptions::lang(231, Session::get('jezik.AdminOptions::server()')) }}:
		<div style="background-color: green; color: #fff; padding: 5px 15px; width: 21vh; font-weight: bold;">{{ number_format($plata,2,",",".") }} {{ Firma::valuta() }}
		</div>
	</div>
	<br><br>
	@if(!null == $specifikacije)
		@for($i=0; $i < count($datumi); $i++)
			{{ date_format(date_create($datumi[$i]), "d.m.Y.") }}
			<br>
			@foreach($specifikacije as $datum)	
				@if($datum->created_at == $datumi[$i])
					{{ proizvodi::find($datum->proizvod)->naziv_proizvoda }}:  
					@if($datum->pakovanje == 0)
						{{ $datum->kolicina }}kg * {{ cene_datumi::cena_proizvoda($datum->proizvod, $datum->created_at) }} {{ Firma::valuta() }} = <u><b>{{ number_format($datum->kolicina * cene_datumi::cena_proizvoda($datum->proizvod, $datum->created_at),2,",",".") }} {{ Firma::valuta() }}</b></u> - 
						({{ number_format($datum->kolicina * cene_datumi::cena_proizvoda($datum->proizvod, $datum->created_at) * radnici::find($datum->radnik)->nacin_zarade1,2,",",".") }} {{ Firma::valuta() }})
					@else
						{{ $datum->pakovanje }} {{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }} * {{ cene_datumi::cena_proizvoda($datum->proizvod, $datum->created_at) }} {{ Firma::valuta() }} = <u><b>{{ number_format($datum->pakovanje * cene_datumi::cena_proizvoda($datum->proizvod, $datum->created_at),2,",",".") }} {{ Firma::valuta() }}</b></u> - 
						({{ number_format($datum->pakovanje * cene_datumi::cena_proizvoda($datum->proizvod, $datum->created_at) * radnici::find($datum->radnik)->nacin_zarade1,2,",",".") }} {{ Firma::valuta() }})
					@endif
					<br>
				@endif
			@endforeach
			<hr>
		@endfor	
	@else
		{{ AdminOptions::lang(234, Session::get('jezik.AdminOptions::server()')) }}
	@endif
<br>
</div>