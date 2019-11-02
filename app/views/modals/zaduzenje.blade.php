<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ AdminOptions::lang(6, Session::get('jezik.AdminOptions::server()')) }}</h4>
        </div>
			<div class="modal-body">
				test
           	</div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-info waves-effect waves-light">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
        </div>
        </form>
      </div>
    </div>
  </div>