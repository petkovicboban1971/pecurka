<div class="clearfix">
    <div class="hint-text">{{ AdminOptions::lang(158, Session::get('jezik.AdminOptions::server()')) }} <b>{{ ($niz - ($stranica-1)*15 > 15) ? 1+($stranica-1)*15 ."-". $stranica*15 : 1+($stranica-1)*15 ."-". $niz }}</b> {{ AdminOptions::lang(159, Session::get('jezik.AdminOptions::server()')) }} <b>{{ $niz }}</b> {{ AdminOptions::lang(157, Session::get('jezik.AdminOptions::server()')) }}</div>
    <ul class="pagination">
        @if($stranica == 1)
            <li class="page-item disabled">
                <a class="page-link">{{ AdminOptions::lang(160, Session::get('jezik.AdminOptions::server()')) }}</a>
            </li>
        @else
            <li class="page-item">
                <a href="/{{ $prom }}?str={{ $stranica-1 }}">{{ AdminOptions::lang(160, Session::get('jezik.AdminOptions::server()')) }}</a>
            </li>
        @endif
        <?php $pom = ($niz/15 > round($niz/15) ? 1 + round($niz/15) : round($niz/15)) ?> 
        @for($i = 1; $i <= $pom; $i++)
            <li class="page-item">
              <a href="/{{ $prom }}?str={{ $i }}" class="page-link">{{ $i }}</a>
            </li>
        @endfor
        @if($niz - ($stranica-1)*15 <= 15)
            <li class="page-item disabled">
                <a class="page-link">{{ AdminOptions::lang(161, Session::get('jezik.AdminOptions::server()')) }}</a>
            </li>
        @else
            <li class="page-item">
              <a href="/{{ $prom }}?str={{ $stranica+1 }}" class="page-link">{{ AdminOptions::lang(161, Session::get('jezik.AdminOptions::server()')) }}</a>
            </li>
        @endif
    </ul>
</div>
        