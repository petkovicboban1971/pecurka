
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ AdminOptions::lang(83, Session::get('jezik.AdminOptions::server()')) }}</h4>
    </div>   
    <div class="modal-body"><br>
      <div class="d-flex p-3 bg-success text-black">
        <tbody>
          <tr>&nbsp;
            <div class="p-2 "><td><input type="number" step="0.01" min="0" lang="en" name="kolicina" size="6" placeholder="kolicina"></td></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="p-2 "><td><input type="number" step="0.01" min="0" lang="en" name="marza" size="6" placeholder="marza"></td></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="p-2 "><td><input type="number" step="0.01" min="0" lang="en" name="zarRad" size="6" placeholder="zarada radnika"></td></div>            
          </tr>
        </tbody>
      </div>  
    </div>  
      <div class="modal-footer"><br><br><br>
        <button type="submit" class="btn btn-success">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
      </div>    
  </div>
</div>
