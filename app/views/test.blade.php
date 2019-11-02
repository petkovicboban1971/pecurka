<!-- Button trigger modal-->
<!DOCTYPE html>
<html>
  <head>
    @extends('partials/header')
    <link href="{{ AdminOptions::base_url()}}css/foundation.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ AdminOptions::base_url()}}css/admin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  
    <script src="{{ AdminOptions::base_url()}}js/jquery-1.11.2.min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        
  </head>

<!-- Modal: modalCart -->
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ AdminOptions::lang(17, Session::get('jezik.AdminOptions::server()')) }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">

        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ AdminOptions::lang(16, Session::get('jezik.AdminOptions::server()')) }}</th>
              <th>{{ AdminOptions::lang(18, Session::get('jezik.AdminOptions::server()')) }}</th>
              <th>{{ AdminOptions::lang(19, Session::get('jezik.AdminOptions::server()')) }}</th>
              <th>{{ AdminOptions::lang(20, Session::get('jezik.AdminOptions::server()')) }}</th>
              <th>{{ AdminOptions::lang(23, Session::get('jezik.AdminOptions::server()')) }}</th>
              <th>{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</th>
              <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach((DB::table('ulazna_stavka')->get()) as $ulazna_stavka)
            <tr>
              <th scope="row">{{ $ulazna_stavka->ulazna_stavka_id }}</th>
              <td><a>{{ $ulazna_stavka->ulazna_stavka }}</a></td>
              <td><a>{{ $ulazna_stavka->ulazna_stavka_nabavna_cena }}</a></td>
              <td><a>{{ $ulazna_stavka->ulazna_stavka_porez }}%</a></td>
              <td><a>{{ $ulazna_stavka->ulazna_stavka_zaracunata_marza }}%</a></td>
              <td><a>{{ $ulazna_stavka->ulazna_stavka_nabavna_cena * (($ulazna_stavka->ulazna_stavka_porez + $ulazna_stavka->ulazna_stavka_zaracunata_marza)/100 + 1) }}</a></td>
              <td><a>{{ $ulazna_stavka->ulazna_stavka_dobavljac }}</a></td>
              <td><input type="checkbox"></></td>
            </tr>
            @endforeach           
            <tr class="total">
              <th scope="row">5</th>
              <td>Total</td>
              <td>400$</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </div>
  </div>
</div>







  </body>


</html>