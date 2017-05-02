@extends('layouts.simple')

@section('title') Password Reset @endsection

@section('content')
	<div class="wrapper text-center">
		<strong>Reset your password</strong>
	</div>
	<form name="form" class="form-validation" role="form" method="POST" novalidate action="{{ action('Auth\PasswordController@postReset') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="token" value="{{ $token }}">

		<div class="text-danger wrapper text-center">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $error)
					{{ $error }}<br>
				@endforeach
			@endif
		</div>

		<div class="list-group list-group-sm">
			<div class="list-group-item">
				<input type="email" class="form-control no-border" name="email" value="{{ old('email') }}" placeholder="Email" autofocus required>
			</div>
			<div class="list-group-item">
				<input type="password" class="form-control no-border" name="password" placeholder="Password">
			</div>
			<div class="list-group-item">
				<input type="password" class="form-control no-border" name="password_confirmation" placeholder="Password confirmation">
			</div>
		</div>
		<button type="submit" class="btn btn-lg btn-primary btn-block">Reset password</button>
		<div class="line line-dashed"></div>
		<p class="text-center"><small>Already have an account?</small></p>
		<a href="{{ action('Auth\AuthController@getLogin') }}" class="btn btn-lg btn-default btn-block">Sign in</a>
	</form>
@endsection
