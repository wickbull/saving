@extends('layouts.default')

@section('title') {{ _('List of statuses') }} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{ _('Statuses') }}</h1>
					<small class="text-muted">{{ _('List of statuses') }}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageStatusesController@getAdd') }}" class="btn btn-primary">{{ _('Create status') }}</a>
				</div>
			</div>
		</div>


		<div class="wrapper-md">
			<ul class="list-group list-group-lg list-group-sp">

				@forelse($statuses as $status)

					<li class="list-group-item">
						<span class="pull-right text-right">
							<a href="{{ action('\Packages\PackageStatusesController@getEdit', [$status]) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>

						<div class="clear">
							<a href="{{ action('\Packages\PackageStatusesController@getEdit', [$status]) }}">
								{{ $status->title }}
							</a>
						</div>
					</li>

				@empty
				@endforelse

			</ul>

		</div>
	</div>

@endsection
