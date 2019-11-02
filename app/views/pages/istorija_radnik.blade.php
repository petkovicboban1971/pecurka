<?php $text = AdminOptions::lang(204, Session::get('jezik.AdminOptions::server()'))." ".Radnici::find($id)->ime. " ".Radnici::find($id)->prezime;
$izbor = 2; $pom = 1; $opcija = [0]; ?>
@include('pages.home');

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@if (Session::has('Message'))
	<br>
	<center>
		<div class="alert alert-danger" style="width: 500px; font-size: 15pt;">{{ Session::get('Message') }}</div>
	</center>
@endif
<style type="text/css">
	td{
		padding: 0 10px;
	}
	#rezultat{
		border-top: 1px solid #000; 
		padding-top: 10px;
	}
</style>
<br>
<div class="sviRadnici">
	{{ AdminOptions::lang(204, Session::get('jezik.AdminOptions::server()'))." <b>".Radnici::find($id)->ime. " ".Radnici::find($id)->prezime. "</b> ".AdminOptions::lang(207, Session::get('jezik.AdminOptions::server()'))." <b>".$pocetni." - ".$krajnji; }}</b>

	<table class="table table-striped table-hover">
		<thead>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(210, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(199, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td style="border-bottom: 1px solid gray;">{{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}</td>
		</thead>
		<?php $suma = 0; 
			$kol = 0;
			$sumaRazduzenja = 0;
			$razduzenjeRadnik = 0;
			$ziralnoRazduzenje = 0;
			$reversRazduzenje = 0;
		?>
		<tbody>
			@foreach($period as $period1)
				<tr>
					<td>{{ date_format(date_create($period1->created_at), "d.m.Y. H:i:s") }}</td>
					<td>{{ proizvodi::find($period1->proizvod)->naziv_proizvoda }}<br> ({{ number_format(cene_datumi::cena_proizvoda($period1->proizvod, $period1->created_at),2,",",".") }} {{ Firma::valuta() }})</td>
					<td>
						@if($period1->pakovanje2 == 0)
							{{ $period1->kolicina2 }} kg
						@else
							{{ $period1->pakovanje2 }} {{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }}
						@endif
					</td>					
					<?php 
						if($period1->pakovanje2 == 0){
							$suma = $suma + cene_datumi::cena_proizvoda($period1->proizvod, $period1->created_at) * $period1->kolicina2;
						}
						else{
							$suma = $suma + cene_datumi::cena_proizvoda($period1->proizvod, $period1->created_at) * $period1->pakovanje2;
						}
						$kol = $kol + $period1->kolicina2;
					?>
					@if($period1->pakovanje2 == 0)
						<td>{{ number_format(cene_datumi::cena_proizvoda($period1->proizvod, $period1->created_at) * $period1->kolicina2,2,",",".") }} {{ Firma::valuta() }}</td>
					@else
						<td>{{ number_format(cene_datumi::cena_proizvoda($period1->proizvod, $period1->created_at) * $period1->pakovanje2,2,",",".") }} {{ Firma::valuta() }}</td>
					@endif	
					<td></td>
					<td></td>
					<td></td>
					@foreach($period_razduzenje as $period2)	
						@if($period2->parent_id == $period1->id)
						<?php 
							$ziralno = 0; 
							$revers = 0;
							$sumaRazduzenja = 0;
						?>
							<tr>
								<td></td>
								<td></td>
								<td style="color: red;">
									@if(proizvodi::find($period2->proizvod)->pakovanje == 0)
										{{ $period2->kolicina }} kg
									@else
										{{ $period2->pakovanje }} {{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }}
									@endif
								</td>
								@if($period2->kupac < 0)
									<td style="color: red;">
										{{ AdminOptions::lang(162, Session::get('jezik.AdminOptions::server()')).ABS($period2->kupac) }}
									</td>
									<td></td>
									<td></td>
									<td></td>
								@else
									<td style="color: red;">	
										{{ Buyers::find($period2->kupac)->naziv }}
									</td>
									<?php
										if ($period2->nacin == 1) {
											if(proizvodi::find($period2->proizvod)->pakovanje == 0){
												$sumaRazduzenja = $period2->kolicina * (cene_datumi::cena_proizvoda($period2->proizvod, $period2->created_at));
											}
											else{
												$sumaRazduzenja = $period2->pakovanje * cene_datumi::cena_proizvoda($period2->proizvod, $period2->created_at);
											}
										}
									?>
									<td style="color: red;">
										{{ number_format($sumaRazduzenja,2,",",".") }} {{ Firma::valuta() }}
									</td>									
									<?php 
										$razduzenjeRadnik = $razduzenjeRadnik + $sumaRazduzenja;
									?>
									<td>
										<?php  
											if ($period2->nacin == 2){
												if(proizvodi::find($period2->proizvod)->pakovanje == 0){
													$ziralno = $ziralno + $period2->kolicina * (cene_datumi::cena_proizvoda($period2->proizvod, $period2->created_at));
												}
												else{
													$ziralno = $ziralno + $period2->pakovanje * cene_datumi::cena_proizvoda($period2->proizvod, $period2->created_at);
												}
												$ziralnoRazduzenje = $ziralnoRazduzenje + $ziralno;
											}
										?>										
										{{ number_format($ziralno,2,",",".") }} {{ Firma::valuta() }}
									</td>
									<td>
										<?php  
											if ($period2->nacin == 3){
												if(proizvodi::find($period2->proizvod)->pakovanje == 0){
													$revers = $revers + $period2->kolicina * (cene_datumi::cena_proizvoda($period2->proizvod, $period2->created_at));
												}
												else{
													$revers = $revers + $period2->pakovanje * cene_datumi::cena_proizvoda($period2->proizvod, $period2->created_at);
												}

												$reversRazduzenje = $reversRazduzenje + $revers;
											}
										?>
										{{ number_format($revers,2,",",".") }} {{ Firma::valuta() }}
									</td>
								@endif
							</tr>
						@endif
					@endforeach	
				</tr>
			@endforeach
			<td id="rezultat">{{ AdminOptions::lang(143, Session::get('jezik.AdminOptions::server()')) }}:</td>
			<td id="rezultat"></td>
			<td id="rezultat">{{ $kol }} kg</td>
			<td id="rezultat">{{ number_format($suma,2,",",".") }} {{ Firma::valuta() }}</td>
			<td id="rezultat" style="color: red;">{{ number_format($razduzenjeRadnik,2,",",".") }} {{ Firma::valuta() }}</td>
			<td id="rezultat">{{ number_format($ziralnoRazduzenje,2,",",".") }} {{ Firma::valuta() }}</td>
			<td id="rezultat">{{ number_format($reversRazduzenje,2,",",".") }} {{ Firma::valuta() }}</td>
		</tbody>
	</table>
</div>