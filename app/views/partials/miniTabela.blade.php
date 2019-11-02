 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <table>
    	@if($izborTabele == 2)
	    	<p>{{ AdminOptions::lang(176, Session::get('jezik.AdminOptions::server()')) }}:</p>
	    @endif
	    <thead>
			<td>{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }} {{ AdminOptions::lang(53, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td>{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</td>
			<td>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td>
			@if($izborTabele == 2)
				<td>{{ AdminOptions::lang(162, Session::get('jezik.AdminOptions::server()')) }}</td>
			@endif
			@if($izborTabele == 4)
				<td>{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</td>
				<td>{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}</td>
				<td>{{ AdminOptions::lang(175, Session::get('jezik.AdminOptions::server()')) }}</td>
			@endif
		</thead>
		@if($izborTabele == 2)
			@foreach($prethodnoZaduzeni as $prethodnoZaduzen)
				<tr>
					<td>{{ Radnici::find($prethodnoZaduzen->radnik)->ime }} {{ Radnici::find($prethodnoZaduzen->radnik)->prezime }}</td>
					<td>{{ proizvodi::find($prethodnoZaduzen->proizvod)->naziv_proizvoda }}</td>
					<td>{{ $prethodnoZaduzen->kolicina }}</td>
					<td>{{ $prethodnoZaduzen->magacin }}</td>
				</tr>
			@endforeach
		@endif

		@if($izborTabele == 4)
		<?php $ukupanIznos = 0; ?>						
			@foreach($listeZaduzenja as $listaZaduzenja)				
				<tr style="border-top: 1px solid #cccccc;">
					<?php $iznos = 0;?>
					@if($listaZaduzenja->radnik != 0)
						<td>
							{{ Radnici::find($listaZaduzenja->radnik)->ime }} 
							{{ Radnici::find($listaZaduzenja->radnik)->prezime }}
						</td>
						<?php $pomIznos = 0; ?>
						@foreach(DB::table('upisaniproizvod')->where('parent_id', $listaZaduzenja->id)->get() as $listaProizvoda)
							@if($listaProizvoda->kolicina > 0)
								<tr>
									<th></th>	
									<th>
										<!-- <a class="proizvodd" href="#myModal1" data-proizvod = "{{ proizvodi::find($listaProizvoda->proizvod)->id }}" data-toggle="modal" data-target="#myModal1" title="{{ AdminOptions::lang(178, Session::get('jezik.AdminOptions::server()')) }}"> -->{{ proizvodi::find($listaProizvoda->proizvod)->naziv_proizvoda }}<!-- </a> -->
									</th>
									<th>
										<!-- <a class="kolicinaa" href="#" data-kolicina = "{{ $listaProizvoda->kolicina }}" data-toggle="modal" data-target="#myModal2" title="{{ AdminOptions::lang(179, Session::get('jezik.AdminOptions::server()')) }}"> -->
										@if($listaProizvoda->pakovanje == 0)
											{{ $listaProizvoda->kolicina }} kg
										@else
											{{ $listaProizvoda->pakovanje }} {{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }}
										@endif<!-- 
										</a> -->
									</th>
									<th>
										{{ cene_datumi::cena_proizvoda($listaProizvoda->proizvod, $listaProizvoda->created_at) }} {{ Firma::valuta() }}
									</th>
									<?php 
										if($listaProizvoda->pakovanje == 0){
										$iznos = $iznos + $listaProizvoda->kolicina * cene_datumi::cena_proizvoda($listaProizvoda->proizvod, $listaProizvoda->created_at);
										}
										else{
											$iznos = $iznos + $listaProizvoda->pakovanje * cene_datumi::cena_proizvoda($listaProizvoda->proizvod, $listaProizvoda->created_at);
										}
										$ukupanIznos = $ukupanIznos + $iznos;
										$pomIznos = $pomIznos + $iznos; ?>
									
									@if($iznos != 0)
										<th>
											{{ number_format($iznos,2,",",".") }} {{ Firma::valuta() }}
										</th>
										<?php $iznos=0 ?>
										<th></th>
									@endif
								</tr>
							@endif
						@endforeach

						@if($pomIznos != 0)
							<th style="border-top: 1px solid gray;"></th><th style="border-top: 1px solid gray;"></th><th style="border-top: 1px solid gray;"></th><th style="border-top: 1px solid gray;"></th><th style="border-top: 1px solid gray;"></th>
							<th style="border-top: 1px solid gray;"><b>{{ number_format($pomIznos,2,",",".") }} {{ Firma::valuta() }}</b></th>
						@endif 
						<?php $pomIznos = 0; ?>						
					</tr>
				@endif
			@endforeach 
			@if($ukupanIznos != 0)
				<center>
					<div class="ukIznos">{{ AdminOptions::lang(175, Session::get('jezik.AdminOptions::server()')) }}: {{ number_format($ukupanIznos,2,",",".") }} {{ Firma::valuta() }}</div>
				</center>
				<!-- <div style="clear: both; position: relative; bottom: 20px;">
					<button style="width: 200px;">
						{{ AdminOptions::lang(177, Session::get('jezik.AdminOptions::server()')) }} 
					</button>
				</div> -->
			@endif
		@endif
	</table>

<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-sm">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Izaberite proizvod:</h6>
          <a href="" style="float: right;" type="button1" class="close" data-dismiss="modal">&times;</a>
        </div>
        	<div class="col-xs-3">
        <div class="modal-body">
        	<form>
	      		<select name="izmenjenProizvod">
	      			@foreach(DB::table('proizvodi')->orderBy('grupa_proizvoda', 'DESC')->get() as $proizvod)
	      				<option class="pproizvod" data-id="{{ $proizvod->id }}">
	      					{{ $proizvod->naziv_proizvoda }}	      					
	      				</option>
	      			@endforeach
	      		</select>
	        </form>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Izmeni</button>
        </div>
      </div>      
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	    $('.pproizvod').on('click', function(e){
	        e.preventDefault();
	        var product = $(this).data('id');
	        console.log(product);/*
	        $.post('/izmenaProizvoda', {

	        })*/
	    });

	    $('.kkolicina').on('click', function(e){
        	e.preventDefault();
	        var kolicina = $(this).data('kolicina');
        });
	    $('[data-toggle="tooltip"]').tooltip();

	    $('#myModal1').on('click', function(e){
      		$("#myModal1").modal('show');

	    })

	    $('#myModal2').on('click', function(e){
	    	
	    })

    }); 
</script>