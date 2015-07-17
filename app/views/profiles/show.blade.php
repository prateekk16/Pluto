@extends('layouts.default')

@section('content')
	@if ($user->info)
		<h1>{{ $user->username }} </h1>
		<div class="bio">
			<p>
				
			</p>
		</div>

		<ul class="links">
			<li>{{ link_to('http://twitter.com/' , 'Find Me On Twitter') }}</li>
			<li>{{ link_to('http://github.com/' , 'View My Work On GitHub') }}</li>
		</ul>

		@if ($user->isCurrent())
			{{ link_to_route('profile.edit', 'Edit Your Profile', $user->username) }}
		@endif
	@else
		<p>No profile yet.</p>
	@endif
@stop