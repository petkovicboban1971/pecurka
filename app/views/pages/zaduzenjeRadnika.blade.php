
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script><!-- 
	<script src="js/jquery-3.4.1.js"></script> -->

	<script type="text/javascript">      
        $(document).ready(function() {
	        $("#submit_button").click(function() {
		        $.post('/privremena-tabela',
		        	{ 
		        	  proizvod_id: $(this).data('id'),
		        	  radnik: $("#selection1 option:selected").val(),
		        	  kupac: $("#selection2 option:selected").val(),
		        	  Kolicina: $(this).val(),
		        	  Cena: $(this).val(),
		        	  zarRad: $(this).val() 
		        	},
	           		function (response) {
		              	location.href="/";
		            });
		  	});

	        $("#selection1" && "#selection2").change(function(){

		        	$.post('/privremena-tabela',
			        	{ 
			        	  radnik: $("#selection1 option:selected").val(),
			        	  kupac: $("#selection2 option:selected").val()
			        	});
	        });


		  	$("#upisi").on('click', function(e){
		  		e.preventDefault();
		  		$.post('/privremena-tabela1',
		        	{
		        	  	product: $(e).data('product')			    		
		        	},
		        	function(){
        			});
		  		console.log(product);
		  	});

		  	$('#upisKolicineModal').on('show.bs.modal', function(e) {
			    var Id = $(e.relatedTarget).data('id');
			    $(e.currentTarget).find('input[name="Id"]').val(Id);
			    var Product = $(e.relatedTarget).data('product');
			    $(e.currentTarget).find('input[name="Product"]').val(Product);
			});
    
    		$('#potvrdaKupac').click(function(){
    			$("#potvrdaKupacModal").modal('show');
    		})
            
	    });		
	</script>

	<style type="text/css">
		select{
			width: 220px;
			text-align: center;	
			border: 2px solid #f2f2f2;
		  	border-radius: 4px ;
		  	-webkit-border-radius: 4px ;
		  	-moz-border-radius: 4px ;
		}
		button{
			width: 120px;
			/*box-shadow: 5px;*/
			/*margin: 5px;*/
		}
		
	</style>

</head>
<body>
<?php $text = AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()')); ?>
@include('pages/home')
<?php $pom = veza::where('magacin', 1)->get(); 
	//var_dump($pom);die();

	//print_r(veza::find(8)->radnik); die();

//for($i=0; $i < count($pom); $i++){
		/*foreach($pom[$i]-> as $mmm){
			echo $mmm->ime;
		}*/
		foreach ($pom as $value) {
					
			echo Radnici::find($value->radnik)->ime;
			echo proizvodi::find($value->proizvod)->naziv_proizvoda;
			echo veza::find($value->id)->kolicina;
		}
	//}
?>

<div id="main-zadRad">	
	<!-- @if (Session::has('Message'))
		<center>
			<div class="alert alert-success" style="width: 250px;">{{ Session::get('Message') }}</div>
		</center>
	@endif -->
	@if(empty($dataa1))
		<?php 
			if(empty($radnik_id)){
				$izabraniRadnik = AdminOptions::lang(115, Session::get('jezik.AdminOptions::server()')).":";
				$vrednost = 0;
			}
			else{
				$izabraniRadnik = Radnici::find($radnik_id)->ime." ".Radnici::find($radnik_id)->prezime;
				$vrednost = $radnik_id;
			}
		?>
		<form method="post">
			<div style="padding: 25px 0 0 530px; font-size: 18pt;">				
				<div class="form-group row">
					<select id="selection1" class="form-group row" autocomplete="off">
						<option value="{{ $vrednost }}" selected> {{ $izabraniRadnik }}</option>
						@foreach(DB::table('radnici')->get() as $radnik)
						  	<option value="{{ $radnik->id }}">{{ $radnik->ime }} {{ $radnik->prezime }}</option>
						@endforeach
					</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
					<select id="selection2" class="form-group row" autocomplete="off">
						<option value="0" selected>{{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}:</option>
						@foreach(DB::table('kupci')->get() as $kupac)
						  	<option value="{{ $kupac->id }}">{{ $kupac->naziv }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</form>
	@else
		<br>
		<div id="radnik-kupac">
			<u><b>Radnik:</b> {{ Radnici::find(Privremena_tabela::radnik())->ime }} {{ Radnici::find(Privremena_tabela::radnik())->prezime }}</u>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<u><b>Kupac:</b> {{ Buyers::find(Privremena_tabela::kupac())->naziv }}</u>
		</div>
		<br>
	@endif
	<div class="table-responsive table-hover">
		<table id="myTable" class="table table-sm" style="max-width: 79%; float: right; table-layout: fixed;">
		  	<thead>
			    <tr style="text-align: center;">
					<th style="padding:10px;">{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
		  	</thead>
		  	<tbody >
			    @foreach(DB::table('grupa_proizvoda')->get() as $key1 => $grupa)
					<td><h5><b>{{ $grupa->naziv_grupe }}</b></h5></td>
					@foreach(DB::table('proizvodi')->get() as $proizvod)
			    		@if($grupa->grupa_id == $proizvod->grupa_proizvoda)			    			
				    		<tr style="text-align: center;">
				    			<td style="border-right: 3px solid #f2f2f2;">
				    				<button id="upisi" data-id="{{ cene_datumi::where('proizvod_id', $proizvod->id)->cene }}" data-product="{{ $proizvod->id }}" data-target="#upisKolicineModal" data-toggle="modal" class="btn btn-danger" style="float: right; margin-right: 30px;" >{{ $proizvod->naziv_proizvoda }}</button>
				    			</td>				    							    			
							</tr>																
						@endif
					@endforeach
				@endforeach		
			</tbody>				
		</table>
		@include('pages.tabela')
	</div>
</div>

<div id="upisKolicineModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
	@include('modals/live/upisKolicineModal')
</div> 
<div id="potvrdaKupacModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
	@include('modals/live/potvrdaKupacModal')
</div> 
</body>
</html>
