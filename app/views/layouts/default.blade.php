<!DOCTYPE html>
<html lang="en" ng-app="pluto">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('meta-title', 'Cliqoid')</title>

    <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   
   
     @section('header')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/profile.css') }}
        {{ HTML::style('css/profile-elements.css') }}
       {{ HTML::style('css/selectize.bootstrap3.css') }}
        {{ HTML::style('css/sweetalert2.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
     @show

</head>

<body>
    <div class="wrapper">
      <div class="box">
         <div class="row row-offcanvas row-offcanvas-left">
          <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar"> 
             @include('layouts/partials/sidebar')
          </div> 
            

            
            <div class="column col-sm-10 col-xs-11" id="main">
                @include('layouts/partials/topbar')

                {{-- <div class="padding"> --}}
                   
                        @yield('content')
                    
               {{--  </div> --}}

            </div>
         </div>
     </div>
    </div>

   
    <script src="js/jquery-1.11.1.min.js"></script>

        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/sweetalert2.min.js') }}
        {{ HTML::script('js/bundle.js') }}
        {{ HTML::script('js/profile.js') }}
        {{ HTML::script('js/jasny.min.js') }}
         {{ HTML::script('js/pusher.js') }}
        {{ HTML::script('js/myPusher.js') }}
        {{ HTML::script('js/selectize.min.js') }}
        {{ HTML::script('js/jscroll.min.js') }}

   

</body>
</html>