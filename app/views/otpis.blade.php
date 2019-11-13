<br>
<select style="width: 200px;" name="proizvod" class="obracun" required>
    <option value="0" selected disabled style="font-weight: bold;">
        {{ AdminOptions::lang(122, Session::get('jezik.AdminOptions::server()')) }}:
    </option>
    @foreach($proizvodi as $proizvod)
        <option value="{{ $proizvod->id }}">
            {{ $proizvod->naziv_proizvoda }}
        </option>
    @endforeach
</select> 
<select style="width: 200px;" name="kupac" class="obracun" required>
    <option value="0" selected disabled style="font-weight: bold;">
        {{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}:
    </option>
    @foreach($kupci as $kupac)
        <option value="{{ $kupac->id }}">
            {{ $kupac->naziv }}
        </option>
    @endforeach
</select> 
<input type="number" step="0.01" min="0" lang="en" id="gender1" class="kolicina" name="kolicina"  placeholder="{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}" required disabled>
<br>
<br>
<input type="submit" class="btn btn-success" value="{{ AdminOptions::lang(167, Session::get('jezik.AdminOptions::server()')) }}">