<!DOCTYPE html>
<html lang="en">
<!-- @if (Session::get('log_sesija') == 0)
    <script>
        window.location.replace("/admin");
    </script>
@endif -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/tabelaIstorija.css">
<link rel="stylesheet" href="css/alertify.core.css">
<link rel="stylesheet" href="css/alertify.default.css">
<script src="js/alertify.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
     
    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
              this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
              this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
          $("#selectAll").prop("checked", false);
        }
    });
    $('.delete1').on('click', function(e){
        e.preventDefault();
        var link = $(this).data('link');
        alertify.confirm("Da li ste sigurni da želite da izvršite brisanje?",
            function(e){
                if(e){
                    location.href = link;
                }
            });
    });
});
</script>
</head>
<body>
    @if(!empty(Session::get('message')))
        <script>
            alertify.error( "<?php echo Session::get('message') ?>"  );
        </script>
        <?php Session::forget('message');  ?>
    @endif
    @if(!empty(Session::get('update')))
        <script>
            alertify.success( "<?php echo Session::get('update') ?>" );
        </script>
        <?php Session::forget('update');  ?>
    @endif
    

    <?php 
        $tref = 0;
        $tref1 = 0;
        $tref2 = 0;
        $suma1 = array();
        unset($suma1);
        $suma2 = array();
        unset($suma2);
        $suma = array(); 
        unset($suma);
    ?>

    <a href="/admin-welcome" data-toggle="tooltip" title="{{ AdminOptions::lang(156, Session::get('jezik.AdminOptions::server()')) }}" style="position: absolute; margin-left: 50px;  margin-top: 50px;">
        <i class="fa fa-caret-left" style="font-size:48px;"></i>
    </a>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>{{ AdminOptions::lang(153, Session::get('jezik.AdminOptions::server()')) }}</b></h2>
                    </div>
                </div>
            </div>            
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="clear: both; padding-left: 50px;">{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th style="padding-left: 150px;">{{ AdminOptions::lang(162, Session::get('jezik.AdminOptions::server()')).' '. 1}} (kg)</th>
                        <th style="clear: both; padding-left: -150px;">{{ AdminOptions::lang(162, Session::get('jezik.AdminOptions::server()')).' '. 2}} (kg)</th>

                        <th style="padding-right: 70px;">{{ AdminOptions::lang(163, Session::get('jezik.AdminOptions::server()')) }} (kg)</th>
                    </tr>
                </thead>
                <tbody>                    
                    @foreach($products as $key => $test)
                        @if((($stranica-1)*15 < $key+1) && ($key < $stranica*15))
                            <tr>  
                                <td style="clear: both; padding-left: 50px;">{{ $test->naziv_proizvoda }}</td>
                                <td style="clear: both; padding-left: 150px;">
                                    @foreach($magacin1 as $key1 => $test1)
                                        @if($test1->proizvod_id == $test->id)
                                            {{ $test1->kolicina }}
                                        @endif
                                        <?php 
                                            $tref1 = $tref1 + $test1->kolicina; 
                                            $suma1[$key1] = $tref1;
                                        ?>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($magacin2 as $key2 => $test2)
                                        @if($test2->proizvod_id == $test->id)
                                            {{ $test2->kolicina }}
                                        @endif
                                        <?php 
                                            $tref2 = $tref2 + $test2->kolicina;
                                            $suma2[$key2] = $tref2;
                                        ?>
                                    @endforeach
                                </td>
                                <td>
                                    <?php  for($keya = 0; $keya < count($products); $keya ++){
                                        if (empty($suma1[$keya])) {
                                            $suma1[$keya] = 0;      
                                        } 
                                        if (empty($suma2[$keya])) {
                                            $suma2[$keya] = 0;      
                                        }    
                                            $tref = $suma1[$keya] + $suma2[$keya]; 
                                        echo $tref." ";
                                        $tref = 0;
                                    } 
                                    //echo $tref;
                                      ?>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <?php $prom = "stanjeMagacina"; ?>
        @include('partials/pagination')
      </div>
  </div>
</body>
</html>                                                               