@extends('base')

@section('layout')

	@include('parts.header')
	@include('menu::aside')

	<div id="content" class="app-content" role="main">
		<div class="@section('body') app-content-body @show">

			@if (count($errors) > 0)
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger alert-dismissible no-radius m-b-n-xxs" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						{{ $error }}
					</div>
				@endforeach
			@endif

			@if (session('messages_success'))
				@foreach (session('messages_success') as $message)
					<div class="alert alert-success alert-dismissible no-radius m-b-n-xxs" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						{{ $message }}
					</div>
				@endforeach
			@endif

			@yield('content')
		</div>
	</div>

@endsection
