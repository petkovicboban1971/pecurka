
<style type="text/css">
    *{
        box-sizing: border-box;
    }
    .navbar1 {
        width: 100%;
        overflow: auto;
    }
    .navbar1 tr, th, td{
        padding: 0px 5px !important;
    }
    table {
        table-layout: fixed !important; 
        word-wrap: break-word !important;
    }
    table thead, th, td, tr{
        width: 125px !important;
    }
</style>
<table class="navbar1">
     <thead>
        <tr>
            <td style="padding: 10px 0; font-size: 14pt; font-weight: bold; color: #000;">
                {{ AdminOptions::lang(215,                                   Session::get('jezik.AdminOptions::server()')) }}
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td><!-- 
            <td></td>
            <td></td> -->
        </tr>
        <tr>
            <th style="font-weight: bold;">
                {{ AdminOptions::lang(141, Session::get('jezik.AdminOptions::server()')) }}
            </th>                
            <th style="text-align: center; color: #00cc00; font-weight: bold;">
                {{ AdminOptions::lang(216, Session::get('jezik.AdminOptions::server()')) }}                         
            </th>
            <th></th>
            <th style="text-align: center; color: red; font-weight: bold;">
                {{ AdminOptions::lang(217, Session::get('jezik.AdminOptions::server()')) }}
            </th>
            <td></td>
            <?php  
                $pom2 = 0;
                for($i=0; $i < count($vrsta_prodaje); $i++){
                    $pom2 = $pom2 + $zbir_nacin[$i];    
                }
                $pom2 = $pom2 - dobavljaci_isplata::where('nacin', 1)->sum('iznos');
            ?>
            <th style="text-align: center; color: blue; font-weight: bold;">
                {{ AdminOptions::lang(139, Session::get('jezik.AdminOptions::server()')) }}
            </th>
            <td></td>
            @if($pom2 < 0)
                <td style="background-color: red; color: #000; font-weight: bold;"> 
                    {{ number_format($pom2,2,",",".") }} {{ Firma::valuta() }}
                </td>
            @else
                <td style="background-color: #00cc00; color: #fff; font-weight: bold;"> 
                    {{ number_format($pom2,2,",",".") }} {{ Firma::valuta() }}
                </td>
            @endif
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <tbody>   
        <tr>
            <td>&nbsp;</td>
            <td style="border-left: 1px solid #000;">{{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}</td>
            <td>{{ AdminOptions::lang(241, Session::get('jezik.AdminOptions::server()')) }}</td>
            <td style="border-left: 1px solid #000;">{{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}</td>
            <td>{{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}</td>
            <td style="border-left: 1px solid #000;">{{ AdminOptions::lang(242, Session::get('jezik.AdminOptions::server()')) }}</td>
            <td>{{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}</td>
            <td>{{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}</td>
        </tr>         
        @foreach(Buyers::all() as $b1 => $naziv)
            <tr>
                <td>{{ $naziv->naziv }}</td>  
                <?php $pom1 = 0; ?>                         
                @for($i=1; $i < count($vrsta_prodaje); $i++)
                    <td style="border-left: 1px solid #000;">
                        {{ number_format($uplata_nacin[$b1][$i],2,",",".") }} 
                        {{ Firma::valuta() }}
                    </td>
                    <?php  
                        $pom1 = $pom1 + $uplata_nacin[$b1][1];
                    ?>
                @endfor
                @for($nacin=1; $nacin < count($vrsta_prodaje); $nacin++)
                    <td style="border-left: 1px solid #000;">
                        {{ number_format($dugovanje[$b1][$nacin],2,",",".") }} {{ Firma::valuta() }}
                    </td>                            
                @endfor
                @for($nacin=0; $nacin < count($vrsta_prodaje); $nacin++)
                    <td style="border-left: 1px solid #000;">
                        {{ number_format($suma[$b1][$nacin],2,",",".") }} 
                        {{ Firma::valuta() }}
                    </td>
                @endfor    
            </tr>
        @endforeach
        <tr style="border: 2px solid blue;">
            <td>
                {{ AdminOptions::lang(220, Session::get('jezik.AdminOptions::server()')) }} 
            </td>
            @for($i=1; $i <= 4; $i++)
                <td></td>
            @endfor
            <?php 
                $pom0 = 0; 
            ?>
            @for($i=0; $i < count($vrsta_prodaje); $i++)
                @if($i == 0)
                    <td style="border-left: 1px solid blue;">
                        {{ number_format($zbir_nacin[$i]-DB::table('dobavljaci_isplata')->sum('iznos'),2,",",".") }} 
                        {{ Firma::valuta() }}
                    </td>
                @else
                    <td style="border-left: 1px solid blue;">
                        {{ number_format($zbir_nacin[$i],2,",",".") }} 
                        {{ Firma::valuta() }}
                    </td>
                @endif
                <?php $pom0 = $pom0 + $zbir_nacin[$i];?>
            @endfor
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                {{ AdminOptions::lang(22, Session::get('jezik.AdminOptions::server()')) }}
            </th>
            <th style="text-align: center; color: #00cc00; font-weight: bold;">
                {{ AdminOptions::lang(216, Session::get('jezik.AdminOptions::server()')) }}                         
            </th><!-- 
            <td></td> -->
            <th style="text-align: center; color: red; font-weight: bold;">
                @for($u = 0 ; $u < 17;$u++)
                    &nbsp;
                @endfor
                {{ AdminOptions::lang(227, Session::get('jezik.AdminOptions::server()')) }}
            </th>
            <td></td>
            <th style="text-align: center; color: red; font-weight: bold;">
                {{ AdminOptions::lang(201, Session::get('jezik.AdminOptions::server()')) }}
            </th>
            <th style="text-align: center; color: red; font-weight: bold;">
                {{ AdminOptions::lang(250, Session::get('jezik.AdminOptions::server()')) }}
            </th>
            <td></td>
            <th style="text-align: center; border:1px solid #000; color: blue; font-weight: bold;">
                {{ AdminOptions::lang(215, Session::get('jezik.AdminOptions::server()')) }}:
            </th>
            <td></td><!-- 
            <td></td>
            <td></td> -->
            <tr>
                <td>&nbsp;</td>
                <td style="border-left: 1px solid #000;">{{ AdminOptions::lang(249, Session::get('jezik.AdminOptions::server()')) }}</td>
                <td style="border-left: 1px solid #000;">{{ AdminOptions::lang(181, Session::get('jezik.AdminOptions::server()')) }}</td>
                <td>{{ AdminOptions::lang(182, Session::get('jezik.AdminOptions::server()')) }}</td><!-- 
                <td>{{ AdminOptions::lang(187, Session::get('jezik.AdminOptions::server()')) }}</td> -->
                <td style="border-left: 1px solid #000;"></td>
                <td style="border-left: 1px solid #000;"></td>
                <td></td>
                <td></td><!-- 
                <td></td>
                <td></td> -->
            </tr>   
        </tr>
        @foreach(dobavljaci::all() as $key => $dobavljac)
            <tr>
                <td>{{ $dobavljac->naziv_dobavljaca }}</td>
                <td style="border-left: 1px solid #000; border-right: 1px solid #000;">
                    {{ number_format($unos_dobavljaca[$key],2,",",".") }} 
                    {{ Firma::valuta() }}
                </td>
                @for($i=0; $i < count($vrsta_prodaje)-1; $i++)
                    <td>
                        @if($i != 1)
                            {{ number_format($isplate_dobavljacima[$key][$i],2,",",".") }} 
                            {{ Firma::valuta() }}
                        @elseif($key == 1)
                            {{ number_format($ziralna_uplata,2,",",".") }} 
                            {{ Firma::valuta() }}
                        @endif
                    </td>
                @endfor
                <td style="border-left: 1px solid #000;"></td>
                <td style="border-left: 1px solid #000;"></td>
                <td></td>
                <td></td><!-- 
                <td></td>
                <td></td> -->
            </tr>
        @endforeach
        <tr style="border: 2px solid blue;">
            <td>
                {{ AdminOptions::lang(220, Session::get('jezik.AdminOptions::server()')) }} 
            </td>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000;">
                {{ number_format(array_sum($unos_dobavljaca),2,",",".") }} {{ Firma::valuta() }}
            </td>
            <?php $pom1 = 0; ?>
            @for($i=0; $i < count($vrsta_prodaje)-1; $i++)
                <td>
                    @if($i == 1)
                        {{ number_format($ziralna_uplata,2,",",".") }} 
                        {{ Firma::valuta() }}
                    @else
                        {{ number_format($isplate[$i],2,",",".") }} 
                        {{ Firma::valuta() }}
                        <?php  $pom1 = $pom1 + $isplate[$i];  ?>
                    @endif
                </td>
            @endfor
            <?php  $pom1 = $pom1 + $ziralna_uplata;  ?>
            <td style="border-left: 1px solid #000;">
                {{ number_format($otpis_zbir,2,",",".") }} {{ Firma::valuta() }}
            </td>
            <td style="border-left: 1px solid #000;">
                {{ number_format($suma_proizvoda - $zbir_veza,2,",",".") }} {{ Firma::valuta() }}
            </td>
            <td></td><!-- 
            <td></td>
            <td></td> -->
            <?php  
                /*$total = $pom1 + $pom0 - dobavljaci_isplata::where('nacin', 1)->sum('iznos') + $otpis_zbir + $suma_proizvoda - array_sum($unos_dobavljaca) - $zbir_veza;*/

                $total = round($suma_zaduzenja - $suma_razduzenja, 2);
            ?>
            @if($total != 0)
                <td style="background-color: red; font-weight: bold;">
                    {{ number_format($total,2,",",".") }} 
                    {{ Firma::valuta() }}
                </td>
            @else
                <td style="background-color: #00cc00; font-weight: bold;">
                    {{ number_format($total,2,",",".") }} 
                    {{ Firma::valuta() }}
                </td>
            @endif
        </tr>
    </tbody>      
</table>
