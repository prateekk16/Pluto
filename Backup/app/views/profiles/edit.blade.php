@extends('layouts.default')

@section('content')
	<h1>Edit Profile</h1>

	{{ Form::model($user->info, ['method' => 'PATCH', 'route' => ['profile.update', $user->username]]) }}
		<!-- Location Field -->
		<div class="form-group">
			{{ Form::label('firstname', 'Firstname:') }}
			{{ Form::text('firstname', null, ['class' => 'form-control']) }}
			{{ errors_for('firstname', $errors) }}
		</div>

		<!-- Bio Field -->
		<div class="form-group">
			{{ Form::label('lastname', 'Lastname:') }}
			{{ Form::text('lastname', null, ['class' => 'form-control']) }}
			{{ errors_for('lastname', $errors) }}
		</div>

		

		<!-- Update Profile Field -->
		<div class="form-group">
			{{ Form::submit('Update Profile', ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}

@stop