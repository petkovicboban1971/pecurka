<style type="text/css">
    *{
        box-sizing: border-box;
    }
    td{
      width: 500px;
    }
    .navbar1 {
        width: 100%;
        overflow: auto;
        color: #000;
    }
</style>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" style="font-weight: bold; font-size: 15pt; color: #000;">{{ AdminOptions::lang(215,                                   Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>
      <div class="modal-body">
        <!-- <div class="form-group row">
          <label class="col-sm-4 control-label">{{ AdminOptions::lang(216, Session::get('jezik.AdminOptions::server()')) }}</label>
          <div class="col-sm-8">
            <p>25</p>
          </div>        
        </div>
         -->

          <table class="navbar1">
              <!--  <thead>
                  <tr>
                      <td style="margin-bottom: 5px; font-size: 14pt; color: #000;">{{ AdminOptions::lang(215,                                   Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                  </tr>
              </thead> -->
              <tbody>
                  <tr>
                      <td>
                          {{ AdminOptions::lang(219, Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                      <td>
                          {{ AdminOptions::lang(216, Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                      <td>
                          {{ AdminOptions::lang(217, Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                      <td>
                          {{ AdminOptions::lang(181, Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                      <td>
                          {{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                      <td>
                          {{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}
                      </td>
                  </tr>
                  @foreach(DB::table('kupci')->get() as $naziv)
                    <tr>
                        <th>{{ $naziv->naziv }}</th>
                        <th></th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                    </tr>
                  @endforeach
              </tbody>
          </table>

      </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>
  </div>
</div>
