@extends('layouts.default')

@section('content')
<div class="starter-template">
    <h1>
        {{ Auth::check() ? "Welcome, " . $currentUser->username : "Why Don't You Sign Up?" }}
    </h1>
   
   <div class="col-md-4">
   		@include('pages.partials.status')
   </div>

</div>
@stop