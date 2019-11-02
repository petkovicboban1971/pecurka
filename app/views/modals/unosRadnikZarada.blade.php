<style type="text/css">
  select{
    position: relative; left: 15px;
  }
</style>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(63, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action='/admin-way-earning' name="nacinZarade" method="post">
      <div class="modal-body">      
        <div class="form-group row">
          <label class="col-sm-4 control-label" for="sel1">{{ AdminOptions::lang(60, Session::get('jezik.AdminOptions::server()')) }}</label>
          <select class="form-group row" id="sel1" name="izabraniRadnik">
            @foreach(DB::table('radnici')->get() as $rem)
              <option value="{{ $rem->id }}">{{ $rem->ime }} {{ $rem->prezime}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label" for="sel1">{{ AdminOptions::lang(73, Session::get('jezik.AdminOptions::server()')) }}</label>
          <select class="form-group row" id="sel2" name="nacinZarade" >
              <option value="0" selected></option>
              <option value="1">{{ AdminOptions::lang(74, Session::get('jezik.AdminOptions::server()')) }}</option>
              <option value="2">{{ AdminOptions::lang(75, Session::get('jezik.AdminOptions::server()')) }}</option>
          </select>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" name="ime" autocomplete="off">
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