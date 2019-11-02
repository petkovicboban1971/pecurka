    <!DOCTYPE html>
<html>
<head>
    {{ HTML::script('js/datepicker1.js') }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <title></title>
    <style type="text/css">
        input{
            height: 30px !important;            
        }
        .obracun {
            width: 180px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    @if($pom == 14)
        <select name="kupac" class="obracun" required>
            <option value="0" selected disabled>
                {{ AdminOptions::lang(116, Session::get('jezik.AdminOptions::server()')) }}
            </option>
                @foreach($svi_kupci as $radnik)
                    <option value="{{ $radnik->id }}">
                        {{ $radnik->naziv }}
                    </option>
                @endforeach
        </select> 
    @else
        <select name="izabrani_radnik" class="obracun" required>
            <option value="0" selected disabled>
                {{ AdminOptions::lang(60, Session::get('jezik.AdminOptions::server()')) }}
            </option>
                @foreach($radnici as $radnik)
                    <option value="{{ $radnik->id }}">
                        {{ $radnik->ime }} {{ $radnik->prezime }}
                    </option>
                @endforeach
        </select> 
    @endif
    <div style="margin-left:15px; width: 214px; margin-top: 80px;"> 
        <div class="input-group" data-provide="fecha-default">
            <span class="input-group-addon"><i style="padding: 0 !important;" class="fa fa-calendar"></i></span>
            @if($pom == 14)
                <input title="{{ AdminOptions::lang(205, Session::get('jezik.AdminOptions::server()')) }}" id="datepicker" class="form-control input-sm datepicker" type="text" name="pocetni"  size="30" placeholder="{{ AdminOptions::lang(205, Session::get('jezik.AdminOptions::server()')) }}">
            @else
                <input title="{{ AdminOptions::lang(205, Session::get('jezik.AdminOptions::server()')) }}" id="datepicker" class="form-control input-sm datepicker" type="text" name="pocetni"  size="30" placeholder="{{ AdminOptions::lang(205, Session::get('jezik.AdminOptions::server()')) }}" required>
            @endif
        </div>
        <div class="input-group" data-provide="fecha-default" style="position: relative; left: 250px; margin-top: -46px">
            <span class="input-group-addon"><i style="margin: 0 !important;" class="fa fa-calendar"></i></span>
            <input title="{{ AdminOptions::lang(206, Session::get('jezik.AdminOptions::server()')) }}" id="fechasiniestro" class="form-control input-sm datepicker" type="text" name="krajnji" size="30" placeholder="{{ AdminOptions::lang(206, Session::get('jezik.AdminOptions::server()')) }}">
        </div><br> 
            <input type="hidden" name="radnik" value="{{ $radnik->id }}">
            <input type="submit" class="btn btn-success" value="{{ AdminOptions::lang(167, Session::get('jezik.AdminOptions::server()')) }}">    
    </div>
        <br>
        @if($pom == 14)   
            <span style="padding-left: 15px;">
                {{ AdminOptions::lang(245, Session::get('jezik.AdminOptions::server()')) }}
            </span>
        @endif  
        <br>
    <script type="text/javascript">
        $(document).ready(function(){
       
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                
                todayHighlight: true,
                autoclose: true,
            })

        $('#fechasiniestro').datepicker({
                format: 'D/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
            })
        })    
    </script>
</body>
</html>