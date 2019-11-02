<style type="text/css">
  select{
    position: relative; left: 112px;
    width: 58%;
  }
</style>  
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(110, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form method="post" action="/admin-update-product/{{ $data->id }}">
      <div class="modal-body">
        <div class="form-group row">

          <label class="col-sm-4 control-label">{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" name="naziv_proizvoda" class="form-control input-sm invoice-amt" Placeholder="{{ $data->naziv_proizvoda }}" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(109, Session::get('jezik.AdminOptions::server()')) }}</label>
          <select class="form-group row" id="sel10" name="grupa_proizvoda" autocomplete="off">
              <option value="0" selected>{{ AdminOptions::lang(190, Session::get('jezik.AdminOptions::server()')) }}</option>
              @foreach(DB::table('grupa_proizvoda')->get() as $product)
                <option value="{{ $product->grupa_id }}" >{{ $product->naziv_grupe }}</option>
              @endforeach
            </select>
        </div>
        <!--  -->
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(219, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" name="proizvodna_cena" class="form-control input-sm" Placeholder="{{ $data->proizvodna_cena }}" autocomplete="off">
          </div>
        </div>
        <!-- <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(149, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" name="kolicina_proizvoda" class="form-control input-sm" Placeholder="{{ $data->kolicina_proizvoda }}" autocomplete="off">
          </div>
        </div> -->
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-info confirm-btn waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>