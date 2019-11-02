
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
          	<h4 class="modal-title">
          		{{ AdminOptions::lang(262, Session::get('jezik.AdminOptions::server()')) }}
          	</h4>
        </div>
		<div class="modal-body">
			<table>
				<thead>
					<tr>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</td>
					</tr>
				</thead>
				<tbody>
					@foreach(cene_datumi::orderBy('created_at', 'DESC')->orderBy('proizvod_id', 'ASC')->get() as $pregled_cena)
						<tr>
							<td>{{ date_format($pregled_cena->created_at, 'd.m.Y.') }}</td>
							<td>{{ proizvodi::find($pregled_cena->proizvod_id)->naziv_proizvoda }}</td>
							<td>{{ $pregled_cena->cene }} {{ Firma::valuta() }}</td>
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