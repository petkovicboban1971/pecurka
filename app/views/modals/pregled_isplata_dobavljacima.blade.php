
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
          	<h4 class="modal-title">
          		{{ AdminOptions::lang(257, Session::get('jezik.AdminOptions::server()')) }}
          	</h4>
        </div>
		<div class="modal-body">
			<table>
				<thead>
					<tr>
						<!-- <td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}</td> -->
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}</td>
					</tr>
				</thead>
				<tbody>
					@foreach(dobavljaci::where('aktivan', 1)->get() as $dobavljac)
						<tr>
							<td>
								<a href="/pregled_ispl_dobavljaca?id={{ $dobavljac->id }}">
									{{ $dobavljac->naziv_dobavljaca }}
								</a>
							</td>
							<td>{{ dobavljaci_isplata::where('dobavljaci_id', $dobavljac->id)->sum('iznos') }} {{ Firma::valuta() }}</td>
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