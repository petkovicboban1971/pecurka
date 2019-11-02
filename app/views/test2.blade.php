<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="/js/src/js/horizBarChart.js"></script>
    <script src="/js/build/js/jquery.horizBarChart.min.js"></script>
    <link href="/css/styleHorizBarChart.css" rel="stylesheet" />
    <link href="/css/horizBarChart.css" rel="stylesheet" />
</head>
<body>
    <ul class="chart">
        <li class="title" title="{{ AdminOptions::lang(164, Session::get('jezik.AdminOptions::server()')) }}"></li><br>
        <!-- <li class="current" title="Label 1"><span class="bar" data-number="38000"></span><span class="number">38,000</span></li> -->
        @foreach(($data2 = DB::table('proizvodi')->get()) as $vrednost)
            <li class="past" title="{{ $vrednost->naziv_proizvoda }}"><span class="bar" data-number="{{ $vrednost->kolicina_proizvoda }}"></span><span class="number">{{ $vrednost->kolicina_proizvoda }}kg</span></li>
        @endforeach
    </ul>
    <script type="text/javascript">
        $(document).ready(function(){
        $('.chart').horizBarChart({
          selector: '.bar',
          speed: 3000
        });
        });
    </script>
</body>

</html>