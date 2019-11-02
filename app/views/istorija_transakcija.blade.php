@if(empty($podkupci))
    @if(!empty($svi_kupci))
        <form method="post" action="/istorija_transakcija2">
            @include('partials.datumar')
        </form>
        <br>
        <!-- @foreach($svi_kupci as $kupac)
            <a href="/istorija_transakcija2?kupac={{ $kupac->id }}" class="btn btn-success" style="width: 145px;">
                {{ $kupac->naziv }}
            </a>
        @endforeach  -->                       
    @else
        {{ AdminOptions::lang(224, Session::get('jezik.AdminOptions::server()')) }}
    @endif
@else
    <table>
        <thead>
            <tr>                                
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}  
                </td>
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(16, Session::get('jezik.AdminOptions::server()')) }}
                </td>
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(180, Session::get('jezik.AdminOptions::server()')) }}
                </td>
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}
                </td>
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(81, Session::get('jezik.AdminOptions::server()')) }}
                </td>
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(244, Session::get('jezik.AdminOptions::server()')) }}
                </td>
                <td style="border-bottom: 2px solid #777777;">
                    {{ AdminOptions::lang(54, Session::get('jezik.AdminOptions::server()')) }}
                </td>
            </tr>
        </thead>             
        <tbody>
            <br>
            <span style="font-weight: bold; font-size: 13pt; border: 1px solid #777777; padding: 5px;">
                {{ Buyers::find($kupci[0]->id)->naziv }}
            </span>
            <br>
            <br>
            <tr>
                @for($i = 0; $i < count($data_podkupaca); $i++)
                    @foreach($data_podkupaca[$i] as $podkupac)                    
                        <tr>
                            <td>
                                {{ date_format(date_create($podkupac->created_at), 'd.m.Y.') }}
                            </td> 
                            <td>
                                {{ proizvodi::find($podkupac->proizvod)->naziv_proizvoda }} 
                            </td>
                            <td>
                                <?php 
                                    if(vrsta_prodaje::find($podkupac->nacin)){
                                        echo AdminOptions::lang(vrsta_prodaje::find($podkupac->nacin)->naziv, Session::get('jezik.AdminOptions::server()')); 
                                    }
                                    else{
                                        echo AdminOptions::lang(201, Session::get('jezik.AdminOptions::server()'));
                                    }
                                ?>
                            </td>
                            <td>
                                {{ number_format(cene_datumi::cena_proizvoda($podkupac->proizvod, $podkupac->created_at) * proizvodi::odluka_brojcano($podkupac->kolicina, $podkupac->pakovanje),2,",",".") }}
                                {{ Firma::valuta() }}
                            </td>                                        
                            <td>
                                {{ radnici::find($podkupac->radnik)->ime }} {{ radnici::find($podkupac->radnik)->prezime }}
                            </td>                                        
                            <td>{{ Buyers::find($podkupac->kupac)->ulica }}</td> 
                            <td>{{ Buyers::find($podkupac->kupac)->grad }}</td> 
                        </tr>                    
                    @endforeach
                @endfor  
                <!-- <td style="font-weight: bold;">
                    {{ AdminOptions::lang(139, Session::get('jezik.AdminOptions::server()')) }} 
                    {{ number_format($iznos,2,",",".") }} 
                    {{ Firma::valuta() }}
                </td>   -->            
            </tr>
        </tbody>
    </table>
@endif