<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="{{ AdminOptions::base_url()}}css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="{{ AdminOptions::base_url()}}css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
<div id="konacnoZaduzenje" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
<?php $suma=0; 
	$radnik0 = Radnici::find(DB::table('logovi')->orderBy('id', 'DESC')->first()->llog)->ime;
	$radnik1 = Radnici::find(DB::table('logovi')->orderBy('id', 'DESC')->first()->llog)->prezime;
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content" style="padding: 20px 30px 20px 50px;">
        <div class="modal-header">
        	<div style="float: right;">
        		Datum: {{ date('d.m.Y. H:m:s') }}
        	</div>
        	<div style="float: left;">
	        	{{ Firma::naziv() }}<br>
	        	{{ Firma::adresa() }}
        	</div>
        </div>
        <div class="modal-body">
        	<center>
        		<div style="font-size: 15pt;">
        			{{ AdminOptions::lang(134, Session::get('jezik.AdminOptions::server()')) }} <b><i>{{ Buyers::find($kupac_id)->naziv }}</i></b>
        		</div>
        	</center><br>
          	<table class="table table-striped" id="tblGrid">
	            <thead id="tblHead">
	              	<tr>
		                <th>{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</th>
		                <th>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</th>
		                <th>{{ AdminOptions::lang(105, Session::get('jezik.AdminOptions::server()')) }}/kg</th>
		                <th style="float: right;">{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</th>
	              	</tr>
	            </thead>
	            <tbody>
	              	<tr>
		              	<td style="font-size: 15pt;">
		              		@foreach($data0 as $dataw)
		              	 		{{ proizvodi::find($dataw->proizvod_id)->naziv_proizvoda }}<br>
			            	@endforeach  
						</td>
						<td style="font-size: 15pt;">
		              		@foreach($data0 as $dataw)
		              			{{ $dataw->kolicina }} kg<br>
			            	@endforeach  
						</td>
						<td style="font-size: 15pt;">
		              		@foreach($data0 as $dataw)
		              			{{ $dataw->cena }} {{ Firma::valuta() }}<br>
			            	@endforeach  
						</td>
						<td style="float: right; font-size: 15pt;">
		              		@foreach($data0 as $dataw)
		              			{{ number_format(($dataw->cena * $dataw->kolicina),2,",",".") }} {{ Firma::valuta() }}<br>
		              			<?php $suma = $suma + $dataw->cena * $dataw->kolicina; ?>
			            	@endforeach  
						</td>             
	              	</tr>
	            </tbody>
          	</table>
          {{ AdminOptions::lang(139, Session::get('jezik.AdminOptions::server()')) }} <div style="float: right; font-size: 17pt;">{{ number_format($suma,2,",",".") }} {{ Firma::valuta() }}</div>
		</div>
        <div class="modal-footer">
        	<div style="float: left;">{{ AdminOptions::lang(136, Session::get('jezik.AdminOptions::server()')) }}:</div>
        	<div style="float: right;">{{ AdminOptions::lang(137, Session::get('jezik.AdminOptions::server()')) }}:</div>
        	<br>
        	<div style="float: left;">{{ $radnik0 }} {{ $radnik1 }}</div>
        	<div style="float: right;">{{ Radnici::find($radnik_id)->ime }} {{ Radnici::find($radnik_id)->prezime }}</div>
        	<br><br><br>
        	<div style="float: left;">______________________</div>
        	<div style="float: right;">______________________</div>
        	<br>
			<div style="float: left; margin-left: 62px;">{{ AdminOptions::lang(135, Session::get('jezik.AdminOptions::server()')) }}</div>
        	<div style="float: right; margin-right: 62px;">{{ AdminOptions::lang(135, Session::get('jezik.AdminOptions::server()')) }}</div>
        	<br><br>
			<center>
				<p>{{ AdminOptions::lang(141, Session::get('jezik.AdminOptions::server()')) }}:</p><br>
				______________________	 
				<div>{{ AdminOptions::lang(135, Session::get('jezik.AdminOptions::server()')) }}</div>
			</center>
	        <!--<button type="button" class="btn btn-default " data-dismiss="modal">{{ AdminOptions::lang(129, Session::get('jezik.AdminOptions::server()')) }}</button> -->
	        <a href="/home" class="btn btn-primary">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</a>
        </div>
    </div>
</div>

<script type="text/javascript">
      $('#konacnoZaduzenje').modal('show');
</script>

</body>
</html>