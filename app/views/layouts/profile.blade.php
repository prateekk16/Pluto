<!DOCTYPE html>
<html lang="en" ng-app="pluto">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta-title', 'WasdBox')</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="_token" content="{{ csrf_token() }}" />

      @section('header')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/style.css') }}
       
        {{ HTML::style('css/jquery-ui.css') }}
        {{ HTML::style('css/sweetalert2.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
     @show

</head>

<body>
    @include('layouts/partials/navbar_profile')

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                @yield('content')
            </div>
        </div>
    </div>


     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/sweetalert.min.js') }}
    {{ HTML::script('js/bundle.js') }}

   
    <script>
                $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
            });


    </script>

</body>
</html>