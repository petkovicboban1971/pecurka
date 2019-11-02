
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <table style="width: 100%; border-collapse: collapse; text-align: center;">
                    <th>
                        <td>{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</td>
                        <td>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td>
                        <td>{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</td>
                        <td>{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }}</td>
                    </th>
            </table>
        </div> 
        <form action="/privremena-tabela1">  
            <div class="modal-body">
                <table style="width: 100%; border-collapse: collapse; text-align: center;">
                    <th>
                        <td>
                            @if(!is_array($data1))
                                {{ $data1->naziv_proizvoda }}
                            @else
                                @foreach($data1->proizvod_id as $proizvod)
                                    {{ $proizvod->naziv_proizvoda }}
                                @endforeach
                            @endif
                        </td>
                        <td>
                            {{ $data->kolicina }}
                        </td>
                        <td>
                            {{ $data->cena }}
                        </td>
                        <td>
                            {{ $data->zarRad }}
                        </td>
                    </th>
                </table>         
            </div>  
            <div class="modal-footer">
                <button style="width: 200px;" type="submit" class="btn btn-success">{{ AdminOptions::lang(127, Session::get('jezik.AdminOptions::server()')) }}</button>
                <button style="width: 200px;" type="button" class="btn btn-danger" data-dismiss="modal">{{ AdminOptions::lang(128, Session::get('jezik.AdminOptions::server()')) }}</button>
            </div> 
        </form> 
    </div>    
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#ispisNarudzbine').modal('show');
    });
</script>