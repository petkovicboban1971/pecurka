
	<div class="modal-dialog modal-sm">
	   	<div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">{{ AdminOptions::lang(191, Session::get('jezik.AdminOptions::server()')) }} </h4>
	        </div>
	        <form method="post" action="/kolicinedobavljaca">
		        <div class="modal-body">
		        	<select name="dobavljac" id="kupac" style="width: 200px;">	
		        		<option value="0" selected disabled>
		        			{{ AdminOptions::lang(193, Session::get('jezik.AdminOptions::server()')) }}
		        		</option>
	        			@foreach(DB::table('dobavljaci')->get() as $dobavljac)
		        			<option value="{{ $dobavljac->id }}">
		        				{{ $dobavljac->naziv_dobavljaca }}
		        			</option>
	        			@endforeach
	        		</select><br><br>
		        	<select name="proizvod" id="nacin" style="width: 200px;" required disabled>	
		        		<option value="0" selected disabled>
		        			{{ AdminOptions::lang(122, Session::get('jezik.AdminOptions::server()')) }}
		        		</option>       			
	        			@foreach(DB::table('proizvodi')->where('aktivan', 1)->get() as $proizvod)
		        			<option value="{{ $proizvod->id }}">
		        				{{ $proizvod->naziv_proizvoda }}
		        			</option>		        			
	        			@endforeach
	        		</select><br><br>
		        	<input type="number" step="0.01" min="0" lang="en" id="kolicina" style="float: right;" name="novaKolicina" size="9" placeholder="{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}" required disabled><br>
		        </div>
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-success btn1" disabled>{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
		        </div>
	    	</form>
	    </div>
	</div>