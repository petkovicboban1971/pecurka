<div id="pregled_ispl_dobavljaca" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-sm">
	    <div class="modal-content">
	        <div class="modal-header">
	          	<h4 class="modal-title">
	          		{{ $dobavljac->naziv_dobavljaca }}
	          	</h4>
	        </div>
			<div class="modal-body">
				<table>
					<thead>
						<tr>
							<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}</td>
							<!-- <td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</td> -->
							<td style="width: 80px !important; font-weight: bold;">{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}</td>
						</tr>
					</thead>
					<tbody>
						@foreach($isplate_dobavljaca as $dobavljac)
							<tr>
								<td>{{ date_format($dobavljac->created_at, 'd.m.Y.') }}</td>
								<!-- <td>
									<a href="/pregled_ispl_dobavljaca/{{ $dobavljac->id }}">
										{{ dobavljaci::find($dobavljac->dobavljaci_id)->naziv_dobavljaca }}
									</a>
								</td> -->
								<td>{{ $dobavljac->iznos }} {{ Firma::valuta() }}</td>
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
</div>
<script type="text/javascript">
    $('#pregled_ispl_dobavljaca').modal('show');
</script>