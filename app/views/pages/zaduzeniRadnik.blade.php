<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		html { overflow-y: scroll; }
		body { 
		  line-height: .5;
		}
		#main {
			width: 500px;
			padding: 0px;/*
			margin: 3px;*/
		}

		table.timecard {
			margin: auto;
			width: 600px;
			border-collapse: collapse;
			border: 1px solid #fff; /*for older IE*/
			border-style: hidden;
		}

		table.timecard caption {
			background-color: #cc0000;
			color: #fff;
			font-size: x-large;
			padding: 8px;
		}

		table.timecard thead th {
			padding: 8px;
			background-color: white;
			font-size: large;
		}

		table.timecard thead th#thDay {
			width: 20%;	
		}

		table.timecard thead th#thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
			width: auto;
		}

		table.timecard th, table.timecard td {
			padding: 3px;
			border-width: 1px;
			border-style: solid;
			/*border-color: #f79646 #ccc;*/
		}

		table.timecard td {
			text-align: right;
		}

		table.timecard tbody th {
			text-align: left;
			font-weight: normal;
		}

		table.timecard tfoot {
			font-weight: bold;
			font-size: large;
			background-color: #b6b8ba;
			color: #fff;
		}

		table.timecard tr.even {
			background-color: #fde9d9;
		}
		button {
			width: 180px;
		}
		th a {
			color: #cc0000;
		}
		th a:hover {
			color: red;
		}
	</style>
</head>
<body>
@include('pages.home')
	<div id="main-pregRad">
		<div style="margin-top: 75px;">
			<div id="main">
				<table class="timecard">
					<thead>
						<tr>
							<th id="thDay">{{ AdminOptions::lang(81, Session::get('jezik.AdminOptions::server()')) }}:</th>
							<th id="thRegular">{{ AdminOptions::lang(141, Session::get('jezik.AdminOptions::server()')) }}:</th>
							<th id="thOvertime"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>{{ Radnici::find($radnik)->ime }} {{ Radnici::find($radnik)->prezime }}</th>
							@foreach($data2 as $data1)
								<th><a href="/faktura-posebno/{{ $data1->kupac_id }}/{{ $data1->radnik_id }}">{{ Buyers::find($data1->kupac_id)->naziv }}</a></th>
							@endforeach
						</tr>

					</tbody>
					<tfoot>
						<tr>
							<th>{{ AdminOptions::lang(142, Session::get('jezik.AdminOptions::server()')) }}:</th>
							<?php $sumaZaduzenja = 0; ?>
							@foreach($data2 as $key => $dataa)	
								<?php $sumaZaduzenja1 = 0; ?>
								@foreach ($data3[$key] as $data5) 
									<?php
										$sumaZaduzenja1 = $data5->kolicina * $data5->cena + 
										$sumaZaduzenja1;
									?>
								@endforeach								
								<td style="padding: 8px;">{{ number_format($sumaZaduzenja1,2,",",".") }} {{ Firma::valuta() }}</td>
								<?php $sumaZaduzenja = $sumaZaduzenja + $sumaZaduzenja1; ?>
							@endforeach	
						</tr>
					</tfoot>
					<caption><div style="float: right; padding: 8px;">{{ AdminOptions::lang(143, Session::get('jezik.AdminOptions::server()')) }}: {{ number_format($sumaZaduzenja,2,",",".") }} {{ Firma::valuta() }}</div></caption>
				</table>
		</div>
	</div>	
</body>
</html>