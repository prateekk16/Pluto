@extends('layouts.profile')

@section('content')




 @if(!$currentUser)

	<div class="starter-template">
	    <h1>
	        {{ Auth::check() ? "Welcome, " . $currentUser->username : "Why Don't You Sign Up?" }}
	    </h1>	     

	</div>

@else





 <div class="container">
        <div class="page-header">
          <h1>Welcome to Cliqoid!</h1>
        </div>
        <p class="lead">Designed n Developed By: </p>
        <p>Prateek Singh</p>
        <p></p>
        <p></p>
       

         {{--  <div>
            <button id="btnInit" >Find my location</button>
          </div>

          <div id="newMap"></div> --}}
          

  </div><!-- /.container -->

@endif
@stop

