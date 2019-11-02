@if(empty(Session::get('jezik.AdminOptions::server()')))
	<link rel="stylesheet" href="/admin">
@endif
<title>{{ AdminOptions::findSession('firma', 'naziv')}}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-tap-highlight" content="no"/>
  {{ HTML::style('css/style.css') }}<!-- 
  	<link rel="stylesheet" href="css/style.css"> -->
	<link rel="icon" type="image/png" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'><!-- 
	<link rel="stylesheet" href="/css/alertify.core.css">
    <link rel="stylesheet" href="/css/alertify.default.css">
    <link rel="stylesheet" href="/js/alertify.js"> -->
    {{ HTML::style('css/admin.css') }}<!-- 
    <link href="/css/admin.css" rel="stylesheet" type="text/css" />  --> 
	<link rel='stylesheet' href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'>
    

