<!-- Edit Modal HTML -->
<!-- @if (Session::get('logovan') == 0)
        <script>
            window.location.replace("/admin");
        </script>
@endif -->
  <div id="NoviPacijent" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action='/novi-pacijent' method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Unos novog pacijenta</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Ime i prezime</label>
              <input type="text" name="ime" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Datum rođenja</label>
              <input type="text" name="jmbg" placeholder="Format d.m.GGGG." class="form-control" required>
            </div>
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Adresa</label>
              <textarea class="form-control" name="adresa"></textarea>
            </div>
            <div class="form-group">
              <label>Telefon</label>
              <input type="text" name="telefon" class="form-control" required>
            </div>          
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Odustani">
            <input type="submit" class="btn btn-success" value="Snimi">
          </div>
        </form>
      </div>
    </div>
  </div>
  