<style type="text/css">
  .row {
  margin-right: 0%;
  margin-left: 0%;
  }
  .izbor_magacin{
    width: 160px !important;
    margin: 5px !important;
  }
</style>

<div id="izbor_magacin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
      <center>
        <span class="modal-title">  
          {{ AdminOptions::lang(252, Session::get('jezik.AdminOptions::server()')) }}
        </span>
      </center>
    </div>
      <div class="modal-body">
        <!--<div class="form-group row"> 
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(84, Session::get('jezik.AdminOptions::server()')) }}</label> --> 
            <center>   
                @foreach($magacini as $magacin)
                      <a href="/zaduzeniRadnik3/{{ $magacin->id }}/{{ $radnik->id }}" style="font-size: 15pt;">{{ AdminOptions::lang($magacin->naziv_magacina, Session::get('jezik.AdminOptions::server()')) }}</a>
                <br>
                @endforeach 
              <!-- <input type="text" class="form-control input-sm invoice-amt" placeholder="{{ AdminOptions::lang($magacin->naziv_magacina, Session::get('jezik.AdminOptions::server()')) }}" name="naziv_magacina"> -->
            </center>      
      <!--   
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
    -->
  </div>
</div>
</div>