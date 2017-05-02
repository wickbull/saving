@extends('base')

@section('layout')
<div class="container w-xxl w-auto-xs">

	<div class="text-center">
		<img src="{{ static_asset('/img/logo.png') }}" alt="logo" title="logo" >
	</div>

	<a href="/" class="navbar-brand block m-t"></a>

	<div class="m-b-lg">

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
