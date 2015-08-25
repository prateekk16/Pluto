<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="_token" content="{{ csrf_token() }}" />

	 <title>@yield('meta-title', 'Cliqoid')</title>

	   @section('header')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/style.css') }}        
        {{ HTML::style('css/jquery-ui.css') }}
        {{ HTML::style('css/sweetalert2.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        {{ HTML::style('css/creative.css') }}
        {{ HTML::style('css/form-elements.css') }}
        {{ HTML::style('css/sb-admin.css') }}

         
  		 <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700"> 
       @show
	
</head>
<body style="padding-top:0px;">
	
		
			@yield('content')
	
	

	{{ HTML::script('js/sweetalert2.min.js') }} 
	{{ HTML::script('js/jquery-1.11.1.min.js') }} 
	{{ HTML::script('js/bundle.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}

</body>
</html>

