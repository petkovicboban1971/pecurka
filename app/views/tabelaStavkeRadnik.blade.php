<thead>
  <th>#</th>
  <th>{{ AdminOptions::lang(52, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(53, Session::get('jezik.AdminOptions::server()')) }}</th>
 @if($pom == 3)
  <th>{{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(55, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(56, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(57, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(58, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(59, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(64, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(50, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(61, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}</th>
 @endif
 @if($pom == 4)
  <th>{{ AdminOptions::lang(50, Session::get('jezik.AdminOptions::server()')) }}</th>
  <th>{{ AdminOptions::lang(62, Session::get('jezik.AdminOptions::server()')) }}</th>
 @endif
</thead>
<tbody>
  @foreach((DB::table('radnici')->get()) as $key => $radnik)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $radnik->ime }}</td>
    <td>{{ $radnik->prezime }}</td>
  @if($pom == 3)
    <td>{{ $radnik->grad }}</td>
    <td>{{ $radnik->ulica }}</td>
    <td>{{ $radnik->broj }}</td>
    <td>{{ $radnik->jmbg }}</td>
    <td>{{ $radnik->brlk }}</td>
    <td>{{ $radnik->pu }}</td>
    <td>{{ $radnik->rola }}</td>
    <td>{{ $radnik->nacin_zarade }}</td>
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
      <a href="#" class="conf"
         title="{{ AdminOptions::lang(70, Session::get('jezik.AdminOptions::server()')) }}">
          <i class="fa fa-times"
             style="color:red;"
             aria-hidden="true">
          </i>
      </a>
    </td>
  @endif
  @if($pom == 4)
<!--- MARK  --->

    <td>{{ $radnik->nacin_zarade }}</td>

    <td>
      <a href="#" class="zaduzenje" title="{{ AdminOptions::lang(62, Session::get('jezik.AdminOptions::server()')) }}">
        <i class="fa fa-heart-o"
        style="color:yellow;"
        id="marked"
        data-id="{{ $radnik->id }}"
        aria-hidden="true">
        </i>
      </a>
    </td>
  </tr>
  @endif
  @endforeach
</tbody>

<!--- MODAL   confirm --->
@include('modals/confirm')
<script type="text/javascript">
  $().ready(function(){
    $(".conf").click(function(){
      $("#modalConfirmDelete").modal();
    });
  });
</script>