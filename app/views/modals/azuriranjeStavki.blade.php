<style type="text/css">
  select{
    position: relative; left: 32px;
    width: 363px;
  }
  .form-group{
    height: 28px;
  }
  .form-control .invoice-amt{
    padding: 1px;
  }
  .row {
  margin-right: -15px;
  margin-left: -15px;
  }
</style>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(66, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form method="post" action="{{ AdminOptions::base_url() }}admin-update-item/{{ $data->ulazna_stavka_id }}">
    <div class="modal-body">
      <div class="form-group row">

        <label class="col-sm-4 control-label">{{ AdminOptions::lang(16, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="stavka" class="form-control input-sm invoice-amt" Placeholder="{{ $data->ulazna_stavka }}" autocomplete="off">
        </div>
      
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(18, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8" >
          <input type="text" name="nabavna_cena" class="form-control input-sm cheque-amt" Placeholder="{{ $data->ulazna_stavka_nabavna_cena }}" autocomplete="off">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(19, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="porez" class="form-control input-sm" Placeholder="{{ $data->ulazna_stavka_porez }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(20, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="marza" class="form-control input-sm" Placeholder="{{ $data->ulazna_stavka_zaracunata_marza }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="dobavljac" class="form-control input-sm" Placeholder="{{ $data->ulazna_stavka_dobavljac }}" autocomplete="off">
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info confirm-btn waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
    </div>
    </form>
  </div>
</div>