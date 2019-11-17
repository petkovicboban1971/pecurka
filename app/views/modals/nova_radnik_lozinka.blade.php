<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                {{ AdminOptions::lang(275, Session::get('jezik.AdminOptions::server()')) }}
            </h4>
        </div>
        <form action="/nova_radnik_lozinka" method="POST" autocomplete="off">       
            <div class="modal-body">
                <br>
                <div class="col-sm-4" style="margin-left: 5vh;">
                    @foreach($radnici as $radnik)
                        {{ $radnik->ime }} {{ $radnik->prezime }}: {{ $radnik->lozinka }}<br>
                    @endforeach
                </div>
                <div class="radnik_lozinka">
                    <select name="radnik" required style="width: auto;">
                        <option selected disabled>
                            {{ AdminOptions::lang(60, Session::get('jezik.AdminOptions::server()')) }}
                        </option>
                        @foreach($radnici as $radnik)
                            <option value="{{ $radnik->id }}" class="nova_radnik_lozinka">
                                {{ $radnik->ime }} {{ $radnik->prezime }}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-5 control-label">
                            {{ AdminOptions::lang(269, Session::get('jezik.AdminOptions::server()')) }}
                        </label>
                        <div class="col-sm-4" style="width: auto; float: right;">
                            <input type="password" class="form-control input-sm cheque-amt" name="nova_lozinka1" autocomplete="off" required>
                        </div><!-- 
                    </div>
                    <div class="form-group row">
 -->                    <br><br>    
                        <label class="col-sm-5 control-label">
                            {{ AdminOptions::lang(270, Session::get('jezik.AdminOptions::server()')) }}
                        </label>
                        <div class="col-sm-4" style="width: auto; float: right;">
                            <input type="password" class="form-control input-sm cheque-amt" name="nova_lozinka2" autocomplete="off" required>
                        </div>
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