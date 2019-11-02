<!DOCTYPE html>
<html>
<head>
  <title></title>
  
</head>
<body>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<style type="text/css">
 .modal-header {
    padding:9px 15px;
    border-bottom:4px solid #cccccc;
    background-color: #ffa31a;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
 }
 .modal-footer
{
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    border-bottom:10px solid #ffa31a;
    -webkit-border-bottom-left-radius: 6px;
    -webkit-border-bottom-right-radius: 6px;
    -moz-border-radius-bottomleft: 6px;
    -moz-border-radius-bottomright: 6px;
}
</style>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">{{ AdminOptions::lang(48, Session::get('jezik.AdminOptions::server()')) }}</h4>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-4 control-label">{{ AdminOptions::lang(16, Session::get('jezik.AdminOptions::server()')) }}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm invoice-amt" placeholder="{{ $data->ulazna_stavka}}">
            </div>
          
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label">{{ AdminOptions::lang(18, Session::get('jezik.AdminOptions::server()')) }}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm cheque-amt" Placeholder="{{$data->ulazna_stavka_nabavna_cena}}">
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 control-label">{{ AdminOptions::lang(19, Session::get('jezik.AdminOptions::server()')) }}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm" Placeholder="{{$data->ulazna_stavka_porez}}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label">{{ AdminOptions::lang(20, Session::get('jezik.AdminOptions::server()')) }}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm" Placeholder="{{$data->ulazna_stavka_zaracunata_marza}}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label">{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-sm" Placeholder="{{$data->ulazna_stavka_dobavljac}}">
            </div>
          </div>
          


        </div>
        <div class="modal-footer">

            <button type="submit" class="btn btn-info confirm-btn waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
            <button type="button" class="btn btn-primary waves-effect waves-light">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
        </div>
      </div>
    </div>
  </div>   
</body>
</body>
</html>