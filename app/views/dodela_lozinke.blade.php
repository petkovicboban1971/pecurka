@foreach($radnici as $radnik)
	{{ $radnik->ime }} {{ $radnik->prezime }} - {{ AdminOptions::lang(42, Session::get('jezik.AdminOptions::server()')) }}: {{ $radnik->lozinka }}
	<br>
@endforeach