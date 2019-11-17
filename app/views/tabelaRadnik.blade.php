<thead>
  <th>#</th>
  <th>{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(53, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(57, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(58, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(64, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(147, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(61, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
</thead>
<tbody>
  @foreach((DB::table('radnici')->where('aktivan', 1)->get()) as $key => $radnik)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $radnik->ime }}</td>
    <td>{{ $radnik->prezime }}</td>
    <td>{{ $radnik->grad }}</td>
    <td>{{ $radnik->ulica }}</td>
    <td>{{ $radnik->broj }}</td>
    <td>{{ $radnik->jmbg }}</td>
    <td>{{ $radnik->brlk }}</td>
    <td>{{ $radnik->rola }}</td>
    <td>{{ $radnik->nacin_zarade }}</td>
    <td>{{ $radnik->nacin_zarade1 }}</td>
    <td>{{ $radnik->status }}</td>

<!--- EDIT  --->
    <td>
      <a href="{{ AdminOptions::base_url() }}admin-find-worker/{{ $radnik->id }}" title="{{ AdminOptions::lang(69, Session::get('jezik.AdminOptions::server()')) }}">
        <i class="fa fa-edit"
        style="color:#00ff00;"
        aria-hidden="true"></i>
      </a>
    </td>

<!--- DELETE  --->
      <td>
        <a href="{{ AdminOptions::base_url()}}admin-delete-worker/{{ $radnik->id }}" 
        title="{{ AdminOptions::lang(70, Session::get('jezik.AdminOptions::server()')) }}"  
        onclick="return confirm('{{ AdminOptions::lang(44, Session::get('jezik.AdminOptions::server()')) }}');">
          <i class="fa fa-trash" 
          style="color:red;"                                
          aria-hidden="true">
          </i>
        </a>
      </td>
    </tr>
  @endforeach                              
</tbody>