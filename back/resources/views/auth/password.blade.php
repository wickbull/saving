@extends('layouts.simple')

@section('title') Password Reset @endsection

@section('content')
	@if (session('status'))

		<div collapse="isCollapsed" class="m-t">
			<div class="alert alert-success">
				<p>{{ session('status') }}</p>
			</div>
		</div>

		<a href="{{ action('Auth\AuthController@getLogin') }}" class="btn btn-lg btn-default btn-block">Sign in</a>

	@else


		<div class="wrapper text-center">
			<strong>Input your email to reset your password</strong>
		</div>

		<form name="reset" novalidate method="POST" action="{{ action('Auth\PasswordController@postEmail') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="text-danger wrapper text-center">
				@if (count($errors) > 0)
					@foreach ($errors->all() as $error)
						{{ $error }}<br>
					@endforeach
				@endif
			</div>

			<div class="list-group list-group-sm">
				<div class="list-group-item">
					<input name="email" type="email" placeholder="Email" class="form-control no-border" autofocus required>
				</div>
			</div>
			<button type="submit" class="btn btn-lg btn-primary btn-block">Reset password</button>
		</form>

		<div class="line line-dashed"></div>
		<p class="text-center"><small>or</small></p>

		<a href="{{ action('Auth\AuthController@getLogin') }}" class="btn btn-lg btn-default btn-block">Sign in</a>

	@endif

@endsection
