
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(45, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action='/admin-save-item' name="UnosNoveStavke" method="post">
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(46, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" name="NovaStavka">
          </div>        
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(18, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm cheque-amt" name="NabavnaCena" autocomplete="off">
          </div>
        </div>        
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(19, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="Porez" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(20, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="Marza" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="Dobavljac" autocomplete="off">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>
