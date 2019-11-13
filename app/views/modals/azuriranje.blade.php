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
      <h4 class="modal-title">{{ AdminOptions::lang(69, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form method="post" action="{{ AdminOptions::base_url() }}admin-update-worker/{{ $data->id }}">
    <div class="modal-body">
      <div class="form-group row">

        <label class="col-sm-4 control-label">{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="ime" class="form-control input-sm invoice-amt" Placeholder="{{ $data->ime }}" autocomplete="off">
        </div>
      
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(53, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8" >
          <input type="text" name="prezime" class="form-control input-sm cheque-amt" Placeholder="{{ $data->prezime }}" autocomplete="off">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="grad" class="form-control input-sm" Placeholder="{{ $data->grad }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="ulica" class="form-control input-sm" Placeholder="{{ $data->ulica }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="broj" class="form-control input-sm" Placeholder="{{ $data->broj }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(57, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="jmbg" class="form-control input-sm" Placeholder="{{ $data->jmbg }}"autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(58, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="brlk" class="form-control input-sm" Placeholder="{{ $data->brlk }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(59, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="text" name="pu" class="form-control input-sm" Placeholder="{{ $data->pu }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label">{{ AdminOptions::lang(148, Session::get('jezik.AdminOptions::server()')) }}</label>
        <div class="col-sm-8">
          <input type="number" step="0.01" min="0" lang="en" class="form-control input-sm" name="plata" placeholder="{{ AdminOptions::lang(147, Session::get('jezik.AdminOptions::server()')) }} {{ Firma::valuta() }}" autocomplete="off">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label"> </label>
        <div class="col-sm-8">
          <input type="number" step="0.01" min="0" lang="en" class="form-control input-sm" name="procenat" placeholder="{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }} %" autocomplete="off">
        </div>
      </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="sel1">{{ AdminOptions::lang(61, Session::get('jezik.AdminOptions::server()')) }}</label>
        <select class="form-group row" id="sel1" name="status" autocomplete="off">
          <option value="0" selected></option>
          <option value="1">{{ AdminOptions::lang(76, Session::get('jezik.AdminOptions::server()')) }}</option>
          <option value="2">{{ AdminOptions::lang(77, Session::get('jezik.AdminOptions::server()')) }}</option>
          <option value="3">{{ AdminOptions::lang(78, Session::get('jezik.AdminOptions::server()')) }}</option>
        </select>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label" for="sel1">{{ AdminOptions::lang(64, Session::get('jezik.AdminOptions::server()')) }}</label>
        <select class="form-group row" id="sel1" name="rola" autocomplete="off">
          <option value="0" selected></option>
          <option value="1">{{ AdminOptions::lang(79, Session::get('jezik.AdminOptions::server()')) }}</option>
          <option value="2">{{ AdminOptions::lang(80, Session::get('jezik.AdminOptions::server()')) }}</option>
          <option value="3">{{ AdminOptions::lang(81, Session::get('jezik.AdminOptions::server()')) }}</option>
          <option value="4">{{ AdminOptions::lang(82, Session::get('jezik.AdminOptions::server()')) }}</option>
        </select>
      </div> 
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info confirm-btn waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
    </div>
    </form>
  </div>
</div>