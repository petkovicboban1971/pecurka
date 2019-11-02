    <style type="text/css">
      .row {
        margin-right: 20%;
        margin-left: 20%;/*
        margin-top: 30px;*/
      }
    </style>
<thead>
  <th>#</th>
  <th>{{ AdminOptions::lang(98, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
</thead>
<tbody>
  @foreach((DB::table('grupa_proizvoda')->where('aktivan', 1)->get()) as $key => $grupa)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $grupa->naziv_grupe }}</td>

<!--- EDIT  --->
    <td>
      <a href="{{ AdminOptions::base_url() }}admin-find-group/{{ $grupa->id }}" title="{{ AdminOptions::lang(69, Session::get('jezik.AdminOptions::server()')) }}">
        <i class="fa fa-edit"
        style="color:#00ff00;"
        aria-hidden="true"></i>
      </a>
    </td>
<!--- DELETE  --->
    <td>
      <a href="{{ AdminOptions::base_url()}}admin-delete-group/{{ $grupa->id }}" 
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
