
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
          	<h4 class="modal-title">
          		{{ AdminOptions::lang(277, Session::get('jezik.AdminOptions::server()')) }}
          	</h4>
        </div>
		<div class="modal-body">
			<table>
				<thead>
					<tr>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(264, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}</td>
					</tr>
				</thead>
				<tbody>
					@foreach(dobavljaci::all() as $pregled_dobavljaca)
						<tr>
							<td>{{ $pregled_dobavljaca->naziv_dobavljaca }}</td>
							<td>{{ $pregled_dobavljaca->adresa }}</td>
							<td>{{ $pregled_dobavljaca->ziro_racun }}</td>
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