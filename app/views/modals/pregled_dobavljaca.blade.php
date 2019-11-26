
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
						<td style="width: 40px !important;">{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</td>
						<td style="width: 40px !important;">{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</td>
					</tr>
				</thead>
				<tbody>
					@foreach(dobavljaci::where('aktivan', 1)->get() as $dobavljac)
						<tr>
							<td>{{ $dobavljac->naziv_dobavljaca }}</td>
							<td>{{ $dobavljac->adresa }}</td>
							<td>{{ $dobavljac->ziro_racun }}</td>
							<td>
								<a href="/izmena_dobavljaca/{{ $dobavljac->id }}">
									<i class="fa fa-edit" style="color: #009432; padding-left: 1vh;" aria-hidden="true">
									</i>
								</a>
							</td>
							<td>
								<a href="#">
									<i class="fa fa-trash brisanje_dobavljaca" data-link="/brisanje_dobavljaca/{{ $dobavljac->id }}" style="color: red; padding-left: 2vh;" aria-hidden="true">	
									</i>
								</a>
							</td>
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