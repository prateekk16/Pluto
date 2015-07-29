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
          <h1>Off Canvas Reveal Menu Template</h1>
        </div>
        <p class="lead">This example demonstrates the use of the offcanvas plugin with a reveal effect.</p>
        <p>On the contrary of the push effect, the menu doesn't move with the canvas.</p>
        <p>You get the reveal effect by wrapping the content in a div and setting the <code>canvas</code> option to target that div.</p>
        <p>Note that in this example, the navmenu doesn't have the <code>offcanvas</code> class, but is placed under the canvas by setting the <code>z-index</code>.</p>
        <p>Also take a look at the examples for a navmenu with <a href="../navmenu">slide in effect</a> and <a href="../navmenu-push">push effect</a>.</p>
  </div><!-- /.container -->

@endif
@stop

