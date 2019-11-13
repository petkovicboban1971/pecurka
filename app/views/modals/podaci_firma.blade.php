<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                {{ AdminOptions::lang(9, Session::get('jezik.AdminOptions::server()')) }}
            </h4>
        </div>
        <form action="/podaci_firma" name="podaci_firma" method="POST" >
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-4 control-label">
                        {{ AdminOptions::lang(263, Session::get('jezik.AdminOptions::server()')) }}
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm invoice-amt" name="ime_firme" placeholder="{{ !empty(Firma::first()->naziv) ? Firma::first()->naziv : '' }}" autocomplete="off">
                    </div>       
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">
                        {{ AdminOptions::lang(264, Session::get('jezik.AdminOptions::server()')) }}
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm cheque-amt" name="adresa" placeholder="{{ !empty(Firma::first()->adresa) ? Firma::first()->adresa : '' }}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">
                        {{ AdminOptions::lang(265, Session::get('jezik.AdminOptions::server()')) }}
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm cheque-amt" name="telefon" placeholder="{{ !empty(Firma::first()->telefon) ? Firma::first()->telefon : '' }}" autocomplete="off">
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