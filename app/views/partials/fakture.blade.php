@for($i=0; $i < count($datumi); $i++)
    <?php 
        $iznos = 0; 
        $iznos0 = null; 
    ?>
    <tr>
        <td>
            {{ date_format(date_create($datumi[$i]), "d.m.Y.") }}
        </td>
        @foreach($razduzenja[$i] as $key => $kupac1)
            <td>
                {{ proizvodi::find($kupac1->proizvod)->naziv_proizvoda }} 
            </td>
            <td>
                {{ proizvodi::odluka($kupac1->kolicina, $kupac1->pakovanje) }}
            </td>
            <td>
                {{ number_format(cene_datumi::cena_proizvoda($kupac1->proizvod, $kupac1->created_at),2,",",".") }} {{ Firma::valuta() }}
            </td>
            <td>
                {{ number_format(proizvodi::kolicina_pakovanje($kupac1->kolicina, $kupac1->pakovanje, $kupac1->proizvod, 0),2,",",".") }} {{ Firma::valuta() }}
                <?php 
                    $iznos0[$i] = $iznos0[$i] + proizvodi::kolicina_pakovanje($kupac1->kolicina, $kupac1->pakovanje, $kupac1->proizvod, 0);
                    if($kupac1->realiz_uplate == 0){
                    $iznos = $iznos + proizvodi::kolicina_pakovanje($kupac1->kolicina, $kupac1->pakovanje, $kupac1->proizvod, 0);
                    }
                 ?>
            </td>
            <td>
                {{ Radnici::find($kupac1->radnik)->ime }} {{ Radnici::find($kupac1->radnik)->prezime }}
            </td>   
        @endforeach 
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
            @if($kupac1->realiz_uplate == 1)
                <div style="color: #00cc00;">
                {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}: 
                {{ number_format($iznos0[$i],2,",",".") }} 
                {{ Firma::valuta() }}&nbsp;&nbsp; <i class="fa fa-check fa-2x" aria-hidden="true"></i>
                </div>
            @else
                <div style="color: red;">
                {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}: 
                {{ number_format($iznos0[$i],2,",",".") }} {{ Firma::valuta() }}
                </div>
            @endif
        </td>
        <th style="border-bottom: 1px solid black;">
            @if($kupac1->realiz_uplate == 0)
                <button class="btn btn-warning provera" data-link="/realiz_uplate_faktura?faktura={{ $kupac1->kupac }}&iznos={{ $iznos0[$i] }}&datum={{$kupac1->created_at}}" style="float: right; width: 130px;">{{ AdminOptions::lang(225, Session::get('jezik.AdminOptions::server()')) }}
            @else
                <button class="btn  provera" data-link="/realiz_uplate_faktura?faktura={{ $kupac1->kupac }}&iznos={{ $iznos0[$i] }}&datum={{$kupac1->created_at}}&storno=1" style="float: right; width: 130px; background-color: red; color: #fff; font-weight: bold;">{{ AdminOptions::lang(239, Session::get('jezik.AdminOptions::server()')) }}
            @endif
                
            </button>
        </th>   
    </tr>
@endfor