<style type="text/css">
  .row {
  margin-right: 0%;
  margin-left: 0%;
  }
</style>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(83, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action="{{ AdminOptions::base_url() }}admin-update-group/{{ $data->id }}" method="POST" >
      <div class="modal-body"><br>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(84, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8"><br>
            <input type="text" class="form-control input-sm invoice-amt" placeholder="{{ $data->naziv_grupe }}" name="naziv_grupe">
          </div>       
        
      <div class="modal-footer"><br><br><br>
        <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>