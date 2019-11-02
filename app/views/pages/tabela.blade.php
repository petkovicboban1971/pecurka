
<head>
 
<style type="text/css">  

html { overflow-y: scroll; }
body { 
  line-height: .5;
}

::selection { background: #5f74a0; color: #fff; }
::-moz-selection { background: #5f74a0; color: #fff; }
::-webkit-selection { background: #5f74a0; color: #fff; }

/** page structure **/
#wrapper {
  display: block;
  position: absolute;
  right: 85px;
  top: 94px;
  width: 700px;
  margin: 0 auto;
  padding: 10px 17px;
}

#keywords {
  margin: 0 auto;
  margin-bottom: 15px;
}


#keywords thead {
  background: #cc0000;
  color: white;
}
#keywords thead tr th { 
  font-weight: bold;
  padding: 12px 30px;
  padding-left: 42px;
}
#keywords thead tr th span { 
  padding-right: 20px;
  background-repeat: no-repeat;
  background-position: 100% 100%;
}

#keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
  background: #acc8dd;
}


#keywords tbody tr { 
  color: #555;
}
#keywords tbody tr td {
  text-align: center;
  padding: 15px 10px;
}
#keywords tbody tr td.lalign {
  text-align: center;
}

</style>
</head>
<body>
  <div id="wrapper">  
    <table id="keywords" cellspacing="0" cellpadding="0" style="border-bottom: 2px solid #000;">
      <thead>
        <tr>
            <th>{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</th>
            <th>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</th>
            <th>{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</th>
            <th>{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }}</th>
        </tr>
      </thead>
      <tbody>
          @if(!empty($dataa1))
          <?php $suma = 0; ?>
            @for($i=1; $i <= $key; $i++)
            <tr>
              <td class="lalign">{{ proizvodi::find($dataa4[$i])->naziv_proizvoda }}</td>
              <td>{{ $dataa1[$i] }} kg</td>
              <td>{{ $dataa2[$i] }} {{ Firma::valuta() }}</td>
              <td>{{ $dataa3[$i] }} %</td>
              <?php $suma = $suma + $dataa1[$i]*$dataa2[$i]; ?>
            </tr>
            @endfor
          @endif        
      </tbody>
    </table>
    @if(!empty($suma))
      <center>
        Zaduženje radnika: <b>{{ Radnici::find(Privremena_tabela::radnik())->ime }} {{ Radnici::find(Privremena_tabela::radnik())->prezime }}</b>  za kupca: <b>{{ Buyers::find(Privremena_tabela::kupac())->naziv }}</b> iznosi: <b>{{ number_format($suma,2,",",".") }} {{ Firma::valuta() }}</b>
      </center><br><br><br>
      <center>
        {{ AdminOptions::lang(133, Session::get('jezik.AdminOptions::server()')) }} <b>{{ Buyers::find(Privremena_tabela::kupac())->naziv }}</b>?
      </center><br><br><br>
      <center>
        <button id="potvrdaKupac" class="btn btn-success">{{ AdminOptions::lang(71, Session::get('jezik.AdminOptions::server()')) }}
        </button>&nbsp;&nbsp;
        <a href="/ponisti-privremenu" style="width: 120px; color: white;" class="btn btn-danger">{{ AdminOptions::lang(129, Session::get('jezik.AdminOptions::server()')) }}</a>
      </center><br><br><br>
      
    @endif
  </div> 
</body>