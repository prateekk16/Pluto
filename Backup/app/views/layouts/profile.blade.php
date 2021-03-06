<!DOCTYPE html>
<html lang="en" ng-app="pluto">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="_token" content="{{ csrf_token() }}" />

    <title>@yield('meta-title', 'Cliqoid')</title>


   
   
     @section('header')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/jasny.min.css') }}
        {{ HTML::style('css/jquery-ui.css') }}
        {{ HTML::style('css/sweetalert2.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}

        

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
      <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
     @show

</head>

<body>
   

    
        
                <div class="container">
                  <div class="col-md-3">
                     @include('layouts/partials/navbar_profile')
                  </div>

                  <div class="col-md-9 col-md-offset-3">
                     @yield('content')
                  </div>
                </div>

                   
           
    

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
     <script src="js/jquery-1.11.1.min.js"></script>
     <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        {{ HTML::script('js/sweetalert2.min.js') }}        
        {{ HTML::script('js/jasny.min.js') }}
        {{ HTML::script('js/bundle.js') }}
        {{ HTML::script('js/pusher.js') }}
        {{ HTML::script('js/myPusher.js') }}
        {{ HTML::script('js/jscroll.min.js') }}



        
  

</body>
</html>