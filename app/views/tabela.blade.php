<!DOCTYPE html>
<html lang="en">
<!-- @if (Session::get('logovan') == 0)
    <script>
        window.location.replace("/admin");
    </script>
@endif -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pacijenti</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
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
    <?php if (!empty($data1)){ ?>

        @include('pacijenti/modalAzurPacijenta')
        <script type="text/javascript">
            $(window).load(function(){
                $('#azuriranjePacijenta').modal('show');
            });
        </script>
     <?php 
        }  
        else {
    ?> 
    <a href="/menu" style="position: absolute; margin-left: 50px;  margin-top: 50px;">
        <i class="fa fa-caret-left" style="font-size:48px;"></i>
    </a>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Pacijenti</b></h2>
                    </div>
                    <div class="col-sm-6">
                      <a href="#NoviPacijent" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Unos novog pacijenta</span></a>         
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(53, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(57, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(58, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(64, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(147, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(61, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
                        <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
                    </tr>
                </thead>
                <tbody>                    
                    @foreach($data as $key => $test)
                        @if((($stranica-1)*10 < $key+1) && ($key < $stranica*10))
                            <tr>  
                                <td>{{ $test->ime }}</td>
                                <td>{{ $test->prezime }}</td>
                                <td>{{ $test->grad }}</td>
                                <td>{{ $test->ulica }}</td>
                                <td>{{ $test->broj }}</td>
                                <td>{{ $test->jmbg }}</td>
                                <td>{{ $test->brlk }}</td>
                                <td>{{ $test->rola }}</td><!-- 
                                <td>{{ ($test->status == 1) ? "DA" : "NE" }}</td> -->
                                <td>{{ $test->nacin_zarade }}</td>
                                <td>{{ $test->nacin_zarade1 }}</td>
                                <td>{{ $test->status }}</td>
                            
                               
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                    <a href="/azuriranjePacijenta/{{ $test->id }}/{{ $stranica }}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Uredi podatke o pacijentu">&#xE254;</i></a>
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="" class="delete delete1" data-link="/brisanje-pacijenta/{{ $test->id }}/{{ $stranica }}"><i class="material-icons" data-toggle="tooltip" title="Obriši podatke o pacijentu">&#xE872;</i>&nbsp;</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <?php $prom = "radnici"; ?>
        @include('partials/pagination')
      </div>
  </div>
<?php } ?>
  @include('modals/modalNoviPacijent')
</body>
</html>                                                               