<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ AdminOptions::base_url()}}css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="{{ AdminOptions::base_url()}}css/admin.css">
    
    @include('partials/header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style type="text/css">
        body{
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
        }
        .modal-header {
            padding:9px 15px;
            border-bottom:4px solid #cccccc;
            background-color: #ffa31a;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .modal-footer{
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            border-bottom:10px solid #ffa31a;
            -webkit-border-bottom-left-radius: 6px;
            -webkit-border-bottom-right-radius: 6px;
            -moz-border-radius-bottomleft: 6px;
            -moz-border-radius-bottomright: 6px;
        }

        .LogoF{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>
<body>  
    @if(null === Session::get('brojac'))
    <?php Session::put('brojac', 1) ?>
        <div class="modal fade" id="overlay">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><center><h2><b>{{ AdminOptions::findSession('firma', 'naziv') }}</b></h2>{{ AdminOptions::findSession('firma', 'adresa') }}</center></h4>
                    </div>
                    <div class="modal-body">
                        <p><DATA><center><nav><b>{{ AdminOptions::lang(3, Session::get('jezik.AdminOptions::server()')) }}</b></nav></center></DATA></p>
                    </div>
                </div>
            </div>
        </div>
    @endif    
    @include ('menu')
    <script type="text/javascript">
        $('#overlay').modal('show');
        setTimeout(function() {
            $('#overlay').modal('hide');
        }, 4000);
    </script>
</body>
</html>
