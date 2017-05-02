@extends('layouts.simple')

@section('title') 404 @endsection

@section('content')

	<div class="col">

		<div class="wrapper-lg">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="m-n font-thin h1 text-black">404</h1>
					<small class="text-muted">Page not found</small>
				</div>

				<div class="col-md-12 text-center m-t-lg">
					<a href="{{ route('control') }}" >{{ _('Dashboard') }}</a>
				</div>

			</div>
		</div>
	</div>

@endsection
