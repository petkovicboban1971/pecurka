<div style="color: white">
<?php 
  $xml=simplexml_load_file("list_one.xml") or die("Error: Cannot create object");
  //print_r($xml);die();
 ?></div>
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(131, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
    <form method="get" action="{{ AdminOptions::base_url() }}admin-valute">
      <div class="modal-body">
        
        <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(130, Session::get('jezik.AdminOptions::server()')) }}</label>
          
          <select class="form-group row col-sm-8" id="sel10" name="valuta" autocomplete="off">
            @foreach($xml->CcyTbl->CcyNtry as $curr)              
              <option name="valuta" value="{{ $curr->Ccy }}" >{{ $curr->CtryNm  }} - {{ $curr->Ccy  }}</option>           
            @endforeach
          </select>
        </div>
        
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-info confirm-btn waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    </form>
  </div>
</div>