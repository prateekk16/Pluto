@extends('layouts.default')

@section('content')

 @if(!$currentUser)

	<div class="starter-template">
	    <h1>
	        {{ Auth::check() ? "Welcome, " . $currentUser->username : "Why Don't You Sign Up?" }}
	    </h1>

	     <div class="col-md-12">
	     	<div class="posts" ng-controller="StatusController">	     	
	     			 
		     			 <div ng-repeat="status in statuses track by $index">
		     			    [[ status.body ]]
		     			 </div> 	     			
	     	
	     	</div>
	     </div>
	   
	  

	</div>

	@else

		 <div class="col-md-6">
	   		@include('pages.partials.status')
	     </div>

	     <div class="col-md-12">
	     	<div class="posts" ng-controller="StatusController">	     	
	     			 
		     			 <div ng-repeat="status in statuses track by $index">
		     			    [[ statuses ]]
		     			 </div> 	     			
	     	
	     	</div>
	     </div>

	@endif
@stop

