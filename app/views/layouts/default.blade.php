<!DOCTYPE html>
<html lang="en" ng-app="pluto">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('meta-title', 'Cliqoid')</title>


   
   
     @section('header')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/profile.css') }}
        {{ HTML::style('css/profile-elements.css') }}
       
        {{ HTML::style('css/sweetalert2.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
     @show

</head>

<body>
    <div class="wrapper">
      <div class="box">
         <div class="row row-offcanvas row-offcanvas-left">
             @include('layouts/partials/sidebar')

             <!-- main right col -->
            <div class="column col-sm-10 col-xs-11" id="main">
                @include('layouts/partials/topbar')

                <div class="padding">
                    <div class="full col-sm-9">
                        @yield('content')
                    </div>
                </div>
            </div>
         </div>
     </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/sweetalert2.min.js') }}
        {{ HTML::script('js/bundle.js') }}
        {{ HTML::script('js/profile.js') }}

   

</body>
</html>