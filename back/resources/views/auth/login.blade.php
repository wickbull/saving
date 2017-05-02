@extends('layouts.simple')

@section('title') Login @endsection

@section('content')
	<div class="wrapper text-center">
		<strong>{{ trans('Sign in to get in touch') }}</strong>
	</div>

	<form name="form" class="form-validation" novalidate action="{{ action('Auth\AuthController@postLogin') }}" method="POST">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">


		<div class="list-group list-group-sm">
			<div class="list-group-item">
				<input name="email" type="email" placeholder="Email" class="form-control no-border" autofocus required value="{{ old('email') }}">
			</div>
			<div class="list-group-item">
				<input name="password" type="password" placeholder="Password" class="form-control no-border" required>
			</div>
		</div>
		<div class="checkbox m-b-md m-t-none">
			<label class="i-checks">
				<input name="remember" value="0" type="checkbox"><i></i> Remember me
			</label>
		</div>
		<button type="submit" class="btn btn-lg btn-primary btn-block">Log in</button>

		<div class="text-center m-t m-b"><a href="{{ action('Auth\PasswordController@getEmail') }}">Forgot password?</a></div>

	</form>
@endsection
