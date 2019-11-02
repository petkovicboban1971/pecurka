<?php 
    $link1 = "/home?id=1";
    $link2 = "/stanjeMagacina?magacin=1";
    $link3 = "/stanjeMagacina?magacin=2";
?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="/js/build/js/jquery.horizBarChart.min.js"></script>
    <link href="/css/styleHorizBarChart.css" rel="stylesheet" />
    <link href="/css/horizBarChart.css" rel="stylesheet" /> 

    <div class="grafikon">    
        <ul class="chart" style="background-color: #999999;">
            <li>
                <a href="{{ $link1 }}" class="btn btn-default" style="width: 150px; font-size: 11pt; box-shadow: 2px 2px #b3b3b3;" >{{ AdminOptions::lang(164, Session::get('jezik.AdminOptions::server()')) }}
                </a>&nbsp;&nbsp;
                <a href="{{ $link2 }}" class="btn btn-default" style="width: 150px; font-size: 11pt; box-shadow: 2px 2px #b3b3b3;">{{ AdminOptions::lang(165, Session::get('jezik.AdminOptions::server()')) }}
                </a>
                <a href="{{ $link3 }}" class="btn btn-default" style="width: 150px; font-size: 11pt; box-shadow: 2px 2px #b3b3b3;">{{ AdminOptions::lang(171, Session::get('jezik.AdminOptions::server()')) }}
                </a>
            </li><br>
          <!-- <li class="current" title="Label 1"><span class="bar" data-number="38000"></span><span class="number">38,000</span></li> -->
            @if(!empty($data1))
               @foreach($data1 as $vrednost)
                    @if(proizvodi::find($vrednost->id)->kolicina_proizvoda != 0)
                        <li style="font-weight: bold;" class="past" title="{{ $vrednost->naziv_proizvoda }}">             
                            @if($vrednost->tezina_pakovanja == 0)
                                <span class="bar" data-number="{{ $vrednost->kolicina_proizvoda/2 < 1 ? $vrednost->kolicina_proizvoda/2  : log($vrednost->kolicina_proizvoda/2) }}"></span>
                                <span class="number">{{ $vrednost->kolicina_proizvoda }}&nbsp;kg</span>
                            @else
                                <span class="bar" data-number="{{ $vrednost->pakovanje * $vrednost->tezina_pakovanja > 1 ? log(($vrednost->pakovanje * $vrednost->tezina_pakovanja)/2) : $vrednost->tezina_pakovanja/2 }}"></span>
                                <span class="number">{{ $vrednost->pakovanje }}&nbsp;{{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }}</span>
                            @endif
                        </li>
                    @endif
                @endforeach
            @else
                @if(!empty($data))
                    @for($i=0; $i < count($unikat_proizvod); $i++)
                        <li style="font-weight: bold;" class="past" title="{{ proizvodi::find($unikat_proizvod[$i]->proizvod)->naziv_proizvoda }}">
                            <span class="bar" data-number="{{ $zbir_proizvoda[$i] >1 ? log($zbir_proizvoda[$i]) : 1 }}"></span>
                            @if(proizvodi::find($unikat_proizvod[$i]->proizvod)->pakovanje == 0)
                                <span class="number">{{ $zbir_proizvoda[$i] }}&nbsp;kg</span>
                            @else
                                <span class="number">{{ $zbir_proizvoda[$i] }}&nbsp;{{ AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()')) }}</span>
                            @endif
                        </li>
                    @endfor            
                @endif        
            @endif
        </ul>
    </div>
    @if (Session::has('success'))  
        <script src="{{ AdminOptions::base_url()}}js/bootbox/bootbox.js" type="text/javascript"></script> 
        <script type="text/javascript">
          bootbox.alert("<?php echo Session::get('success'); ?>");
        </script> 
        <?php Session::forget('success') ?>             
    @endif
    @if (Session::has('kreiranMagacin'))
        <script type="text/javascript">
          alertify.success("<?php echo Session::get('kreiranMagacin'); ?>")
        </script>
        <?php Session::forget('kreiranMagacin') ?>
    @endif
<script type="text/javascript">
    $(document).ready(function() {  
        $('.chart').horizBarChart({
                selector: '.bar',
                speed: 3000
        }); 
    });
</script> 