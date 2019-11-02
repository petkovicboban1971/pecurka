<style type="text/css">
  select{
    position: relative; left: 15px;
    width: 345px;
  }
</style>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(6, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action='{{ AdminOptions::base_url() }}admin-save-worker' name="UnosNovogRadnika" method="post">
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" name="ime" autocomplete="off">
          </div>      
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(53, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm cheque-amt" name="prezime" autocomplete="off">
          </div>
        </div>      
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="grad" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="ulica" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="broj" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(57, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="jmbg" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(58, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="brlk" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(59, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="pu" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(148, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="plata" placeholder="{{ AdminOptions::lang(147, Session::get('jezik.AdminOptions::server()')) }} {{ Firma::valuta() }}" autocomplete="off">
          </div>
          <div class="col-sm-8"><br>
            <input type="text" min="0" step=".01" class="form-control input-sm" name="procenat" placeholder="{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }} %" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label" for="sel1">{{ AdminOptions::lang(61, Session::get('jezik.AdminOptions::server()')) }}</label>
          <select class="form-group row" id="sel1" name="status">
            <option value="0" selected></option>
            <option value="1">{{ AdminOptions::lang(76, Session::get('jezik.AdminOptions::server()')) }}</option>
            <option value="2">{{ AdminOptions::lang(77, Session::get('jezik.AdminOptions::server()')) }}</option>
            <option value="3">{{ AdminOptions::lang(78, Session::get('jezik.AdminOptions::server()')) }}</option>
          </select>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label" for="sel1">{{ AdminOptions::lang(64, Session::get('jezik.AdminOptions::server()')) }}</label>
          <select class="form-group row" id="sel1" name="rola">
            <option value="0" selected></option>
            <option value="1">{{ AdminOptions::lang(79, Session::get('jezik.AdminOptions::server()')) }}</option>
            <option value="2">{{ AdminOptions::lang(80, Session::get('jezik.AdminOptions::server()')) }}</option>
            <option value="3">{{ AdminOptions::lang(81, Session::get('jezik.AdminOptions::server()')) }}</option>
            <option value="4">{{ AdminOptions::lang(82, Session::get('jezik.AdminOptions::server()')) }}</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>
