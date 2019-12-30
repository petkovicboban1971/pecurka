<style type="text/css">
	table{
		float: left;
		width: 35% !important; 
		margin: 25px;
	}
	.grafikon td, th{
		text-align: center !important;
	}
	#table_td{
		font-size: 13pt;
		font-weight: bold;
	}
	.razmena{
		float: right;
		width: 55%;/*
		margin: 0 20px;*/
	}
	select, input{
		display: inline-flex;
		width: 130px !important;
		height: 26px;
		margin-left: -15px;
		margin-right: 30px;
	}
	#lista_lager_magacini{
		position: relative;
		left: -380px;
		/*left: 200px;*/
	}
</style>
<table id="user_table">
	<thead>
		<th>{{ AdminOptions::lang(284, Session::get('jezik.AdminOptions::server()')) }}</th>
		<th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
		<th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
	</thead>
	<tbody>
		@foreach($magacini as $magacin)
			<tr>
				<td id="table_td">{{ $magacin->naziv }}</td>
				<td id="table_td">
					<a href="#" class="magacin_edit" data-id="{{ $magacin->id }}"
					title="{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}">
						<i class="fa fa-edit"
						style="color:#00ff00;"
						aria-hidden="true"></i>
					</a>
					<input type="hidden" name="magacin_id" value="{{ $magacin->id }}">
			    </td>
			    <td id="table_td">
					<a href="/magacin_delete/{{ $magacin->id }}" 
					title="{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}"  
					onclick="return confirm('{{ AdminOptions::lang(44, Session::get('jezik.AdminOptions::server()')) }}');">
						<i class="fa fa-trash" 
						style="color:red;"                                
						aria-hidden="true">
						</i>
					</a>
			    </td>
			</tr>
		@endforeach	
	</tbody>
</table>

<!--- MODAL azuriranje magacina --->
<div id="magacin_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/azuriranjeMagacina')
</div>
<!--- razmena izmedju magacina --->
<div class="razmena">
	<table>
		<thead>
			<tr>
			<td style="text-align: center !important;" id="table_td">{{ AdminOptions::lang(288, Session::get('jezik.AdminOptions::server()')) }}
			</td>
			</tr>
			<tr>
				<th>{{ AdminOptions::lang(289, Session::get('jezik.AdminOptions::server()')) }}</th>
				<th>{{ AdminOptions::lang(290, Session::get('jezik.AdminOptions::server()')) }}</th>
				<th>{{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }}</th>
				<th>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<select name="magacin1" id="magacin1">
						<option selected disabled>
							{{ AdminOptions::lang(162, Session::get('jezik.AdminOptions::server()')) }}
						</option>
						<option value="-1" data-id="-1">
							{{ AdminOptions::lang(250, Session::get('jezik.AdminOptions::server()')) }}
						</option>
						@foreach($magacini as $magacin)
							<option value = '{{ $magacin->id }}' data-id="{{ $magacin->id }}">{{ $magacin->naziv }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<select name="magacin2" id="magacin2" disabled>
						<option selected disabled>
							{{ AdminOptions::lang(162, Session::get('jezik.AdminOptions::server()')) }}
						</option>
						@foreach($magacini as $magacin)
							<option value = '{{ $magacin->id }}'>{{ $magacin->naziv }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<select name="proizvod" id="proizvod" disabled>
						<option selected disabled>
							{{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }}
						</option>                    
						@foreach (proizvodi::where('aktivan', 1)->get() as $value)
	                        <option value="{{ $value->id }}">{{ $value->naziv_proizvoda }}</option>
	                    @endforeach
					</select>					
				</td>
				<td>
					<input class="kolicina1" type="number" min="0.001" name="kolicina" disabled>
				</td>
			</tr>
		</tbody>
	</table>
	<center>
		<a class="btn dugme" disabled >{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</a>
		<a class="btn" href="/magacini">{{ AdminOptions::lang(129, Session::get('jezik.AdminOptions::server()')) }}</a>
	</center>
	<div id="lista_lager_magacini">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 150px !important;">
			<thead>
				<tr>
					<th colspan="2">{{ AdminOptions::lang(250, Session::get('jezik.AdminOptions::server()')) }}</th>				
				</tr>	
			</thead>
			<tr>
				@foreach(proizvodi::where('aktivan', 1)->get() as $proizvod)
					<tr>
						<td>
							{{$proizvod->naziv_proizvoda}}
						</td>
						<td>
							{{proizvodi::find($proizvod->id)->tezina_pakovanja == 0 ? $proizvod->kolicina_proizvoda : $proizvod->pakovanje}}
						</td>
					</tr>
				@endforeach
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" style="position: relative; top: -224px; left: 180px; width: 150px !important;">
			<tr>
				@foreach($magacini as $magacin)
				<td><table border="0" cellpadding="0" cellspacing="0" style="width: 150px !important;">
					<th colspan="2">
						{{ $magacin->naziv }}
					</th>
					@foreach($proizvod_magacin as $magacin1)
						@if($magacin1->magacin == $magacin->id)
							<tr>
								<td>
									{{ proizvodi::find($magacin1->proizvod)->naziv_proizvoda }}
								</td>	
								<td>
									{{ proizvodi::find($magacin1->proizvod)->tezina_pakovanja == 0 ? $magacin1->kolicina : $magacin1->pakovanje }}
								</td>
							</tr>
						@endif
					@endforeach
					</table></td>
				@endforeach
			</tr>	
		</table>
	</div>
</div>
<div id="prikaz"></div>
<script type="text/javascript">
	$('.magacin_edit').click(function(e){
        e.preventDefault(); 
        var magacin_id = $(this).data('id');
        //console.log(magacin_id);
        $.ajax({
			url: '/magacin_edit/'+magacin_id,
			method:"GET",
			data:$(this).serialize(),
			dataType:"json",
			success:function(data)
			{
				$('#naziv').val(data.result.naziv);
				$('#indeks').val(data.result.id);
				$('#magacin_edit').modal('show');
			}
		}); 
    });
    $('select[name="magacin1"]').on('change', function(e){
    	e.preventDefault();
    	$('#magacin2').removeAttr('disabled');
    	$('#magacin1').prop('disabled', true);
    	var magacin_ajax = $(this).val();  
    	//$('select[name="magacin1"]').on('change', function() {
        var stateID = $(this).val();

        if(stateID) {
	    	$.ajax({
	    		url: '/magacin_ajax/'+magacin_ajax,
	    		method: "GET", 
	    		data:$(this).serialize(),
	    		dataType:"json",
	    		success:function(data){
                    $('select[name="proizvod"]').empty();
                    
                    $.each(data, function(key, value) {
                    	for (var i = 0; i < data.podaci.length; i ++) {        	
                    		if(!(data.podaci[i].naziv_proizvoda)){
                    			var univerzal = data.podaci[i].proizvod;
                    		}
                    		else{
                    			var univerzal = data.podaci[i].naziv_proizvoda;
                    		}
                        	$('select[name="proizvod"]').append('<option value="'+ data.podaci[i].id +'">'+ univerzal +'</option>');   
                    	}	                    
                    });
	    		} 
	    	})
	    }
	    else{
            $('select[name="proizvod"]').empty();
        }
    });

    $('#magacin2').on('change', function(e){
    	e.preventDefault();
    	$('#proizvod').removeAttr('disabled');
    	$('#magacin2').prop('disabled', true);
    	$('.kolicina1').removeAttr('disabled');
    });

    $('#proizvod').on('change', function(e){
    	e.preventDefault();
    	$('.kolicina1').removeAttr('disabled');/*
    	$('#proizvod').prop('disabled', true);*/
    });

    $('.kolicina1').on('keyup', function(e){
    	e.preventDefault();
    	$('.dugme').removeAttr('disabled');
    });

    $('.dugme').on('click', function(){
        alertify.confirm("<?php echo AdminOptions::lang(226, Session::get('jezik.AdminOptions::server()')); ?>",
            function(e){
                if(e){
                	var magacin1 = $('#magacin1').val();
                	var magacin2 = $('#magacin2').val();
                	var proizvod = $('#proizvod').val();
                	var kolicina = $('.kolicina1').val();
                    $.ajax({
						url: '/razmena',
						method:"POST",
						data: {
							magacin1: magacin1, 
							magacin2: magacin2,
							proizvod: proizvod,
							kolicina: kolicina
						},
						dataType:'html',
						beforeSend:function(){
							$('#prikaz').text('Processing...');
						},
						success:function(data)
						{							
							location.reload(true);
						}
					}); 
                }
            });
        
    });
    
</script>