
<div class="modal fade" id="razduzenjeModal" role="dialog">
	<div class="modal-dialog">
	   	<div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">{{ AdminOptions::lang(150, Session::get('jezik.AdminOptions::server()')) }} {{ Radnici::find($radnici->radnik)->ime }} {{ Radnici::find($radnici->radnik)->prezime }}</h4>
	        </div> <!-- 
	        <form method="post" action="/razduzenjeRadnika2"> -->
		        <div class="modal-body">
		        	<select name="kupac" id="kupac">	
		        		<option value="0" selected disabled>
		        			{{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}
		        		</option>       			
	        			<option value="-1">
	        				{{ AdminOptions::lang(183, Session::get('jezik.AdminOptions::server()')) }}
	        			</option>
	        			<option value="-2">
	        				{{ AdminOptions::lang(184, Session::get('jezik.AdminOptions::server()')) }}
	        			</option>
	        			@foreach(DB::table('kupci')->get() as $kupac)
		        			<option value="{{ $kupac->id }}">
		        				{{ $kupac->naziv }}
		        			</option>
	        			@endforeach
	        		</select>
		        	<select name="nacin" style="margin-left: 70px;" id="nacin" required disabled>
		        		<option value="0" selected disabled>{{ AdminOptions::lang(180, Session::get('jezik.AdminOptions::server()')) }}</option>
						<option value="1">{{ AdminOptions::lang(181, Session::get('jezik.AdminOptions::server()')) }}</option>
						<option value="2">{{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}</option>
						<option value="3">{{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}</option>    		
		        	</select>
		        	<input type="number" step="0.01" min="0" lang="en" id="kolicina" style="float: right;" name="novaKolicina" size="6" placeholder="{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}" required disabled>
					<input type="hidden" name="proizvod" value="{{ $proizvod->proizvod }}">
		        </div>
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-success btn1" disabled>{{ AdminOptions::lang(185, Session::get('jezik.AdminOptions::server()')) }}</button>
		        </div><!-- 
	    	</form> -->
	    </div>
	</div>
</div>