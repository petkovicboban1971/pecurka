

<!--- MODAL IZMENA DOBAVLJACA --->
<div id="izmena_dobavljaca" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">    

	<form action='/izmena_podataka_dobavljaca' method="post"> 
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{ AdminOptions::lang(279, Session::get('jezik.AdminOptions::server()')) }}: <b>{{ dobavljaci::find($id)->naziv_dobavljaca }}</b></h4>
				</div>  
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-6 control-label" style="text-align: right; ">{{ AdminOptions::lang(194, Session::get('jezik.AdminOptions::server()')) }}:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm invoice-amt" name="novo_ime_dobavljaca" value="{{ dobavljaci::find($id)->naziv_dobavljaca }}">
						</div>        
					</div>
					<div class="form-group row">
						<label class="col-sm-6 control-label" style="text-align: right; ">{{ AdminOptions::lang(264, Session::get('jezik.AdminOptions::server()')) }}:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm invoice-amt" name="adresa" value="{{ dobavljaci::find($id)->adresa }}">
						</div>        
					</div>
					<div class="form-group row">
						<label class="col-sm-6 control-label" style="text-align: right; ">{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm invoice-amt" name="ziro_racun" value="{{ dobavljaci::find($id)->ziro_racun }}">
						</div>        
					</div>
					<input type="hidden" name="id" value="{{ $id }}">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
					<button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
				</div>
			</div>
		</div>
	</form>
</div>  
