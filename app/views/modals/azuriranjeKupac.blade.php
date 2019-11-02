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
      <h4 class="modal-title">{{ AdminOptions::lang(83, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action="{{ AdminOptions::base_url() }}admin-update-buyer/{{ $data->id }}" method="POST" >
      <div class="modal-body" id="orderDetails">
        <div class="form-group row">

          <label class="col-sm-4 control-label">{{ AdminOptions::lang(84, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" placeholder="{{ $data->naziv }}" name="naziv">
          </div>       
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm cheque-amt" placeholder="{{ $data->grad }}" name="grad" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm cheque-amt" placeholder="{{ $data->ulica }}" name="ulica" autocomplete="off">
          </div>
        </div>        
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" placeholder="{{ $data->broj }}" name="broj" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(86, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" placeholder="{{ $data->PIB }}" name="PIB" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" placeholder="{{ $data->racun }}" name="racun" autocomplete="off">
          </div>
        </div>
          <select class="form-group row input-sm" name="grupa_kupac" autocomplete="off">
            <option value="0">
                {{ AdminOptions::lang(209, Session::get('jezik.AdminOptions::server()')) }}
            </option>
            @foreach(DB::table('kupci')->where('aktivan', 1)->where('grupa_kupac', 0)->get() as $kupac )
              <option value="{{ $kupac->id }}">
                  {{ $kupac->naziv }}
              </option>
            @endforeach
          </select>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>