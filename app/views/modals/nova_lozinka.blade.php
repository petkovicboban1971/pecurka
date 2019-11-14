<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                {{ AdminOptions::lang(41, Session::get('jezik.AdminOptions::server()')) }}:
                {{ radnici::find(Session::get('log_sesija'.AdminOptions::server()))->ime }}
            </h4>
        </div>
        <form action="/nova_lozinka" name="nova_lozinka" method="POST" >
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-6 control-label">
                        {{ AdminOptions::lang(268, Session::get('jezik.AdminOptions::server()')) }}
                    </label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control input-sm invoice-amt" name="stara_lozinka" autocomplete="off" required>
                    </div>       
                </div>
                <div class="form-group row">
                    <label class="col-sm-6 control-label">
                        {{ AdminOptions::lang(269, Session::get('jezik.AdminOptions::server()')) }}
                    </label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control input-sm cheque-amt" name="nova_lozinka1" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-6 control-label">
                        {{ AdminOptions::lang(270, Session::get('jezik.AdminOptions::server()')) }}
                    </label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control input-sm cheque-amt" name="nova_lozinka2" autocomplete="off" required>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info waves-effect waves-light">
                    {{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}
                </button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">
                    {{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}
                </button>
            </div>
        </form>
    </div>
</div>