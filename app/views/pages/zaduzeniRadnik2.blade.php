@include('pages.home')
<div class="sviRadnici">
	@foreach($radnici as $radnik)
		<a href="zaduzeniRadnik3/{{ $radnik->id }}" class="btn ">{{ $radnik->ime }} {{ $radnik->prezime }}</a>
	@endforeach
</div>
<div id="ram">
	<?php $izborTabele = 2; ?>
	@include('partials.miniTabela')
</div>