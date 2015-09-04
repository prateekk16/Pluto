@extends('layouts.profile')

@section('content')

<div class="box">
  <div class="row row-offcanvas row-offcanvas-left">
  	<div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
        @include('layouts/partials/sidebar_profile')
    </div>

    <div class="column col-sm-10 col-xs-11" id="main">
        @include('layouts/partials/topbar')

        <div class="profile-content" style="padding-top: 70px;">
        	 <ul class="links">
			<li>{{ link_to('http://twitter.com/' , 'Find Me On Twitter') }}</li>
			<li>{{ link_to('http://github.com/' , 'View My Work On GitHub') }}</li>

			
		</ul>

        </div>

       
                       
    </div>
                    
  </div>
</div>


	


	

		

	{{-- 	@if ($user->isCurrent())
			{{ link_to_route('profile.edit', 'Edit Your Profile', $user->username) }}
		@endif
	@else
		<p>No profile yet.</p>
	@endif --}}
@stop