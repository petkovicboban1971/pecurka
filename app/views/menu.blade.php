 
{{ HTML::style('css/alertify.default.css') }}
{{ HTML::script('js/alertify.js') }}

<link rel="stylesheet" href="css/style.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

{{ HTML::script('js/build/js/jquery.horizBarChart.min.js') }}
{{ HTML::style('css/styleHorizBarChart.css') }}
{{ HTML::style('css/horizBarChart.css') }} 

@if (Session::has('success'))  
    <script src="{{ AdminOptions::base_url()}}js/bootbox/bootbox.js" type="text/javascript"></script>   
    <script type="text/javascript">
      bootbox.alert("<?php echo Session::get('success'); ?>");
    </script> 
    <?php Session::forget('success') ?>             
@endif
@if (Session::has('msg'))
    <script type="text/javascript">
      alertify.success("<?php echo Session::get('msg'); ?>")
    </script>
    <?php Session::forget('msg') ?>
@endif
@if (Session::has('err'))
    <script type="text/javascript">
      alertify.error("<?php echo Session::get('err'); ?>")
    </script>
    <?php Session::forget('err') ?>
@endif
<style type="text/css">
    .blink_me {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
    <div class="grafikon">    
        <ul class="chart">
            <li>
                <a href="/glavniMagacin" class="btn btn-default" style="width: 150px; font-size: 11pt; " >{{ AdminOptions::lang(250, Session::get('jezik.AdminOptions::server()')) }}
                </a>&nbsp;&nbsp;
                <a href="/stanjeMagacina?magacin=1&choise=-1" class="btn btn-default" style="width: 150px; font-size: 11pt; ">{{ AdminOptions::lang(165, Session::get('jezik.AdminOptions::server()')) }}
                </a>
                &nbsp;&nbsp;
                <a href="/stanjeMagacina?magacin=2&choise=-2" class="btn btn-default" style="width: 150px; font-size: 11pt; ">{{ AdminOptions::lang(171, Session::get('jezik.AdminOptions::server()')) }}
                </a>
            </li><br>                          
            <!-- <li class="current" title="Label 1"><span class="bar" data-number="38000"></span><span class="number">38,000</span></li> -->
            @if(!empty($data1))
                @foreach($data1 as $vrednost)
                    @if(proizvodi::find($vrednost->id)->kolicina_proizvoda != 0)
                        <li style="font-weight: bold;" class="past" title="{{ $vrednost->naziv_proizvoda }}">             
                            @if($vrednost->tezina_pakovanja == 0)
                                <span class="bar" data-number="{{ $vrednost->kolicina_proizvoda < 5 ? $vrednost->kolicina_proizvoda : log($vrednost->kolicina_proizvoda) }}"></span>
                                <span class="number">{{ $vrednost->kolicina_proizvoda }}&nbsp;kg</span>
                            @else
                                <span class="bar" data-number="{{ $vrednost->pakovanje * $vrednost->tezina_pakovanja > 2 ? log(($vrednost->pakovanje * $vrednost->tezina_pakovanja)/2) : $vrednost->pakovanje * $vrednost->tezina_pakovanja }}"></span>
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
            @if(!empty($pom))
<!--  Procentualni prikaz dobavljaca -->
                @if($pom == 3) 
                    <style type="text/css">
                        tr:nth-child(even) {background: #ffd699}
                        tr:nth-child(odd) {background: #FFF}
                        tr:hover {background: #ffb84d}
                    </style>
                    <table  style="color:#000;">
                        <thead>
                            <tr>
                                <td style="border-bottom: 1px solid gray; text-align: center !important; font-weight: bold;">{{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }} \ {{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}</td>
                                @foreach($dobavljaci as $dobavljac)     
                                    <td style="border-bottom: 1px solid gray; text-align: center !important;">
                                        {{ $dobavljac->naziv_dobavljaca }}
                                    </td> 
                                @endforeach
                                @foreach($proizvodi as $proizvod)                    
                                    <tr>
                                        <td style="padding-left: 7px; text-align: center !important;">{{ $proizvod->naziv_proizvoda }}             
                                            @foreach($dobavljaci as $dobavljac)
                                                <?php 
                                                    $zbir = 0;
                                                    $procenat = 0;
                                                    $pom = kolicinedobavljaca::dobavljac($dobavljac->id, $proizvod->id);
                                                    echo "<td>";
                                                    foreach ($pom as $value) {
                                                        $zbir = $zbir + $value->kolicina;
                                                    }
                                                    if ($zbir != 0) {
                                                        $procenat = proizvodi::procenat($proizvod->id, $zbir);
                                                        echo "<div style=' text-align: center !important;'>".$zbir." kg (".$procenat." %)</div>";
                                                        echo "</td>";
                                                    }
                                                ?>
                                            @endforeach 
                                        </td>    
                                    </tr>
                                @endforeach                                            
                            </tr>                          
                        </thead>
                        <tr>
                            <td style="padding-left: 7px; border-top: 2px solid #000; font-weight: bold; text-align: center !important;">{{ AdminOptions::lang(200, Session::get('jezik.AdminOptions::server()')) }}:</td>  
                            <?php 
                                if (!empty($dobavljac)) {
                                    $suma1 = kolicinedobavljaca::procenat_iznos($dobavljac->id);
                                    ($suma1 == 0) ? $suma1=1 : $suma1;
                                    foreach ($dobavljaci as $dobavljac) {                    
                                        $pom1 = kolicinedobavljaca::procenat_iznos1($dobavljac->id);
                                        echo "<td style='font-weight:bold; border-top: 2px solid #000; text-align: center !important;'>".number_format($pom1,2,',','.')." ".Firma::valuta()." (".number_format(($pom1/$suma1)*100,2,',','.') ." %)</td>";
                                    }                            
                                }
                            ?>
                        </tr>
                    </table>                    
                @endif
<!--  Ziralna prodaja -->
                @if($pom == 4)
                    <?php $iznos = 0 ?>
                    <table>
                        <thead>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(141, Session::get('jezik.AdminOptions::server()')) }}</td>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }}</td>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</td>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}</td>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(85, Session::get('jezik.AdminOptions::server()')) }}</td>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(81, Session::get('jezik.AdminOptions::server()')) }}</td>
                            <td style="border-bottom: 1px solid #000;">{{ AdminOptions::lang(202, Session::get('jezik.AdminOptions::server()')) }}</td>
                        </thead>
                        @foreach($dataZiralno as $prodaja)
                            <tr>                                
                                <td>{{ Buyers::find($prodaja->kupac)->naziv }}</td>
                                <td>{{ proizvodi::find($prodaja->proizvod)->naziv_proizvoda }}</td>
                                <td>{{ $prodaja->kolicina }} kg</td>
                                <td>{{ number_format(cene_datumi::cena_proizvoda($prodaja->proizvod, $prodaja->created_at) * $prodaja->kolicina,2,",",".") }} {{ Firma::valuta() }}</td>
                                <td>{{ Buyers::find($prodaja->kupac)->racun }}</td>
                                <?php $iznos = $iznos + cene_datumi::cena_proizvoda($prodaja->proizvod, $prodaja->created_at) * $prodaja->kolicina  ?> 
                                <td>{{ Radnici::find($prodaja->radnik)->ime }} {{ Radnici::find($prodaja->radnik)->prezime }}</td>
                                <td>{{ date_format(date_create($prodaja->created_at), "d.m.Y.") }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="border-top: 1px solid #000;">{{ AdminOptions::lang(175, Session::get('jezik.AdminOptions::server()')) }}:
                    {{ number_format($iznos,2,",",".") }} {{ Firma::valuta() }}</div>
                @endif
<!--  Verifikacija uplata -->
                @if($pom == 5)
                    <br>
                    <span style="font-weight: bold; font-size: 14pt;">{{ AdminOptions::lang(221, Session::get('jezik.AdminOptions::server()')) }}:</span><br><br>
                    <form action="/snimi_uplatu" method="post">
                        <select name="uplata_kupac" class="nacin_uplate" style="width: 250px; font-weight: bold;">
                            <option selected disabled>
                                {{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}
                            </option>
                            @for($i=0; $i < count($kupci); $i++)
                                @if(!empty($reversi_zbir[$i]))
                                    @if($reversi_zbir[$i] + $naplaceni_reversi[$i] != 0)
                                        <option value="{{ Buyers::find($reversi[$i])->id }}">
                                            {{ Buyers::find($reversi[$i])->naziv }}
                                        </option>
                                    @endif
                                @endif
                            @endfor
                        </select>
                        <br>
                        <br>
                        <br>
                        <div style="position: relative; float: right; top: -90px;">
                            <u>{{ AdminOptions::lang(255, Session::get('jezik.AdminOptions::server()')) }}</u>
                            <br>
                            @for($i=0; $i < count($kupci); $i++)
                                @if(!empty($reversi_zbir[$i]))
                                    @if($reversi_zbir[$i] + $naplaceni_reversi[$i] != 0)
                                        {{ Buyers::find($reversi[$i])->naziv }} 
                                        {{ number_format(($reversi_zbir[$i] + $naplaceni_reversi[$i]),2,",",".") }} 
                                        {{ Firma::valuta() }}<br>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <span style="margin-left: 50px;">
                            <input type="number" step="0.01" min="0" lang="en" class="iznos_uplate" name="iznos_uplate" size="10" placeholder="{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}" required disabled> {{ Firma::valuta() }}
                            <button type="submit" class="btn btn-success potvrda_uplate" style="margin-left: 25px;" disabled>
                                {{ AdminOptions::lang(185, Session::get('jezik.AdminOptions::server()')) }}
                            </button>
                        </span>
                    </form>
                @endif
<!--  Pregled uplata -->
                @if($pom == 6 || $pom == 7)
                    @include('partials.tabela_uplata')
                @endif
<!--  Fakture -->
                @if($pom == 8)  
                    @if(empty($razduzenja))
                        @if(!empty($kupci))
                            <br>
                            <div style="font-size: 14pt;">
                                {{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}:
                            </div>
                            <br>
                            @foreach($kupci as $kupac)
                                <a href="/izbor_kupca_faktura?faktura={{$kupac->id}}" class="btn btn-info" style="width: 145px; text-align: right !important;">
                                    {{ $kupac->naziv }}
                                </a>
                            @endforeach                        
                        @else
                            {{ AdminOptions::lang(224, Session::get('jezik.AdminOptions::server()')) }}
                        @endif
                    @else
                        <div style="font-size: 15pt; font-weight: bold;">
                            {{ Buyers::find($faktura)->naziv }}
                        </div>
                        <table>
                            <thead style="border-top: 1px solid #777777;">
                                <tr>
                                    <th style="background-color: #f0f0ef; text-align: left !important;">
                                        {{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}
                                    </th>
                                    <th style="background-color: #f0f0ef; text-align: right !important;">
                                        {{ AdminOptions::lang(203, Session::get('jezik.AdminOptions::server()')) }}
                                    </th>
                                    <th style="background-color: #f0f0ef; text-align: right !important;">
                                        {{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}
                                    </th>
                                    <th style="background-color: #f0f0ef; text-align: right !important;">
                                        {{ AdminOptions::lang(105, Session::get('jezik.AdminOptions::server()')) }}
                                    </th>
                                    <th style="background-color: #f0f0ef; text-align: right !important;">
                                        {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}
                                    </th>
                                    <th style="background-color: #f0f0ef; text-align: right !important;">
                                        {{ AdminOptions::lang(81, Session::get('jezik.AdminOptions::server()')) }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $iznos1 = 0; ?>
                                @include('privremenaFaktura')                            
                            </tbody>
                        </table>
                    @endif
                @endif
<!--  Isplate dobavljacima --> 
                @if($pom == 9)
                    <br>
                    <form method="post" action="/unos_isplate_dobavljaca">                  
                        @include('isplate_dobavljacima')                    
                    </form>
                    <div style="position: relative; float: right;">
                        {{ AdminOptions::lang(259, Session::get('jezik.AdminOptions::server()')) }}: {{ number_format($zbir_nacin[0] - dobavljaci_isplata::sum('iznos'),2,',','.') }} {{ Firma::valuta() }}
                        <br><br>
                        @foreach($dobavljaci as $i => $dobavljac)
                            {{ $dobavljac->naziv_dobavljaca }}: 
                            {{ number_format(($pom1[$i]/$suma1)*100,2,',','.') }} % <span class="glyphicon glyphicon-arrow-right"></span> 
                            {{ $izracunata_isplata[$i] }} {{ Firma::valuta() }}
                            <br>
                        @endforeach
                        <br>
                        @if($zbir_nacin[0] - dobavljaci_isplata::sum('iznos') == 0)
                            <a href="#" type="button" class="btn btn-basic" disabled>
                        @else
                            <a href="/isplate_dobavljacima/1" type="button" class="btn btn-basic">
                        @endif
                            {{ AdminOptions::lang(260, Session::get('jezik.AdminOptions::server()')) }}
                        </a>
                    </div>
                @endif               
            @endif            
<!--  Pregled isplata pojedinacnih dobavljaca -->
            @if(isset($mod) && $mod == 1)
                @include('modals.pojedinacni_dobavljac')
            @endif
<!--  Bilans stanja -->
            @if(isset($_GET['menu1']) && $_GET['menu1'] == 1)
                @include('bilans_stanja')
            @endif
<!--  Obracun plata -->
            @if(!empty($pom) && $pom == 10)
                @include('obracun_plata')
            @endif
            @if(!empty($pom) && $pom == 11)
                @include('gotov_obracun')
            @endif
            @if(!empty($pom) && $pom == 12)
                @include('istorija_obracuna')
            @endif
            @if(!empty($pom) && $pom == 13)
                @include('gotov_obracun')
            @endif
<!-- Istorija transakcija -->
            @if(!empty($pom) && $pom == 14)
                @include('istorija_transakcija')
            @endif
<!-- Otpis -->
            @if(!empty($pom) && $pom == 15)
                @include('modals.otpis')
            @endif
<!-- Opis -->
            @if(!empty($pom) && $pom == 16)
                @include('create_article')
            @endif
        </ul>
    </div>

<div id="container">   
    <nav>  
        <ul class="mcd-menu">
            <li>
            <!-- Bilans stanja -->  
                <a href="/admin-welcome?menu1=1" >
                    <i class="fa fa-home"></i>
                    <strong>{{ AdminOptions::lang(215, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(215, Session::get('jezik.AdminOptions::server()')) }}</small>     
                </a>
            </li>
            <li>
            <!-- Live -->  
                <a href="{{ AdminOptions::findSession('firma', 'web_sajt') }}" >
                    <i class="fa fa-globe fa-spin"></i>
                    <strong>{{ AdminOptions::lang(1, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(1, Session::get('jezik.AdminOptions::server()')) }}</small>     
                </a>
            </li>
            <!-- Kupci -->
            <li>
                <a href="#">
                    <i class="fa fa-cart-arrow-down"></i>
                    <strong>{{ AdminOptions::lang(8, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(8, Session::get('jezik.AdminOptions::server()')) }}</small>
                </a>
                <ul>
                    <li>
                        <a href="/fakture" aria-hidden="true"><i class="fa fa-barcode"></i><b>{{ AdminOptions::lang(212, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                    </li>
                    <li>
                        <a href="/uplate_kupaca" aria-hidden="true"><i class="fa fa-money"></i><b>{{ AdminOptions::lang(221, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                    </li>
                    <li>
                        <a href="/istorija_transakcija" aria-hidden="true"><i class="fa fa-history"></i><b>{{ AdminOptions::lang(243, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                        <!-- <ul>
                            <li>
                                <a href="/izbor_nacina_prodaje?nacin=1">
                                    <i class="fa fa-money"></i>
                                    <b>
                                        {{ AdminOptions::lang(235, Session::get('jezik.AdminOptions::server()')) }}
                                    </b>
                                </a>
                            </li>
                            <li>
                                <a href="/pregled_ziralnih_uplata">
                                    <i class="fa fa-barcode"></i>
                                    {{ AdminOptions::lang(199, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li> 
                            <li>
                                <a href="/izbor_nacina_prodaje?nacin=3">
                                    <i class="fa fa-history"></i>
                                    <b>
                                        {{ AdminOptions::lang(214, Session::get('jezik.AdminOptions::server()')) }}
                                    </b>
                                </a>
                            </li>
                        </ul> -->
                        <li>
                            <a href="#" class="noviKupac" aria-hidden="true">
                                <i class="fa fa-edit"></i>
                                <b>{{ AdminOptions::lang(65, Session::get('jezik.AdminOptions::server()')) }}</b>
                            </a>
                        </li>
                        <li>
                            <a href="{{ AdminOptions::base_url() }}workers3" aria-hidden="true"><i class="fa fa-male"></i><b>{{ AdminOptions::lang(83, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                        </li>
                    </li>                    
                </ul>
            </li>
            <!-- Proizvodnja -->        
            <li>
                <a href="#">
                    <i class="fa fa-industry"></i>
                    <strong>{{ AdminOptions::lang(5, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(5, Session::get('jezik.AdminOptions::server()')) }}</small>
                </a>
              	<ul>
                  	<li>
                        <a href="#" class="Dobavljaci">
                            <i class="fa fa-recycle" aria-hidden="true"></i>
                            <b>{{ AdminOptions::lang(191, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                		<ul>
                  			<li>
                                <a href="#" class="noviDobavljac">
                                    <i class="fa fa-edit"></i>
                                    {{ AdminOptions::lang(192, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li>               
                		</ul>
                  	</li>
                    <li>
                        <a href="/isplate_dobavljacima" class="Fakture">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <b>{{ AdminOptions::lang(213, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="pregled_isplata_dobavljacima">
                                    <i class="fa fa-eye"></i>
                                    {{ AdminOptions::lang(257, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li>               
                        </ul>
                    </li>
                    <li>
                        <a href="/grafik_dobavljaci" class="grafik_dobavljaci">
                            <i class="fa fa-line-chart" aria-hidden="true"></i>
                            <b>{{ AdminOptions::lang(198, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                    </li>
                    <li>
                        <a href="/admin-list-group">
                            <i class="fa fa-eye"  aria-hidden="true"></i>
                            <b>{{ AdminOptions::lang(97, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="novaGrupaProizvoda">
                                    <i class="fa fa-edit"></i>
                                    {{ AdminOptions::lang(26, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li>               
                        </ul>
                    </li>
                  	<li>
                        <a href="/admin-list-product">
                            <i class="fa fa-eye"></i>
                            <b>{{ AdminOptions::lang(28, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="noviProizvod">
                                    <i class="fa fa-edit"></i>
                                    {{ AdminOptions::lang(27, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- Prodaja -->
            <li>
                <a href="">
                    @if(Session::get('blink') == 1)
                        <div>
                    @else
                        <div class="blink_me">
                    @endif
                        <i class="fa fa-money" ></i>
                        <strong>{{ AdminOptions::lang(29, Session::get('jezik.AdminOptions::server()')) }}</strong>
                        <small>{{ AdminOptions::lang(29, Session::get('jezik.AdminOptions::server()')) }}</small>
                    </div>
                </a>
                <ul>
                  	<!-- 
                    <div id="result"></div> -->
                    <li>
                        <a href="/otpis">
                            <i class="fa fa-trash-o"></i>
                            <b>{{ AdminOptions::lang(201, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="pregled_otpis">
                                    <i class="fa fa-eye"></i>
                                    {{ AdminOptions::lang(248, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li>
                        </ul>
                    </li><!-- 
                    <li>
                        <a href="/zamena">
                            <i class="fa fa-exchange"></i>
                            <b>{{ AdminOptions::lang(237, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                    </li> -->
                    <li>
                        <a href="#" class="dnevna_cena_proizvoda">
                            @if(Session::get('blink') == 1)
                                <div>
                            @else
                                <div class="blink_me">
                            @endif
                                <i class="fa fa-money"></i>
                                <b>{{ AdminOptions::lang(254, Session::get('jezik.AdminOptions::server()')) }}</b>
                            </div>    
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="pregled_dnevnih_cena">
                                    <i class="fa fa-eye"></i>
                                    {{ AdminOptions::lang(262, Session::get('jezik.AdminOptions::server()')) }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- RADNICI -->
            <li>
                <a href="#">
                  <i class="fa fa-group"></i>
                  <strong>{{ AdminOptions::lang(49, Session::get('jezik.AdminOptions::server()')) }}</strong>
                  <small>{{ AdminOptions::lang(49, Session::get('jezik.AdminOptions::server()')) }}</small>
                </a>
                <ul>
                    <li>
                        <a href="/obracun_plata" ><i class="fa fa-money"></i><b>{{ AdminOptions::lang(229, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                    </li>
                    <li>
                        <a href="/istorija_obracuna" ><i class="fa fa-history"></i><b>{{ AdminOptions::lang(236, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                    </li>
                    <li>
                        <a href="#" class="noviRadnik" aria-hidden="true">
                            <i class="fa fa-edit"></i>
                            <b>{{ AdminOptions::lang(6, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                    </li>
                    <li>
                        <a href="{{ AdminOptions::base_url() }}workers1" ><i class="fa fa-female"></i><b>{{ AdminOptions::lang(69, Session::get('jezik.AdminOptions::server()')) }}</b></a>
                    </li>
                </ul>
            </li>
            <!-- Ulazne stavke -->
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-save fa-rotate-270"></i>
                    <strong>{{ AdminOptions::lang(4, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(4, Session::get('jezik.AdminOptions::server()')) }}</small>
                </a>
                <ul>
                    <li>
                        <a href="#" class="novaStavka" >
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            <b>{{ AdminOptions::lang(14, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                    </li>
                    <li>
                        <a href="{{ AdminOptions::base_url() }}workers2" ><i class="fa fa-eye"></i><b>{{ AdminOptions::lang(15, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- AboutUs -->
            <li>
                <a href="">
                    <i class="fa fa-university"></i>
                    <strong>{{ AdminOptions::lang(9, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(9, Session::get('jezik.AdminOptions::server()')) }}</small>
                </a>
                <ul>
                    <li>
                        <a href="#" class="podaci_firma"><i class="fa fa-edit"></i>{{ AdminOptions::lang(12, Session::get('jezik.AdminOptions::server()')) }}</a>
                    </li>
                    <li>
                        <a href="/create-article"><i class="fa fa-edit"></i>{{ AdminOptions::lang(11, Session::get('jezik.AdminOptions::server()')) }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit"></i>{{ AdminOptions::lang(13, Session::get('jezik.AdminOptions::server()')) }}</a>
                    </li> 
                    <li>
                        <a href="#" class="valute">
                            <i class="fa fa-money"></i>
                            <b>{{ AdminOptions::lang(130, Session::get('jezik.AdminOptions::server()')) }}</b>
                        </a>
                    </li>              
                </ul>
            </li>
            <!-- LOGOUT -->
            <li>
                <a href="/admin" class="active">
                    <i class="fa fa-sign-out"></i>
                    <strong>{{ AdminOptions::lang(2, Session::get('jezik.AdminOptions::server()')) }}</strong>
                    <small>{{ AdminOptions::lang(2, Session::get('jezik.AdminOptions::server()')) }}</small>
                </a>
            </li>
            <li style="height:55px; border-bottom: 4px solid #808080;">              
                <strong></strong>
                <small></small>              
            </li>
        </ul>
    </nav>
</div>
 

<!--- MODAL BILANS STANJA --->
<div id="bilans" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    @include('modals/bilansStanja')
</div>

<!--- MODAL NOVI RADNIK --->
<div id="novi-radnik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/unosNovogRadnika')
</div>

<!--- MODAL ZARADA RADNIKA --->
<div id="zarada-radnik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/unosRadnikZarada')
</div>

<!--- MODAL NOVA ULAZNA STAVKA --->
<div id="nova-stavka" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/unosNoveStavke')
</div>  

<!--- MODAL UNOS KUPCA --->
<div id="novi-kupac" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/unosNovogKupca')
</div>

<!--- MODAL UNOS GRUPE PROIZVODA --->
<div id="nova-grupa-proizvoda" class="modal fade" tabindex="-1" role="dialog"             aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" 
    style="display: none;" aria-hidden="true">
    @include('modals/unosNoveGrupeProizvoda')
</div>

<!--- MODAL UNOS NOVOG PROIZVODA --->
<div id="novi-proizvod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/unosNovogProizvoda')
</div>

<!--- MODAL UNOS NOVOG DOBAVLJACA --->
<div id="noviDobavljac" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/noviDobavljac')
</div>

<!--- MODAL KOLICINE DOBAVLJACA --->
<div id="Dobavljaci" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    @include('modals.upisKolicineDobavljac')
</div>

<!--- MODAL VALUTE --->
<div id="valute" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/valuteModal')
</div>

<!--- MODAL SPISAK OTPISANIH PROIZVODA --->
<div id="pregled_otpis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/pregled_otpis')
</div>

<!--- MODAL PREGLED ISPLATA DOBAVLJACIMA --->
<div id="pregled_isplata_dobavljacima" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/pregled_isplata_dobavljacima')
</div>

<!--- MODAL PROMENA DNEVNE CENE PROIZVODA --->
<div id="dnevna_cena_proizvoda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/dnevna_cena_proizvoda')
</div>

<!--- MODAL PREGLED DNEVNIH CENA PROIZVODA --->
<div id="pregled_dnevnih_cena" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/pregled_dnevnih_cena')
</div>

<!--- MODAL PODACI O FIRMI --->
<div id="podaci_firma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    @include('modals/podaci_firma')
</div>

<script type="text/javascript">

    $(document).ready(function() {   
     
        $('.noviDobavljac1').on('click', function(e){
            e.preventDefault();
            var link = $(this).data('link');
            alertify.confirm("<?php echo AdminOptions::lang(193, Session::get('jezik.AdminOptions::server()')); ?>",
                function(e){
                    if(e){
                        location.href = link;
                    }
                });
        }); 

        $('.provera').on('click', function(e){
            e.preventDefault();
            var link = $(this).data('link');
            alertify.confirm("<?php echo AdminOptions::lang(226, Session::get('jezik.AdminOptions::server()')); ?>",
                function(e){
                    if(e){
                        location.href = link;
                    }
                });
        }); 

        $('.provera1').on('click', function(e){
            e.preventDefault();
            alertify.confirm("<?php echo AdminOptions::lang(226, Session::get('jezik.AdminOptions::server()')); ?>",
                function(e){
                    if(e){
                        $.post('/unos_isplate_dobavljaca', {
                            dobavljac_isplata: $(this).data('dobavljac_isplata'), 
                            nacin_isplate: $(this).data('nacin_isplate'),
                            iznos_isplate: $(this).val()},
                            function (response){
                                location.href(true);
                            });
                    }
                });
        }); 

        $(".noviDobavljac").on("click", function() {
            $("#noviDobavljac").modal('show');
        });

        $(".noviRadnik").on("click", function() {
            $("#novi-radnik").modal('show');
        });

        $(".novaStavka").on("click", function() {
            $("#nova-stavka").modal('show');
        });

        $(".zaradaRadnik").on("click", function() {
            $("#zarada-radnik").modal('show');
        });

        $(".azuriranjeKupac").on("click", function() {
            $("#azuriranje-kupac").modal('show');
        });

        $(".noviProizvod").on("click", function() {
            $("#novi-proizvod").modal('show');
        });

        $(".noviKupac").on("click", function() {
            $("#novi-kupac").modal('show');
        }); 

        $(".novaGrupaProizvoda").on("click", function() {
            $("#nova-grupa-proizvoda").modal('show');
        }); 

        $(".veleMarza").on("click", function() {
            $("#veleprodaja-marza").modal('show');
        });

        $(".pregled_otpis").on("click", function() {
            $("#pregled_otpis").modal('show');
        });

        $(".pregled_isplata_dobavljacima").on("click", function() {
            $("#pregled_isplata_dobavljacima").modal('show');
        });

        $(".pregled_dnevnih_cena").on("click", function() {
            $("#pregled_dnevnih_cena").modal('show');
        });

        $(".dnevna_cena_proizvoda").on("click", function() {
            $("#dnevna_cena_proizvoda").modal('show');
        });

        $(".podaci_firma").on("click", function() {
            $("#podaci_firma").modal('show');
        });

        $(".valute").on("click", function() {
            $("#valute").modal('show');
        });

        $('.chart').horizBarChart({
                selector: '.bar',
                speed: 3000
            }); 

        $(".Dobavljaci").on("click", function() {
            $("#Dobavljaci").modal('show');
        });

        $(".bilansStanja").on("click", function() {

            $.post('/bilansStanja', 
                function (response){                                                    location.reload(true);
                });

            $("#bilans").modal('show');
        });

        $('.idd').on('click', function() {

            $.post('/kolicinedobavljaca', { dobavljac : $(this).data('id') });
        });

        $("#dobavljac").change(function(e){ 
            e.preventDefault();
                $(".btn1").removeAttr("disabled");
                $("#kolicina").removeAttr("disabled");
        }); 

        $("#kupac").change(function(e){ 
            e.preventDefault();      
            $("#nacin").removeAttr("disabled");         
        });

        $("#nacin").change(function(e){ 
            e.preventDefault();      
            $("#kolicina").removeAttr("disabled");
            $(".btn1").removeAttr("disabled");          
        });

        $(".uplata_kupac").change(function(e){ 
            e.preventDefault();      
            $(".nacin_uplate").removeAttr("disabled");         
        });

        $(".nacin_uplate").change(function(e){ 
            e.preventDefault();      
            $(".iznos_uplate").removeAttr("disabled");         
        });

        $(".iznos_uplate").keyup(function(e){ 
            e.preventDefault();      
            $(".potvrda_uplate").removeAttr("disabled");         
        });

        var checkbox = $('input[type="checkbox"]');
        $("#checkbox2").click(function(){
            if(this.checked){
                $("#tezina_pakovanja").removeAttr("disabled");
                $("#cena_pakovanja").removeAttr("disabled");
                $("#cena_proizvoda1").prop("disabled", true);
            } else{
                $("#tezina_pakovanja").prop("disabled", true);
                $("#cena_pakovanja").prop("disabled", true);
                $("#cena_proizvoda1").removeAttr("disabled");
            } 
        });
        /*$("#kolicina").change(function(e){ 
            e.preventDefault();               
        });*/

        $('#Dobavljaci11').on('show.bs.modal', function(e) {            
            var $modal = $(this),
                esseyId = e.relatedTarget.id;            
//            $.ajax({
//                cache: false,
//                type: 'POST',
//                url: 'backend.php',
//                data: 'EID='+essay_id,
//                success: function(data) 
//                {
                    $modal.find('.edit-content').html(esseyId);
//                }
//            });            
        })
    });
</script>