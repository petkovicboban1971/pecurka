
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <center>
                                  
                </center>                
            </h4>
        </div> 
        <form action="/privremena-tabela2" method="post">  
            <div class="modal-body">
                <center> 
                    <table style="width: 300px;">
                        <th>
                            <td>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td> 
                            <td>{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</td> 
                            <td>{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }}</td>
                        </th>
                    </table><br>
                    <input style="height: 25px; margin: 3px; text-align: center;" type="number" step="0.01" min="0" lang="en" name="kolicina" size="5" placeholder="Kg">
                    <input style="height: 25px; margin: 3px; text-align: center;" type="text" name="Id" size="5">
                    <input style="height: 25px; margin: 3px; text-align: center;" type="number" step="0.01" min="0" lang="en"name="zarRad" size="5" placeholder="%">
                    <input type="hidden" name="Product"> 
                </center>          
            </div>  
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-success">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
            </div> 
        </form> 
    </div>    
</div>
