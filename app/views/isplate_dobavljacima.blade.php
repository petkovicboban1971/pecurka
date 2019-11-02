@if($zbir_nacin[0] - dobavljaci_isplata::sum('iznos') == 0)
    <select name="dobavljac_isplata" class="nacin_uplate" style="width: 250px; font-weight: bold;" disabled>
@else
    <select name="dobavljac_isplata" class="nacin_uplate" style="width: 250px; font-weight: bold;">
        <option selected disabled>
            {{ AdminOptions::lang(193, Session::get('jezik.AdminOptions::server()')) }}
        </option>
        @foreach($dobavljaci as $dobavljac)
            <option value="{{ $dobavljac->id }}" >
                {{ $dobavljac->naziv_dobavljaca }}
            </option>
        @endforeach
@endif
</select>
<span style="margin-left: 50px;">
    <input type="text" class="iznos_uplate" name="iznos_isplate" size="10" placeholder="{{ AdminOptions::lang(146, Session::get('jezik.AdminOptions::server()')) }}" required disabled> {{ Firma::valuta() }}
    <button type="submit" class="btn btn-success potvrda_uplate" style="margin-left: 25px;" disabled>
        {{ AdminOptions::lang(185, Session::get('jezik.AdminOptions::server()')) }}
    </button>
</span>