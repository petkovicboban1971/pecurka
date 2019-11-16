<html>
<head>	
    <title>{{ AdminOptions::findSession('firma', 'naziv')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
	 <!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

	<!-- jQuery library --><!-- 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

	<!-- Popper JS -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

	<!-- Latest compiled JavaScript --><!-- 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  -->

	<!-- <link rel="stylesheet" type="text/css" href="css/sidebar.css"> -->

    {{ HTML::style('css/sidebar.css') }}<!-- 
    {{ HTML::script('css/sidebar.css') }} -->
</head>
<body style='background: url("/images/nature4.jpg"); background-size: cover;
background-repeat: no-repeat; background-position: center center; 
  background-attachment: fixed; height: 500px'>
    @if (!Session::has('log_sesija'.AdminOptions::server()))
        <script>
            window.location.replace("/admin");
        </script>
    @endif
	<nav class="main-menu" id="nav">
        <ul>
            <li>
                <a href="/home?id=1">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        {{ AdminOptions::lang(166, Session::get('jezik.AdminOptions::server()')) }}
                    </span>
                </a>
              
            </li>
            <li class="has-subnav">
                <a href="/zaduzenje-radnika2">
                    <i class="fa fa-user-plus fa-2x"></i>
                    <span class="nav-text">
                        {{ AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()')) }}
                    </span>
                </a>
                
            </li>
            <li class="has-subnav">
                <a href="/krajZaduzenja">
                   <i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        {{ AdminOptions::lang(140, Session::get('jezik.AdminOptions::server()')) }}
                    </span>
                </a>
                
            </li>
            <li>
                <a href="/razduzenje-radnika">
                    <i class="fa fa-user-times fa-2x"></i>
                    <span class="nav-text">
                        {{ AdminOptions::lang(150, Session::get('jezik.AdminOptions::server()')) }}
                    </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="/istorija_radnika">
                   <i class="fa fa-history fa-2x"></i>
                    <span class="nav-text">
                        {{ AdminOptions::lang(204, Session::get('jezik.AdminOptions::server()')) }}
                    </span>
                </a>
               
            </li>
            @if(radnici::find(Session::get('log_sesija'.AdminOptions::server()))->rola == 10)
                <li>
                    <a href="/admin-welcome">
                        <i class="fa fa-arrow-left fa-2x"></i>
                        <span class="nav-text">
                            {{ AdminOptions::lang(274, Session::get('jezik.AdminOptions::server()')) }}
                        </span>
                    </a>
                </li>
            @endif
            <!-- 
            <li>
               <a href="#">
                   <i class="fa fa-table fa-2x"></i>
                    <span class="nav-text">
                        Tables
                    </span>
                </a>
            </li>
            <li>
               <a href="#">
                    <i class="fa fa-map-marker fa-2x"></i>
                    <span class="nav-text">
                        Maps
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                   <i class="fa fa-info fa-2x"></i>
                    <span class="nav-text">
                        Documentation
                    </span>
                </a>
            </li>
        </ul> -->        
        <div style="padding-top: 50vh;">
            <ul class="logout">
                <li>
                   <a href="/admin-logout">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            {{ AdminOptions::lang(2, Session::get('jezik.AdminOptions::server()')) }}
                        </span>
                    </a>
                </li>  
            </ul>
        </div>
    </nav>

    <div id="datum"> 
        {{ AdminOptions::lang(121, Session::get('jezik.AdminOptions::server()')) }}: {{ date('d.m.Y.') }}
    </div>
    @if(!empty($text))
        <div id="stranica"> 
            {{ $text }}
            @if($izbor == 1)
                : {{ Radnici::find($radnik)->ime }} {{ Radnici::find($radnik)->prezime }}
            @endif
        </div>
    @endif
    @if(empty($opcija))
        @include('glavniMagacin')
    @endif    
</body>
</html>