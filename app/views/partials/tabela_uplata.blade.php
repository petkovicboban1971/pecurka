                    <table>
                        <thead>
                            <tr>                                
                                <td style="border-bottom: 2px solid #777777;">
                                    {{ AdminOptions::lang(84, Session::get('jezik.AdminOptions::server()')) }}  
                                </td>
                                <td style="border-bottom: 2px solid #777777;">
                                    {{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}
                                </td>
                                <td style="border-bottom: 2px solid #777777;">
                                    {{ AdminOptions::lang(180, Session::get('jezik.AdminOptions::server()')) }}
                                </td>
                                <td style="border-bottom: 2px solid #777777;">
                                    {{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($uplate as $key => $uplata)
                                    @if($uplata->iznos > 0)
                                        <tr>
                                            <td>
                                                @if($pom == 7)
                                                    <a href="/pregled_uplata_kupca?kupac={{ $uplata->kupac_id }}">
                                                        {{ Buyers::find($uplata->kupac_id)->naziv }}
                                                    </a>
                                                @else
                                                    {{ Buyers::find($uplata->kupac_id)->naziv }}
                                                @endif
                                            </td> 
                                            <td>
                                                {{ number_format($uplata->iznos,2,",",".") }} {{ Firma::valuta() }} 
                                            </td>
                                            <td>
                                                <?php echo AdminOptions::lang(vrsta_prodaje::find($uplata->nacin)->naziv, Session::get('jezik.AdminOptions::server()')); ?>
                                            </td>
                                            <td>
                                                {{ date_format(date_create($uplata->created_at), 'd.m.Y.') }}
                                            </td>                                        
                                        </tr>
                                    @endif
                                @endforeach
                                @if($pom == 7)
                                    <td style="border-top: 2px solid #777777;">
                                        {{ AdminOptions::lang(175, Session::get('jezik.AdminOptions::server()')) }}:
                                    </td>
                                    <td style="border-top: 2px solid #777777;">
                                        {{ $suma }} {{ Firma::valuta() }}
                                    </td>
                                    <td style="border-top: 2px solid #777777;"></td>
                                    <td style="border-top: 2px solid #777777;"></td>

                                @endif
                            </tr>
                        </tbody>
                    </table>