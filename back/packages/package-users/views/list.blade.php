@extends('layouts.default')

@section('title') {{_('Users list')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{ $title }}</h1>
					<small class="text-muted">{{_('View users list')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageUsersController@getAdd') }}" class="btn btn-primary">{{_('Create users')}}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">

			<div class="panel-body b-b b-light">

				<form method="GET" action="{{ URL::alter() }}" class="text-right">

					<input id="filter" type="text" class="form-control input-sm w-lg inline m-r" name="search" value="{{ Input::get('search') }}">

					@foreach (Input::all() as $key => $value)
						@if($key != 'search')
							<input type="hidden" name="{{ $key }}" value="{{ $value }}">
						@endif
					@endforeach

					<button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i> {{ _('Search') }}</button>

				</form>
			</div>

			<div>

				<table class="table m-b-none footable-loaded footable default table-striped dataTable" ui-jq="footable">

					@include ('package-users::includes.table', ['users' => $users])

				</table>

			</div>

			<div class="text-center">
				{!! $users->appends(Input::all())->render() !!}
			</div>

		</div>
	</div>

@endsection
