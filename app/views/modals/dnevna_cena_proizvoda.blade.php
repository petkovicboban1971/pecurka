
<div class="modal-dialog modal-sm">
   	<div class="modal-content">
        <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ AdminOptions::lang(254, Session::get('jezik.AdminOptions::server()')) }} </h4>
        </div>
        <form method="post" action="/dnevna_cena_proizvoda">
	        <div class="modal-body">
	        	<select name="proizvod" class="nacin_uplate" style="width: 200px;font-weight: bold;" required>	  
	        		<option value="0" selected disabled>
	        			{{ AdminOptions::lang(122, Session::get('jezik.AdminOptions::server()')) }}:
	        		</option>        			
        			@foreach(proizvodi::where('tezina_pakovanja', '!=', 0)->orWhere('kolicina_proizvoda', '!=', 0)->get() as $proizvod)
	        			<option value="{{ $proizvod->id }}">
	        				{{ $proizvod->naziv_proizvoda }}
	        			</option>
        			@endforeach
        		</select><br><br>
	        	<input type="number" step="0.01" min="0" lang="en" class="iznos_uplate" style="float: right;" name="kolicina" size="9" disabled required placeholder="{{ AdminOptions::lang(253, Session::get('jezik.AdminOptions::server()')) }}"><br><br>
	        </div> 
	        <div class="modal-footer">
	        	<button type="submit" class="btn btn-success potvrda_uplate" disabled>{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
	        </div>
    	</form>
    </div>
</div>
<script type="text/javascript">	
	$(document).ready(function(){	
        
    });
</script>