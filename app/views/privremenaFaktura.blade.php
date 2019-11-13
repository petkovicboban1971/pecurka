@for($j=0; $j < count($datumi); $j++)
    <?php  
        $iznos0 = null; 
        $iznos = 0;
    ?>
    <tr>
        <td style=" text-align: left !important;">
            {{ date_format(date_create($datumi[$j]), "d.m.Y.") }}
        </td>
        <tr>
            @foreach($datum_faktura[$j] as $kupac)
                <tr>
                    <td></td>
                    <td>{{ proizvodi::find($kupac->proizvod)->naziv_proizvoda }}</td>
                    <td>{{ proizvodi::odluka($kupac->kolicina, $kupac->pakovanje) }}</td>
                    <td>{{ cene_datumi::cena_proizvoda($kupac->proizvod, $kupac->created_at) }} {{ Firma::valuta() }}</td>
                    <td>{{ number_format((cene_datumi::cena_proizvoda($kupac->proizvod, $kupac->created_at) * proizvodi::odluka_brojcano($kupac->kolicina, $kupac->pakovanje)),2,",",".") }} {{ Firma::valuta() }}</td>
                    <td>{{ radnici::find($kupac->radnik)->ime }} {{ radnici::find($kupac->radnik)->prezime }}</td>
                </tr>
                <?php  
                    $iznos0[$j] = $iznos + cene_datumi::cena_proizvoda($kupac->proizvod, $kupac->created_at) * proizvodi::odluka_brojcano($kupac->kolicina, $kupac->pakovanje);
                    $iznos = $iznos0[$j];
                    $iznos1 = $iznos1 + $iznos;
                ?>
            @endforeach
        </tr>        
    </tr>
    <tr>
        <td style="border-bottom: 1px solid black;"></td>
        <td style="border-bottom: 1px solid black;"></td>
        <td style="border-bottom: 1px solid black;"></td>
        <td style="border-bottom: 1px solid black;"></td>
        @if($iznos >= 0)
            <td style="vertical-align: top; border-bottom: 1px solid black; font-weight: bold; color: #000;">
        @else
            <td style="vertical-align: top; border-bottom: 1px solid black; color: red;">
        @endif
        @if($kupac->realiz_uplate == 1)
            <div style="color: #00cc00;">
            {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}: 
            {{ number_format($iznos0[$j],2,",",".") }} 
            {{ Firma::valuta() }}&nbsp;&nbsp; <i class="fa fa-check fa-2x" aria-hidden="true"></i>
            </div>
        @else
            <div style="color: red;">
            {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}: 
            {{ number_format($iznos0[$j],2,",",".") }} {{ Firma::valuta() }}
            </div>
        @endif
        </td>
        <th style="border-bottom: 1px solid black;">
            @if($kupac->realiz_uplate == 0)
                <button class="btn btn-warning provera" data-link="/realiz_uplate_faktura?faktura={{ $kupac->kupac }}&iznos={{ $iznos0[$j] }}&datum={{$kupac->created_at}}" style="float: right; width: 130px;">{{ AdminOptions::lang(225, Session::get('jezik.AdminOptions::server()')) }}
            @else
                @if($kupac->created_at != date('Y-m-d'))
                    <button class="btn provera" data-link="/realiz_uplate_faktura?faktura={{ $kupac->kupac }}&iznos={{ $iznos0[$j] }}&datum={{$kupac->created_at}}&storno=1" style="float: right; width: 130px; background-color: red; color: #fff; font-weight: bold;" disabled>{{ AdminOptions::lang(239, Session::get('jezik.AdminOptions::server()')) }}
                @else
                    <button class="btn provera" data-link="/realiz_uplate_faktura?faktura={{ $kupac->kupac }}&iznos={{ $iznos0[$j] }}&datum={{$kupac->created_at}}&storno=1" style="float: right; width: 130px; background-color: red; color: #fff; font-weight: bold;">{{ AdminOptions::lang(239, Session::get('jezik.AdminOptions::server()')) }}
                @endif
            @endif                
            </button>
        </th>   
    </tr>
@endfor
<tr>
    @if($suma - $zbir_uplata <= 0)
        <td style="color: #00cc00; font-weight: bold;">
        <?php $text = AdminOptions::lang(216, Session::get('jezik.AdminOptions::server()')); ?>
    @else
        <td style="color: red; font-weight: bold;">
        <?php $text = AdminOptions::lang(217, Session::get('jezik.AdminOptions::server()')); ?>
    @endif
        {{ $text }}: {{ number_format(ABS($suma - $zbir_uplata),2,",",".") }} {{ Firma::valuta() }}
    </td> 
    <td></td>                              
    <td></td>                              
    <td></td>                              
    <td>
        {{ AdminOptions::lang(142, Session::get('jezik.AdminOptions::server()')) }}: 
        {{ number_format($suma,2,",",".") }} 
        {{ Firma::valuta() }}
    </td>
</tr>