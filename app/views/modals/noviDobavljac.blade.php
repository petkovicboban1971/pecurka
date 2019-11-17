
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(192, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action='/noviDobavljac' name="noviDobavljac" method="post">
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-6 control-label" style="text-align: right; ">{{ AdminOptions::lang(194, Session::get('jezik.AdminOptions::server()')) }}:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control input-sm invoice-amt" name="noviDobavljac">
          </div>        
        </div>
        <div class="form-group row">
          <label class="col-sm-6 control-label" style="text-align: right; ">{{ AdminOptions::lang(264, Session::get('jezik.AdminOptions::server()')) }}:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control input-sm invoice-amt" name="adresa">
          </div>        
        </div>
        <div class="form-group row">
          <label class="col-sm-6 control-label" style="text-align: right; ">{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control input-sm invoice-amt" name="ziro_racun">
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
