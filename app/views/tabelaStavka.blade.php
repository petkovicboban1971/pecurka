<thead>
  <th>#</th>
  <th>{{ AdminOptions::lang(16, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(18, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(19, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(20, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(23, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</th>      
  <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
</thead>
<tbody>                        
  @foreach(DB::table('ulazna_stavka')->where('aktivan', 1)->get() as $key => $ulazna_stavka)
    <tr> 
      <td>{{ $key + 1 }}</td>
      <td>{{ $ulazna_stavka->ulazna_stavka }}</td>
      <td>{{ $ulazna_stavka->ulazna_stavka_nabavna_cena }}</td>
      <td>{{ $ulazna_stavka->ulazna_stavka_porez }}%</td>
      <td>{{ $ulazna_stavka->ulazna_stavka_zaracunata_marza }}%</td>
      <td>{{ $ulazna_stavka->ulazna_stavka_nabavna_cena * (($ulazna_stavka->ulazna_stavka_porez + $ulazna_stavka->ulazna_stavka_zaracunata_marza)/100 + 1) }}</td>
      <td>{{ $ulazna_stavka->ulazna_stavka_dobavljac }}</td>
  <!--- EDIT  --->
        <td>
            <a href="{{ AdminOptions::base_url() }}admin-find-item/{{ $ulazna_stavka->ulazna_stavka_id }}" title="{{ AdminOptions::lang(66, Session::get('jezik.AdminOptions::server()')) }}">             
                <i class="fa fa-edit fa-clickable" 
                    style="color:#00ff00;"                
                    aria-hidden="true">
                </i>                                            
            </a>
        </td>
  <!--- DELETE  --->
      <td>
        <a href="{{ AdminOptions::base_url()}}admin-delete-item/{{ $ulazna_stavka->ulazna_stavka_id }}" 
        title="{{ AdminOptions::lang(67, Session::get('jezik.AdminOptions::server()')) }}"  
        onclick="return confirm('{{ AdminOptions::lang(44, Session::get('jezik.AdminOptions::server()')) }}');">
          <i class="fa fa-times" 
          style="color:red;"                                
          aria-hidden="true">
          </i>
        </a>
      </td>
    </tr>
  @endforeach                              
</tbody>