<!DOCTYPE html>
<html lang="en">
@if (Session::get('logovan') == 0)
    <script>
        window.location.replace("/admin");
    </script>
@endif
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pacijenti</title>
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
                      <!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>   -->          
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <!-- <th>
                          <span class="custom-checkbox">
                            <input type="checkbox" id="selectAll">
                            <label for="selectAll"></label>
                          </span>
                        </th> -->
                        <th>Ime</th>
                        <th>Datum rođenja</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Adresa</th>
                        <th>Aktivan</th>
                        <th>Upisan dana:</th>
                        <th>Upisao:</th>
                        <th>Ažurirano dana:</th>
                        <th>Ažurirao:</th>
                        <th>Istorija</th>
                        <th>Ažuriranje:</th>
                        <th>Brisanje podataka:</th>
                        <!--<th>Poruka</th>
                        <th>Poruka poslata</th>
                        <th>Potvrdio tel.pozivom</th>
                        <th>Tretman overio</th>
                        <th>Termin otkazao</th> -->
                    </tr>
                </thead>
                <tbody>                    
                    @foreach($data as $key => $test)
                        @if((($stranica-1)*10 < $key+1) && ($key < $stranica*10))
                            <tr>  
                                <td>{{ $test->ime }}</td>
                                <td>{{ $test->jmbg }}</td>
                                <td>{{ $test->email }}</td>
                                <td>{{ $test->telefon }}</td>
                                <td>{{ $test->adresa }}</td>
                                <td>{{ ($test->aktivan == 1) ? "DA" : "NE" }}</td>
                                <td>{{ date_format(date_create($test->created_at), "d.m.Y.") }}</td>@if($test->kreirao == 9999)
                                    <td>Online</td>
                                @else
                                    <td>{{ Osoblje::find($test->kreirao)->naziv }}</td>
                                @endif
                                <td>{{ date_format(date_create($test->updated_at), "d.m.Y.") }}</td>
                                @if($test->kreirao == 9999)
                                    <td>Online</td>
                                @else
                                    <td>{{ Osoblje::find($test->menjao)->naziv }}</td>
                                @endif
                                @if((DB::table('termini')->where('termini_id', $test->id)->pluck('odradjen') == 1) OR 
                                (DB::table('termini')->where('termini_id', $test->id)->pluck('otkaz') == 1) OR 
                                (DB::table('termini')->where('termini_id', $test->id)->pluck('potvrda') == 1))
                                    <td><a href="/istorija-pacijenta/{{ $test->id }}" data-toggle="tooltip" title="Istorija tretmana pacijenta">Istorija</a></td>
                                @else                                    
                                    <td><a data-toggle="tooltip" title="Nema evidentiranih intervencija">Istorija</a></td>
                                @endif
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
            <!-- <td>
              <span class="custom-checkbox">
                <input type="checkbox" id="checkbox2" name="options[]" value="1">
                <label for="checkbox2"></label>
              </span>
            </td>
                        <td>Dominique Perrier</td>
                        <td>dominiqueperrier@mail.com</td>
            <td>Obere Str. 57, Berlin, Germany</td>
                        <td>(313) 555-5735</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
          <tr>
            <td>
              <span class="custom-checkbox">
                <input type="checkbox" id="checkbox3" name="options[]" value="1">
                <label for="checkbox3"></label>
              </span>
            </td>
                        <td>Maria Anders</td>
                        <td>mariaanders@mail.com</td>
            <td>25, rue Lauriston, Paris, France</td>
                        <td>(503) 555-9931</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
            <td>
              <span class="custom-checkbox">
                <input type="checkbox" id="checkbox4" name="options[]" value="1">
                <label for="checkbox4"></label>
              </span>
            </td>
                        <td>Fran Wilson</td>
                        <td>franwilson@mail.com</td>
            <td>C/ Araquil, 67, Madrid, Spain</td>
                        <td>(204) 619-5731</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>         
          <tr>
            <td>
              <span class="custom-checkbox">
                <input type="checkbox" id="checkbox5" name="options[]" value="1">
                <label for="checkbox5"></label>
              </span>
            </td>
                        <td>Martin Blank</td>
                        <td>martinblank@mail.com</td>
            <td>Via Monte Bianco 34, Turin, Italy</td>
                        <td>(480) 631-2097</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
            <td>
              <span class="custom-checkbox">
                <input type="checkbox" id="checkbox5" name="options[]" value="1">
                <label for="checkbox5"></label>
              </span>
            </td>
                        <td>Martin Blank</td>
                        <td>martinblank@mail.com</td>
            <td>Via Monte Bianco 34, Turin, Italy</td>
                        <td>(480) 631-2097</td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>  -->
                </tbody>
            </table>
            <?php $prom = "pacijenti"; ?>
        @include('partials/pagination')
      </div>
  </div>
<?php } ?>
  @include('pacijenti/modalNoviPacijent')
  <!-- Delete Modal HTML -->
  <!-- <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form>
          <div class="modal-header">            
            <h4 class="modal-title">Brisanje podataka</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <p>Da li ste sigurni da želite da obrišete podatke?</p>
            <p class="text-warning"><small>Ova operacija se ne može poništiti.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Otkaži">
            <input type="submit" class="btn btn-danger" value="Obriši">
          </div>
        </form>
      </div>
    </div>
  </div> -->
</body>
</html>                                                               