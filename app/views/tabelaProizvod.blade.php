<style type="text/css">
      .row {
        margin-right: 12%;
        margin-left: 12%;/*
        margin-top: 30px;*/
      }
    </style>
<thead>
  <th>#</th>
  <th>{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(109, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(105, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(219, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(149, Session::get('jezik.AdminOptions::server()')) }}</th>
  
  <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
</thead>
<tbody>
  @foreach((DB::table('proizvodi')->where('aktivan', 1)->get()) as $key => $product)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $product->naziv_proizvoda }}</td>
    <td>{{ DB::table('grupa_proizvoda')->where('grupa_id', $product->grupa_proizvoda)->pluck('naziv_grupe') }}</td>
    <td>{{ cene_datumi::cena_proizvoda($product->id, date('Y-m-d')) }}</td>
    <td>{{ $product->proizvodna_cena }}</td>
    <td>{{ $product->kolicina_proizvoda }}</td>

<!--- EDIT  --->
    <td>
      <a href="{{ AdminOptions::base_url() }}admin-find-product/{{ $product->id }}" 
        title="{{ AdminOptions::lang(111, Session::get('jezik.AdminOptions::server()')) }}">
        <i class="fa fa-edit"
        style="color:#00ff00;"
        aria-hidden="true"></i>
      </a>
    </td>

<!--- DELETE  --->
    <td>
      <a href="{{ AdminOptions::base_url()}}admin-delete-product/{{ $product->id }}" 
        title="{{ AdminOptions::lang(112, Session::get('jezik.AdminOptions::server()')) }}"  
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