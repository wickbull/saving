@extends('layouts.simple')

@section('title') 403 @endsection

@section('content')

	<div class="col">

		<div class="wrapper-lg">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="m-n font-thin h1 text-black">403</h1>
					<small class="text-muted">{{ _('Access denied') }}</small>
				</div>

				<div class="col-md-12 text-center m-t-lg">

					<p>
						<a href="{{ route('control') }}" >{{ _('Dashboard') }}</a>
					</p>
					<p>
						<a href="{{ action('Auth\AuthController@getLogout') }}" >{{ _('Login as another user') }}</a>
					</p>

				</div>

			</div>
		</div>
	</div>

@endsection
