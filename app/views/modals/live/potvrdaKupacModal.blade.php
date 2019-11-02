<style type="text/css">
    #prvi{
        position: relative;
        right: 17px;
        margin-left: 15px;
    }
</style>
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">       
            <center>
                {{ AdminOptions::lang(132, Session::get('jezik.AdminOptions::server()')) }} <br><br><br><b>{{ Radnici::find(Privremena_tabela::radnik())->ime }} {{ Radnici::find(Privremena_tabela::radnik())->prezime }}</b>?
            </center>
            <br>
        </div>
        <div class="modal-footer">             
            <div id="prvi">
                <form action="/konacno-zaduzenje/{{ Privremena_tabela::radnik() }}">
                    <button type="submit" class="btn btn-success" >
                        {{ AdminOptions::lang(71, Session::get('jezik.AdminOptions::server()')) }}
                    </button>
                </form>
            </div>
            <form action="/zaduzenje-radnika1" method="post">
                <button type="submit" class="btn btn-danger" style="color: white;">
                    {{ AdminOptions::lang(72, Session::get('jezik.AdminOptions::server()')) }}
                </button>
                <input type="hidden" name="radnik" value="{{ Privremena_tabela::radnik() }}">
            </form>
        </div>
    </div>
</div>