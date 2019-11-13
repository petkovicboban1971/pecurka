
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ AdminOptions::lang(123, Session::get('jezik.AdminOptions::server()')) }}</h4>
        </div> 
        <form action="/zaduzeniRadnik5">  
            <div class="modal-body">
                <center> 
                    <table>
                        <th>
                            <td>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td>
                        </th>
                    </table><br>
                    <input style="height: 25px; margin: 3px; text-align: center;" type="number" step="0.01" min="0" lang="en" name="kolicina" size="5" required>
                    <input type="hidden" name="radnik" value="{{ $radnik }}">
                </center>          
            </div>  
            <div class="modal-footer justify-content-center">
                <button type="submit" class="upisKolicine btn btn-success">{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>
                <button type="submit" class="upisKolicine btn btn-danger">{{ AdminOptions::lang(24, Session::get('jezik.AdminOptions::server()')) }}</button>
            </div> 
        </form> 
    </div>    
</div>
