
	<div class="modal-dialog modal-sm">
	   	<div class="modal-content">
	        <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	            <h4 class="modal-title">{{ AdminOptions::lang(254, Session::get('jezik.AdminOptions::server()')) }} </h4>
	        </div>
	        <form method="post" action="/dnevna_cena_proizvoda" id="myForm">
		        <div class="modal-body">
		        	<select name="proizvod" id="nacin" style="width: 200px;font-weight: bold;">	  
		        		<option value="0" selected disabled>
		        			{{ AdminOptions::lang(122, Session::get('jezik.AdminOptions::server()')) }}:
		        		</option>        			
	        			@foreach(proizvodi::where('tezina_pakovanja', '!=', 0)->orWhere('kolicina_proizvoda', '!=', 0)->get() as $proizvod)
		        			<option value="{{ $proizvod->id }}">
		        				{{ $proizvod->naziv_proizvoda }}
		        			</option>
	        			@endforeach
	        		</select><br><br>
		        	<input type="text" id="kolicina" style="float: right;" name="kolicina" size="9" placeholder="{{ AdminOptions::lang(253, Session::get('jezik.AdminOptions::server()')) }}" required><br><br><!-- 
	        		<textarea style="margin-left: 15px;" rows="4" cols="22" name="opis" form="myForm"> {{ AdminOptions::lang(7, Session::get('jezik.AdminOptions::server()')) }}</textarea> -->
		        </div>
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-success btn1">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
		        </div>
	    	</form>
	    </div>
	</div>