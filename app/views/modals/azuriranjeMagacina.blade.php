
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(285, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action='/magacin_edit1' name="azuriranjeMagacina" method="post">
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(284, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" name="NoviNazivMagacina" id="naziv">
            <input type="hidden" name="magacin_id" id="indeks">
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
