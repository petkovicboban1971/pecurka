
	<div class="modal-dialog modal-sm">
	   	<div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">{{ AdminOptions::lang(201, Session::get('jezik.AdminOptions::server()')) }} </h4>
	        </div>
	        <form method="post" action="/otpis1" id="myForm">
		        <div class="modal-body">
		        	<select name="kupac" id="kupac" style="width: 200px;font-weight: bold;">
		        		<option value="0" selected disabled>
		        			{{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}:
		        		</option>
		        		@foreach(DB::table('kupci')->where('aktivan', 1)->get() as $kupac)
		        			<option value="{{ $kupac->id }}">
		        				{{ $kupac->naziv }}
		        			</option>		        			
	        			@endforeach
	        		</select><br><br>
		        	<select name="proizvod" id="nacin" style="width: 200px;font-weight: bold;" required disabled>	
		        		<option value="0" selected disabled>
		        			{{ AdminOptions::lang(122, Session::get('jezik.AdminOptions::server()')) }}:
		        		</option>        			
	        			@foreach(proizvodi::where('tezina_pakovanja', '!=', 0)->orWhere('kolicina_proizvoda', '!=', 0)->get() as $proizvod)
		        			<option value="{{ $proizvod->id }}">
		        				{{ $proizvod->naziv_proizvoda }}
		        			</option>
	        			@endforeach
	        		</select><br><br>
		        	<input type="number" step="0.01" min="0" lang="en" id="kolicina" style="float: right;" name="kolicina" size="9" placeholder="{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}" required disabled><br><br>
	        		<textarea style="margin-left: 15px;" rows="4" cols="22" name="opis" form="myForm"> {{ AdminOptions::lang(7, Session::get('jezik.AdminOptions::server()')) }}</textarea>
		        </div>
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-success btn1" disabled>{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
		        </div>
	    	</form>
	    </div>
	</div>