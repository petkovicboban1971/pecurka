
@include('modals/confirm')
<thead>
  <th>#</th>
  <th>{{ AdminOptions::lang(84, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(86, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(209, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
</thead>
<tbody>
  @foreach(DB::table('kupci')->where('aktivan', 1)->orderBy('naziv', 'asc')->get() as $key => $kupac)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $kupac->naziv }}</td>
    <td>{{ $kupac->grad }}</td>
    <td>{{ $kupac->ulica }}</td>
    <td>{{ $kupac->broj }}</td>
    <td>{{ $kupac->PIB }}</td>
    <td>{{ $kupac->racun }}</td>
    @if($kupac->grupa_kupac)
      <td>{{ Buyers::find($kupac->grupa_kupac)->naziv }}</td>
    @else
      <td>-</td>
    @endif
<!--- EDIT  --->
    <td>
      <a href="{{ AdminOptions::base_url() }}admin-find-buyer/{{ $kupac->id }}" title="{{ AdminOptions::lang(113, Session::get('jezik.AdminOptions::server()')) }}">
        <i class="fa fa-edit"
        style="color:#00ff00;"
        aria-hidden="true"></i>
      </a>
    </td>
<!--- DELETE  --->
    <td>
      <a href="{{ AdminOptions::base_url()}}admin-delete-buyer/{{ $kupac->id }}" 
        title="{{ AdminOptions::lang(114, Session::get('jezik.AdminOptions::server()')) }}"  
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
