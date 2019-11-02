
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          	<h4 class="modal-title">
          		{{ AdminOptions::lang(248, Session::get('jezik.AdminOptions::server()')) }}
          	</h4>
        </div>
		<div class="modal-body">
			<table>
				<thead>
					<tr>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(141, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(7, Session::get('jezik.AdminOptions::server()')) }}</td>
					</tr>
				</thead>
				<tbody>
					@foreach(otpis::all() as $otpis)
						<tr>
							<td>{{ date_format($otpis->created_at, 'd.m.Y.') }}</td>
							<td>{{ Buyers::find($otpis->kupac)->naziv }}</td>
							<td>{{ proizvodi::find($otpis->proizvod)->naziv_proizvoda }}</td>
							<td>{{ $otpis->kolicina }} {{ proizvodi::odluka_otpis($otpis->proizvod) }}</td>
							<td>{{ $otpis->opis }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
       	</div>        
        <div class="modal-footer"><!-- 
			<button type="submit" class="btn btn-info waves-effect waves-light">
				{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}
			</button> -->
			<button type="button" class="btn btn-danger" data-dismiss="modal">
				{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}
			</button>
        </div>
    </div>
</div>