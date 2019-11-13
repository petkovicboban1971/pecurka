
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(103, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form action='/admin-new-product' name="UnosNovogProizvoda" method="post">
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="text" class="form-control input-sm invoice-amt" name="naziv_proizvoda" required>
          </div>        
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label" for="sel10">{{ AdminOptions::lang(98, Session::get('jezik.AdminOptions::server()')) }}</label>
          <select class="form-group row" id="sel10" name="grupa_proizvoda" autocomplete="off" required>
            <option selected disabled>
              {{ AdminOptions::lang(190, Session::get('jezik.AdminOptions::server()')) }}
            </option>
            @foreach(DB::table('grupa_proizvoda')->get() as $product)
              <option value="{{ $product->grupa_id }}" >{{ $product->naziv_grupe }}</option>
            @endforeach
          </select>
        </div> 
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(105, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="number" step="0.01" min="0" lang="en" id="cena_proizvoda1" class="form-control input-sm cheque-amt" name="cena_proizvoda" autocomplete="off" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(219, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <input type="number" step="0.01" min="0" lang="en" id="cena_proizvoda1" class="form-control input-sm cheque-amt" name="proizvodna_cena" autocomplete="off" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="checkbox2" class="col-sm-4 control-label">komadni proizvod</label>
          <span>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="checkbox2" name="check" value="1">&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="number" step="0.01" min="0" lang="en" id="tezina_pakovanja" name="tezina_pakovanja" autocomplete="off" placeholder="tezina pakovanja (gr)" required disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="number" step="0.01" min="0" lang="en" id="cena_pakovanja" name="cena_proizvoda" autocomplete="off" placeholder="cena pakovanja" required disabled="true"> 
          </span>
        </div> 
      </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>
