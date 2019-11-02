<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(65, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action="/admin-new-buyer" name="UnosNovogKupca" method="POST" >
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(84, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" name="NoviKupac" required>
          </div>       
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm cheque-amt" name="Grad" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm cheque-amt" name="Ulica" autocomplete="off">
          </div>
        </div>        
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="Broj" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(86, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="Pib" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name="Racun" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(208, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <select class="form-control input-sm" name="grupa_kupac" autocomplete="off">
              <option value="0">
                  {{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}
              </option>
              @foreach(DB::table('kupci')->where('aktivan', 1)->get() as $kupac )
                <option value="{{ $kupac->id }}">
                    {{ $kupac->naziv }}
                </option>
              @endforeach
            </select>
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